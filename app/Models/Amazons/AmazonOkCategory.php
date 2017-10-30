<?php

namespace App\Models\Amazons;

use Illuminate\Database\Eloquent\Model;

class AmazonOkCategory extends Model
{
    protected $table = 'amazon_ok_categoies';
    public $timestamps=false;
    protected $guarded = [];
    public function products()
    {
        return $this->hasMany('App\Models\Amazons\AmazonProduct','catalog_id','id');
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
    public function scopeStep($query,$value=1){
        return $query->where('step','=',$value);
    }
}
