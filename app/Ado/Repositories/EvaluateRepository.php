<?php
/**
 * Created by PhpStorm.
 * User: 杜兵
 * Date: 2016/2/18
 * Time: 10:27
 */

namespace App\Ado\Repositories;

use App\Ado\Models\Tables\Evaluate\Evaluate;
use App\Ado\Models\Tables\Evaluate\EvaluateUser;
use App\Ado\Models\Tables\Evaluate\Review;
use App\Ado\Models\Tables\Evaluate\ReviewTemp;
use App\Ado\Models\Screen\DomainCheck;
use App\Ado\Models\Screen\HtmlTo;
//use App\Ado\Models\Screen\CutyCapt;
use DB;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Exception\NotReadableException;


class EvaluateRepository
{
   // protected $cutyCapt;

   /// public function __construct(CutyCapt $cutyCapt)
    //{
   //     $this->cutyCapt = $cutyCapt;
  //  }

    /**
     * 检查网站、生产快照、保存进评价表
     * @param $site
     * @return Evaluate
     */
    public function saveDomain($site,$evaluateTemp=null)
    {
        //获得带http的域名，不要.xx/后面部分
        $domain = $this->cleanDomain($site);
        $evaluate = Evaluate::where('domain', $domain)->first();
        if (!$evaluate) {
            $evaluate = $this->checkAndScreenShot($evaluate,$site); //检查并截屏
            if($evaluateTemp && $evaluateTemp->group_id){
                $evaluate->group_id=$evaluateTemp->group_id;
                $evaluate->google_ads=$evaluateTemp->ad_url;
                $evaluate->summary =$evaluateTemp->title.'  '.$evaluateTemp->content;
                $evaluate->content =$evaluateTemp->content;
                if(!$evaluate->site)$evaluate->site = $this->cleanSite($evaluateTemp->url);
                if(config('front.review.auto')){ //自动添加评论
                    $number = config('front.review.auto_number')?:0;
                    if($number)$this->randReview($evaluate,$number);
                }
            }
        }
        $this->saveMark($evaluate);
        return $evaluate;
    }

    /**
     * 检查并截屏
     * @param $site
     * @param null $evaluate
     * @return Evaluate|null
     */
    public function  checkAndScreenShot($evaluate=null,$site=null){
        if($evaluate){
            $site=$evaluate->site;
        } else{
            $evaluate=new Evaluate();
        }
        if($site){
            $site = $this->cleanSite($site);
            $domain = $this->cleanDomain($site);
            $domainCheck = new DomainCheck();
            $checkResult = $domainCheck->handle($site);
            $site = $checkResult['site'];
            $evaluate->domain = $domain;
            if(stripos($site,'http')===0){
                $evaluate->site = $site;
            }
            if($checkResult['online']){
                $screen=isset($evaluate->screen)?$evaluate->screen:'';
                if(!$screen){
                /**** 快照 ****/
              //  if (PHP_OS == 'WINNT') {
                    $HtmlTo = new HtmlTo();
                    $r =  $HtmlTo->urlToImage($site);

                if($r){
                   try{
                       $screen = $HtmlTo->resize('x400300');
                   }catch(NotReadableException $e){
                   }
                }

              //  } else {
               //     $screen = $this->cutyCapt->url($site)->getFile('/' . $domain . '.png', true,'x400300');
              //  }
                    $evaluate->screen = $screen;

                }
                if($screen)$evaluate->enable=1;
            }
            if (isset($checkResult['brand'])) $evaluate->brand = $checkResult['brand'];
            if (isset($checkResult['risk'])) $evaluate->risk = $checkResult['risk'];
            if (isset($checkResult['online'])) $evaluate->online = $checkResult['online'];
            if (isset($checkResult['google_recodes'])) $evaluate->google_recodes = $checkResult['google_recodes'];
            if (isset($checkResult['google_ads'])) $evaluate->google_ads = $checkResult['google_ads'];
            if (isset($checkResult['google_score'])) $evaluate->google_score = $checkResult['google_score'];
            if (isset($checkResult['tags'])) $evaluate->google_score = $checkResult['tags'];
            if (isset($checkResult['description'])) $evaluate->google_score = $checkResult['description'];
            $evaluate->save();
        }
        return $evaluate;
    }


    /**
     * 整理总分
     * @param $evaluate
     */
    public function saveMark($evaluate)
    {
        //如果五项细则都为0分且打分大于0分，五项细则评分应该是未填写，默认应该与主分一致
        Review::where('service', 0)->where('value', 0)->where('shipping', 0)->where('returns', 0)->where('quality', 0)
            ->update([
                'service' => DB::raw('rating'),
                'value' => DB::raw('rating'),
                'shipping' => DB::raw('rating'),
                'returns' => DB::raw('rating'),
                'quality' => DB::raw('rating'),
            ]);
        //取汇总值进行加权平均
        $ratingResult = $this->getRatingResult($evaluate);
      //  @file_put_contents(__DIR__.'/aa.txt',print_r($ratingResult,true),FILE_APPEND);
        $evaluate->reviews = $ratingResult['num'];
        unset($ratingResult['num']);
        //$evaluate->mark = $ratingResult['mark'];
        /**
         * get star 1-5 count
         */
        $ratingResult['star_num'] = 0;
        $review_star = Review::select(
            DB::raw('count(*) as num')
        )->whereBetween('rating',[0,1.5])->where('evaluate_id', $evaluate->id)->where('enable', 1)->first();
        if($review_star)$ratingResult['star_num']+=$ratingResult['star_1']=$review_star->num;
        $review_star = Review::select(
            DB::raw('count(*) as num')
        )->whereBetween('rating',[1.5,2.5])->where('evaluate_id', $evaluate->id)->where('enable', 1)->first();
        if($review_star)$ratingResult['star_num']+=$ratingResult['star_2']=$review_star->num;
        $review_star = Review::select(
            DB::raw('count(*) as num')
        )->whereBetween('rating',[2.5,3.5])->where('evaluate_id', $evaluate->id)->where('enable', 1)->first();
        if($review_star)$ratingResult['star_num']+=$ratingResult['star_3']=$review_star->num;
        $review_star = Review::select(
            DB::raw('count(*) as num')
        )->whereBetween('rating',[3.5,4.5])->where('evaluate_id', $evaluate->id)->where('enable', 1)->first();
        if($review_star)$ratingResult['star_num']+=$ratingResult['star_4']=$review_star->num;
        $review_star = Review::select(
            DB::raw('count(*) as num')
        )->whereBetween('rating',[4.5,5])->where('evaluate_id', $evaluate->id)->where('enable', 1)->first();
        if($review_star)$ratingResult['star_num']+=$ratingResult['star_5']=$review_star->num;

        foreach($ratingResult as $name=>$float){
            $evaluate->{$name}=$float;
        }
        $evaluate->save();
        return $evaluate;
    }

    /**
     * 计算一段时间的加权平均打分
     * 每项的平均权重都是1，总权重=6；
     * 分项权重合并后 >6,则是多加分，否则减分。
     * @param $evaluate
     * @param int $days
     * @param int $daye
     * @return array
     */
    protected function periodMark($evaluate,$days=180,$daye=30){
       // DB::connection()->enableQueryLog();
        $review_count = Review::select(
            DB::raw('count(*) as num'),
            DB::raw('sum(rating) as rating'),
            DB::raw('sum(service) as service'),
            DB::raw('sum(value) as value'),
            DB::raw('sum(shipping) as shipping'),
            DB::raw('sum(returns) as returns'),
            DB::raw('sum(quality) as quality'),
            DB::raw('sum(helpful) as helpful')
        )->where('evaluate_id', $evaluate->id)->where('enable', 1);
        if(is_numeric($days)){
            $dateStart = date('Y-m-d H:i:s',strtotime("-$days days"));
            $dateEnd = ($daye>0)?date('Y-m-d H:i:s',strtotime("-$daye days")):date('Y-m-d H:i:s');
            $review_counts = $review_count->where('created_at','>',"$dateStart")->where('created_at','<=',"$dateEnd")->first();
        }else{
            $review_counts = $review_count->first();
         //   $queries = DB::getQueryLog();
         //   @file_put_contents(__DIR__.'/aa.txt',print_r($queries,true),FILE_APPEND);
        }
        if ($review_counts->num) {
            $mark = $i = 0;
            $attributes = $review_counts->attributesToArray();
            //每项加权平均
            foreach ($attributes as $name => $float) {

                if ($name == 'helpful'||$name == 'num') continue;
                $i++;
                //加权总分
                $mark += $float * $this->getWeights($name);
                //单项平均分，未加权
                $attributes[$name] = round($float / $review_counts->num, 2);
            }
            //平均,除非有其他打分，否则不平均
            $mark = ($mark / $review_counts->num) / $i;
            //保留2位小数
            $mark = round($mark, 2);
            $attributes['mark'] = $mark;
           // $attributes['reviews'] = $review_counts->num;
        }else{
            $defaultRating = config('front.review.defaultRating');
            $attributes = array(
                'num'=>0,
               // 'reviews'=>0,
                'rating'=>$defaultRating,
                'service'=>$defaultRating,
                'value'=>$defaultRating,
                'shipping'=>$defaultRating,
                'returns'=>$defaultRating,
                'quality'=>$defaultRating,
                'helpful'=>0,
                'mark'=>$defaultRating,
            );
        }
       return  $attributes;
    }

    /**
     * 获得打分权重
     * 在config 里设置
     * @param $key
     * @return float
     */
    public function getWeights($key)
    {
        $weights = config('front.review.weights');
        if ($weights && isset($weights[$key])) return $weights[$key];
        return 1.0;
    }

    /**
     * 计算加权平均打分
     * 所有的评论
     * 年内的评论
     * 月内的评论
     * 进行加权平均
     * @param $allAttributes
     * @param $yearAttributes
     * @param $monthAttributes
     * @return array
     */
    protected function getRatingResult($evaluate)
    {
        $allAttributes = $this->periodMark($evaluate,'all');
        $yearAttributes = $this->periodMark($evaluate,180,30);
        $monthAttributes = $this->periodMark($evaluate,30,-1);
        $weightAll = $this->getWeights('all');
        $weightYear = $this->getWeights('year');
        $weightMonth = $this->getWeights('month');
      //  @file_put_contents(__DIR__.'/aa.txt',print_r($allAttributes,true).'=====',FILE_APPEND);
        foreach($allAttributes as $name=>&$value){
            if ($name == 'helpful'||$name == 'num') continue;
            $value = ($value*$weightAll)+($yearAttributes[$name]*$weightYear)+($monthAttributes[$name]*$weightMonth);
        }
      //  @file_put_contents(__DIR__.'/aa.txt',print_r($allAttributes,true),FILE_APPEND);
        return $allAttributes;
    }

    /*
    * 清理url获得域名
    */
    public function cleanDomain($domain)
    {
        $domain = str_replace(array('https', 'http', '://', 'www.'), '', $domain);
        return explode('/', $domain)[0];
    }

    public static function getDomain($domain){
        $domain = str_replace(array('https', 'http', '://', 'www.'), '', $domain);
        return explode('/', $domain)[0];
    }

    public function cleanSite($site){
        $po = stripos($site, '/', stripos($site, '.'));
        $site = ($po) ? substr($site, 0, $po) : $site;
        if (stripos($site, 'http') !== 0) {
            $site = 'http://' . $site;
        }
        return $site;
    }

    public static function getSite($site){
        $po = stripos($site, '/', stripos($site, '.'));
        $site = ($po) ? substr($site, 0, $po) : $site;
        if (stripos($site, 'http') !== 0) {
            $site = 'http://' . $site;
        }
        return $site;
    }

    /**
     * 检查域名归属谁，有没有通过验证
     * @param $user
     * @param $evaluate
     * @param bool $checkPass
     * @return bool
     */
    public function checkUserOwnDomain($user,$evaluate,$checkPass=true){
        $own = false;
        $evaluateUsers = Cache::remember('user-'.$user->id,60,function() use($user){
            return EvaluateUser::where('user_id',$user->id)->get();
        }) ;
        $evaluateUser = $evaluateUsers->filter(function($obj) use($evaluate){
            return  $obj->evaluate_id==$evaluate->id;
        });
        if($evaluateUserAs=$evaluateUser->first()) {
            if ($checkPass) {
                if ($evaluateUserAs->pass) {
                    $own = true;
                }
            }else{
                $own = true;
            }
        }
        return $own;
    }

    /**
     * 随机评论条
     * @param Evaluate $evaluate
     * @param $reviewTemp
     */
    public function randReview($evaluate,$number=1){
        if($number>1){
            $reviewTemps1 = ReviewTemp::where('enable',1)->where('used',0)->where('domain',$evaluate->domain)->take($number)->get();
            if($reviewTemps1->count()){
                foreach($reviewTemps1 as $reviewTemp){
                    $this->oneReview($evaluate,$reviewTemp);
                }
            }
            $reviewTemps = ReviewTemp::where('enable',1)->where('used',0)->where('group_id',$evaluate->group_id)->take($number)->get();
            if($reviewTemps->count()){
                foreach($reviewTemps as $reviewTemp){
                    $this->oneReview($evaluate,$reviewTemp);
                }
                return true;
            }
        }else{
            $reviewTemp = ReviewTemp::where('enable',1)->where('used',0)->where('group_id',$evaluate->group_id)->first();
            return $this->oneReview($evaluate,$reviewTemp);
        }
       return false;
    }

    /**
     * 写一条评论
     * @param $evaluate
     * @param $reviewTemp
     */
    public function oneReview($evaluate,$reviewTemp){
        if($reviewTemp){
            Review::create([
                'title'=>$reviewTemp->title,
              //  'content'=>$reviewTemp->content,
                'review'=>$reviewTemp->review,
                'rating'=>$reviewTemp->rating,
                'service'=>$reviewTemp->service,
                'value'=>$reviewTemp->value,
                'shipping'=>$reviewTemp->shipping,
                'returns'=>$reviewTemp->returns,
                'quality'=>$reviewTemp->quality,
                'helpful'=>$reviewTemp->helpful,
                'ip'=>$reviewTemp->ip,
                'user_id'=>$reviewTemp->user_id,
                'enable'=>$reviewTemp->enable,
                'group_id'=>$reviewTemp->group_id,
                'evaluate_id'=>$evaluate->id,
            ]);
            $reviewTemp->update(['used'=>1]);
            return true;
        }
        return false;
    }

    /**
     * col-1:domain
     * col-2:rating
     * col-3:title
     * col-4:content
     * col-5:user nice name
     * @param $csvFile
     */
    public function saveReviewTemps($csvFile){
        $Handle = fopen($csvFile,"r");
        while(! feof($Handle))
        {
            $row = (fgetcsv($Handle));
            if(!empty($row) && count($row)>=4){
                $domain = EvaluateRepository::getDomain($row[0]);
                if(!empty($domain)){
                    $rating = $row[1];
                    $name = isset($row[4])?$row[4]:'';
                    $user_id = rand(5,200);
                    if(!empty($name)){
                        $user = $this->createUser($name);
                        if($user)$user_id=$user->id;
                    }
                    $ratingData = $this->getRandRating($rating);
                    $title =  str_replace(['"'],'',$row[2]);
                    $content = str_replace(['"'],'',$row[3]);
                    $content = strip_tags($content,'<p>');
                    $title = e($title);
                    $content= e($content);
                    if(!empty($title) && !empty($content)){
                        $evaluate = Evaluate::where('domain',$domain)->first();
                        $date = $this->randomLastDate();
                        if($evaluate){
                            $review = Review::where('title',$title)->where('evaluate_id',$evaluate->id)->first();
                            if(!$review){
                                Review::create([
                                    'title'=>$title,
                                    'review'=>$content,
                                    'rating'=>$ratingData[0],
                                    'service'=>$ratingData[1],
                                    'value'=>$ratingData[2],
                                    'shipping'=>$ratingData[3],
                                    'returns'=>$ratingData[4],
                                    'quality'=>$ratingData[5],
                                    'helpful'=>rand(1,5),
                                    'ip'=>$this->generateIP(),
                                    'user_id'=>$user_id,
                                    'enable'=>1,
                                    'group_id'=>$evaluate->group_id,
                                    'evaluate_id'=>$evaluate->id,
                                    'created_at'=>$date,
                                    'updated_at'=>$date
                                ]);
                              $this->saveMark($evaluate);
                            }
                        }else{
                            ReviewTemp::create([
                                'domain'=>$domain,
                                'title'=>$title,
                                'review'=>$content,
                                'enable'=>1,
                                'rating'=>$ratingData[0],
                                'service'=>$ratingData[1],
                                'value'=>$ratingData[2],
                                'shipping'=>$ratingData[3],
                                'returns'=>$ratingData[4],
                                'quality'=>$ratingData[5],
                                'ip'=>$this->generateIP(),
                                'user_id'=>$user_id,
                            ]);
                        }
                    }
                }
            }
        }
        fclose($Handle);
    }

    /**
     * 创建虚拟用户
     * @param $name
     * @return bool
     */
    public function createUser($name){
        $name = trim($name);
        if(empty($name))return false;
       $user = User::where('name',$name)->where('virtual',1)->first();
        if(!$user){
            $email=str_slug($name,'_').'@yahoo.com';
           $user =  User::create([
                'name'=>$name,
                'email'=>$email,
                'virtual'=>1,
                'avatar'=>$this->getAvatar(),
            ]);
        }
        return $user;
    }

    protected function getAvatar(){
      $avatars =  array (
          7 => 'Lovers-200x200-8.jpg',
          8 => 'Lovers-200x200-7.jpg',
          9 => 'Lovers-200x200-4.jpg',
          10 => 'Lovers-200x200-3.jpg',
          11 => 'Lovers-200x200-2.jpg',
          12 => 'Lovers-200x200-10.jpg',
          13 => 'Lovers-200x200-1.jpg',
          14 => '200x200-o9.jpg',
          15 => '200x200-o8.jpg',
          16 => '200x200-o7.jpg',
          17 => '200x200-o6.jpg',
          18 => '200x200-o5.jpg',
          19 => '200x200-o4.jpg',
          20 => '200x200-o3.jpg',
          21 => '200x200-o2.jpg',
          22 => '200x200-o18.jpg',
          23 => '200x200-o17.jpg',
          24 => '200x200-o16.jpg',
          25 => '200x200-o15.jpg',
          26 => '200x200-o14.jpg',
          27 => '200x200-o13.jpg',
          28 => '200x200-o12.jpg',
          29 => '200x200-o11.jpg',
          30 => '200x200-o10.jpg',
          31 => '200x200-o1.jpg',
          32 => '200x200-9.jpg',
          33 => '200x200-6.jpg',
          34 => '200x200-5.jpg',
          35 => '200x200-22.jpg',
          36 => '200x200-21.jpg',
          37 => '200x200-20.jpg',
          38 => '200x200-19.jpg',
          39 => '200x200-18.jpg',
          40 => '200x200-17.jpg',
          41 => '200x200-16.jpg',
          42 => '200x200-15.jpg',
          43 => '200x200-14.jpg',
          44 => '200x200-13.jpg',
          45 => '200x200-12.jpg',
          46 => '200x200-11.jpg',
      );
        return $avatars[rand(7,46)];
    }

    /**
     * @pararm
     * @param string $type good|middle/normal|bad
     * @return array
     */
    public function getRandRating($type='good'){
        $data=[];
        if(is_numeric($type)){
            $type = (is_numeric($type) && $type>3.5)?'good':$type;
            $type = (is_numeric($type) && $type>2 && $type<=3.5)?'middle':$type;
            $type = (is_numeric($type) && $type<=2)?'bad':'middle';
        }
        if(!in_array($type,['good','middle','normal','bad']))$type='middle';

        if($type=='good'){
            for($i=0;$i<6;$i++){
                $data[]=4 + rand(2,5)*2/10;
            }
        }elseif($type=='middle'||$type=='normal'){
            for($i=0;$i<6;$i++){
                $data[]=3 + rand(2,5)*2/10;
            }
        }elseif($type=='bad'){
            for($i=0;$i<6;$i++){
                $data[]=rand(1,3)+ rand(2,5)*2/10;
            }
        }
        return $data;
    }


    /**
     * 注册随机ip
     * @return string
     */
    public function generateIP()
    {
        $q1 = 0;
        $exclude = [0,10,100,127,169,172,192,198,203,224,240];
        do {
            $q1 = rand(1, 254);
        } while (!in_array($q1,$exclude));
        $q2 = rand(0, 254);
        $q3 = rand(0, 254);
        $q4 = rand(1, 254);
        $ip = $q1 . '.' . $q2 . '.' . $q3 . '.' . $q4;
        return $ip;
    }

    /**
     * 随机时间
     * @param $begintime
     * @param string $endtime
     * @return bool|string
     */
   public  function randomLastDate($lastdays=3) {
        $end = time();
        $begin = strtotime("-$lastdays days");
        $timestamp = rand($begin, $end);
        return date("Y-m-d H:i:s", $timestamp);
    }
}