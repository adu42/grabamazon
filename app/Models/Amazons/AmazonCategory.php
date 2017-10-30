<?php

namespace App\Models\Amazons;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class AmazonCategory extends Model
{
    use Searchable;
    protected $table = 'amazon_categoies';
    public $timestamps=false;
   // protected $fillable = ['label', 'name', 'url','keywords','update_time'];
    protected $guarded = [];


    public function products()
    {
        return $this->hasMany('App\Models\Amazons\AmazonProduct','catalog_id','id');
    }

    public function scopeSearch($query, $value){
        return $query->where('name','like','%'.$value.'%')->orWhere('keywords','like','%'.$value.'%');
    }
    public function scopeActive($query){
        return $query->where('is_active','=',1);
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
        //return $query->inRandomOrder();
    }

    public function scopeStep($query,$value=1){
        return $query->where('step','=',$value);
    }

    public function scopeSortActiveDesc($query){
        return $query->orderBy('is_active','desc');
    }

    public function resetAllUnActive(){
        DB::table($this->table)->update(['is_active'=>0]);
    }

}
