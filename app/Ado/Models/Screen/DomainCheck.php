<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-9-2
 * Time: 上午9:06
 * 网站检查
 * 一般在抓取结果页之前，先检查一下网站的各项参数是否正常
 * 检查谷歌排名、得分
 * 检查是否有在谷歌上做广告
 * 检查网站302 301 到达的网址是否一致
 */

namespace App\Ado\Models\Screen;


class DomainCheck {
    protected $online = false;
    protected $tags='';
    protected $description='';
    /**
     * 检查所有数据
     * check all
     * @param $domain
     * @return array
     */
    public function handle($site){
        $result1 = $this->checkSiteInGoogle($site);
        $result2 = $this->checkRiskSite($site);
        return array_merge($result1,$result2);
    }
    /**
     * 判断谷歌shop得分、谷歌广告在线、谷歌收录
     * 检查网站的一些属性
     * @return bool
     */
    public function checkSiteInGoogle($site){
        $result = array();
        $countrys = array(
            'co.uk'=>'UK',
            'com'=>'US',
            'com.au'=>'AU',
            'com.ca'=>'CA',
        );
        $domain = $this->getDomain($site);
        $ext =  $this->getDomainExtend($domain);
        $brand =  $this->getDomainBrand($domain);
        $country = isset($countrys[$ext])?$countrys[$ext]:'US';
        $url="http://www.google.com/search?source=hp&biw=1440&bih=762&q=$brand&aq=f&aqi=g10&aql=&oq=&cr=$country";
        $html=$this->curlGet($url);
        if(!empty($html)){
            //获得记录数
            $result['google_recodes']=$this->getRecode($html);
            //获得广告排序
            $result['google_ads']=$this->getInAds($html,$domain);
            //google shopping 评分
            $result['google_score']=$this->getScore($html,$domain);
        }
        $result['brand']=$brand;
        return $result;
    }

    public function getDomain($site){
        $domain = str_replace(array('https','http','://','www.'),'',$site);
        return explode('/',$domain)[0];
    }

    /**
     * 获得域名扩展
     * @param $domain
     * @return string
     */
    private function getDomainExtend($domain){
        return substr($domain,stripos($domain,'.')+1);
    }

    /**
     * 获得域名品牌
     * @param $domain
     * @return string
     */
    private function getDomainBrand($domain){
        return substr($domain,0,stripos($domain,'.'));
    }

    /**
     * 获得谷歌记录数
     * @param $html
     * @return int
     */
    private function getRecode($html){
        preg_match('/about(.*)results/Ui',$html,$index);
        return !empty($index[1])?$index[1]:0;
    }

    /**
     * 获得google广告排序
     * @param $html
     * @param $domain
     * @return int|string
     */
    private function getInAds($html,$domain){
        $inAds = 0;
        preg_match('/adurl=(.*)\"/Ui',$html,$index);
        if(!empty($index)){
            foreach($index as $k=>$href){
                if(stripos($href,$domain)!==false){
                    $inAds = $k+1;
                    break;
                }
            }
        }
        return $inAds;
    }

    //google shopping 评分取结果方法
    private function getScore($html,$domain){
        $result = 0;
        preg_match_all('/<span class="_kgd">(.*)<\/span>/Ui',$html,$index);
        if(isset($index[1]) && !empty($index[1])){
            foreach($index[0] as $k=>$numberStr){
                $str =  substr($html,stripos($html,$numberStr));
                preg_match('/href="(.*)">/Ui',$str,$submatch);
                if(isset($submatch[1]) && stripos($submatch[1],$domain)!==false){
                    $result = $index[1][$k];
                    break;
                }
            }
        }
        return $result;
    }

    /**
     * 检查网址是否被跳，取真实网址,判断是否在线
     * @param $site
     * @return mixed
     */
    public function checkRiskSite($site){
        $result = array('risk'=>1,'site'=>$site,'online'=>0,'tags'=>'','description'=>'');
        $realSite = $this->getRedirectLocation($site);
        $domain1 = $this->getDomain($site);
        $domain2 = $this->getDomain($realSite);
        if($domain1 == $domain2){
            $result['risk']=0;
            if($this->online){
                $result['online']=1;
                $result['tags']=$this->tags;
                $result['description']=$this->description;
            }
        }
        $result['site']=$realSite;

        return $result;
    }
    /**
     * 检查302 真实地址
     * @param $site
     * @return mixed
     */
    private function getRedirectLocation($site){
        $realUrl=$site;
        if(function_exists('curl_version')){
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $site);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);//设置curl执行时间不超过3秒
        curl_setopt($ch, CURLOPT_NOBODY, 1);//这行不能要，如果添上，那么在遇到302重定向的时候就会得不到真正的请求url
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $content=curl_exec($ch);
        //$rinfo=curl_getinfo($ch);
        $matches=array();
        if($content && preg_match('/Location:\s+?(.+?)\s+?/', $content,$matches)){
            //echo $matches[1],"</br>";
            unset($content);
            $realUrl=$this->getRedirectLocation($matches[1]);
        }
        if(isset($content)){
            $this->online=true;
            $this->getMetas($content);
            unset($content);
        }
        }
        return $realUrl;
    }

    public function curlGet($url){
        if(function_exists('curl_version')){
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);//设置curl执行时间不超过3秒
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            $content=curl_exec($ch);
            curl_close($ch);
        }else{
            $content = file_get_contents($url);
        }
        return $content;
    }

    protected function getMetas($contents){

            $result = false;


            if (isset($contents) && is_string($contents))
            {
                $title = null;
                $metaTags = null;

                preg_match('/<title>([^>]*)<\/title>/si', $contents, $match );

                if (isset($match) && is_array($match) && count($match) > 0)
                {
                    $title = strip_tags($match[1]);

                }

                preg_match_all('/<[\s]*meta[\s]*name="?' . '([^>"]*)"?[\s]*' . 'content="?([^>"]*)"?[\s]*[\/]?[\s]*>/si', $contents, $match);

                if (isset($match) && is_array($match) && count($match) == 3)
                {
                    $originals = $match[0];
                    $names = $match[1];
                    $values = $match[2];

                    if (count($originals) == count($names) && count($names) == count($values))
                    { $metaTags = array();

                        for ($i=0, $limiti=count($names); $i < $limiti; $i++)
                        {
                            if($names[$i]=='description'){ $this->description=$values[$i];continue;}
                            if($names[$i]=='keywords'){$this->tags=$values[$i];continue;}
                            $metaTags[$names[$i]] = array (
                                'html' => htmlentities($originals[$i]),
                                'value' => $values[$i]
                            );
                        }
                    }
                }

            }
    }
}

