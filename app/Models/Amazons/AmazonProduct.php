<?php

namespace App\Models\Amazons;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class AmazonProduct extends Model
{
    use Searchable;
    protected $table = 'amazon_products';
    public $timestamps=false;
    protected $guarded = [];
    public function category()
    {
        return $this->hasOne('App\Models\Amazons\AmazonCategory','id','catalog_id');
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
    public function scopeSearch($query, $value){
        return $query->where('asin','like','%'.$value.'%')->orWhere('name','like','%'.$value.'%');
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
    public function scopeActive($query,$value=1){
        return $query->where('is_active','>=',1);
    }
    public function scopeSortActiveDesc($query){
        return $query->orderBy('is_active','desc');
    }

    public function resetAllUnActive(){
        DB::table($this->table)->update(['is_active'=>0]);
    }
}
