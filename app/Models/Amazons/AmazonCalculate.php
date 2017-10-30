<?php

namespace App\Models\Amazons;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cache;
use App\Ado\Models\Tables\Core\Setting;

use App\Models\Amazons\AmazonProductRank;
use App\Models\Amazons\AmazonOkProductRanks;


class AmazonCalculate extends Model
{
    /**
     * 第一步的计算
     * rank 排序差异
     */
    public function calcDiff(){
            DB::table('amazon_product_ranks')->pluck('product_id','rank')->orderBy(DB::raw('product_id asc,rank desc'))->chunk(100,function($ranks){
             $lastRank = [];
             $lastProductId = 0;
             foreach ($ranks as $i=>$rank){
                 if($rank['product_id'] == $lastProductId)continue;
                if(isset($ranks[$i+1])){
                    //接上一个循环
                    if(!empty($lastRank) && $lastRank['product_id']===$rank['product_id']){
                        $diff = $lastRank['rank']-$rank['rank'];
                    }else{  //b本次循环
                        if($ranks[$i+1]['product_id']===$rank['product_id']){
                            $diff = $rank['rank']-$ranks[$i+1]['rank'];
                        }
                        if($lastProductId!=$rank['product_id'] && $diff){
                                $this->saveDiff($rank['product_id'],$diff);
                                $lastProductId = $rank['product_id'];
                        }
                    }
                }else{ //接下一个循环
                    $lastRank = $rank;
                }
            }
        });
    }

    /**
     * 保存差异
     * @param $productId
     * @param $diff
     */
    protected function saveDiff($productId,$diff){
        $product = DB::table('amazon_products')->where('id',$productId)->first();
        if($product){
            for($j=1;$j<=5;$j++){
                $ld = $product->{"d$j"};
                if($ld==0){
                    $product->{"d$j"} = $diff;
                    $product->save();
                    break;
                }
            }
        }
    }

    /**
     * 第二步 初步统计
     * 统计差距等级占比情况
     * 1,2,3,4,5 可以分5个档次
     *
     * @return mixed
     */
    public function statisticsDiff($diifTime=1){
        $count = Cache::remember('amazon-product-count',4320,function (){
           return DB::table('amazon_products')->count();
        });
        $diifTime = "d$diifTime";
        $diffLevels = Cache::remember('amazon-product-diff-levels-'.$diifTime,4320,function () use($diifTime,$count){
            $diffLevels=['count'=>$count];
            $levels[]=100;
            $levelstr =  Setting::getPathValue('amazon-product-rank-diff-levels-'.$diifTime);
            if(empty($levelstr))$levelstr =  Setting::getPathValue('amazon-product-rank-diff-levels');
            if($levelstr){
                $levelstrs =explode('|',$levelstr);
                $levels = array_merge($levels,$levelstrs);
            }
            foreach ($levels as $level){
                $diffLevels[$level]['level']=$level;
                $diffLevels[$level]['num']= DB::table('amazon_products')->where($diifTime,'>=',$level)->count();
                $diffLevels[$level]['proportion']=round(($diffLevels[$level]['num']/$count),2);
            }
            return $diffLevels;
        });
        return $diffLevels;
    }

}
