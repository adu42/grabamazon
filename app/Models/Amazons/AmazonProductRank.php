<?php

namespace App\Models\Amazons;

use Illuminate\Database\Eloquent\Model;

class AmazonProductRank extends Model
{
    protected $table = 'amazon_product_ranks';
    public $timestamps=false;
    protected $guarded = [];

    public function product()
    {
        return $this->hasOne('App\Models\Amazons\AmazonProduct','id','product_id');
    }
    public function catalog(){
        return $this->hasOne('App\Models\Amazons\AmazonCategory','id','catalog_id');
    }

    public function scopeSearch($query, $value){
        return $query->where('asin','like','%'.$value.'%')->orWhereHas('product',function($q) use($value){
            $q->where('name','like','%'.$value.'%');
        })->orWhereHas('catalog',function($q) use($value){
                $q->where('name','like','%'.$value.'%');
        });
    }

    /**
     * 取n天前的数据
     * @param $query
     * @param int $days
     * @return mixed
     */
    public function scopeBeforeDays($query,$days=1){
        $update_time = date('Y-m-d H:i:s',strtotime("-$days days"));
        return $query->where('update_time','<',$update_time)->orderBy('rand()');
    }

    /**
     * 取随机数据
     * @param $query
     * @return mixed
     */
    public function scopeRand($query){
        return $query->orderBy(DB::raw('RAND()'));
    }

    /**
     * 抓取次数
     * @param $query
     * @param int $value
     * @return mixed
     */
    public function scopeStep($query,$value=1){
        return $query->where('step','=',$value);
    }

    /**
     * 差异排序
     * @param $query
     * @return mixed
     */
    public function scopeDlist($query,$increase=0){
        for ($i=1;$i<=5;$i++){

            if($increase){
                if($i==1){
                    $query->where("d{$i}",'>','0');
                }else{
                    $query->where("d{$i}",'>=','0');
                }
            }
                $query->orderBy("d{$i}",'desc');
        }

        return $query;
    }

    /**
     * 跟卖筛选
     * @param $query
     * @return mixed
     */
    public function scopeMbc($query){
        return $query->where('mbc','>',0);
    }

    /**
     * 差异筛选
     * @param $query
     * @return mixed
     */
    public function scopeThousandRank($query){
        return $query->where('rank','>',0)->where('rank','<',3000);
    }

    public function scopeProductFocus($query){
        return $query->whereHas('product',function ($q) {
            $q->where('is_active',1);
        });
    }
}
