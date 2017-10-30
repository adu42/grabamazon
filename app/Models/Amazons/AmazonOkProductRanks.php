<?php

namespace App\Models\Amazons;

use Illuminate\Database\Eloquent\Model;

class AmazonOkProductRanks extends Model
{
    protected $table = 'amazon_ok_product_ranks';
    public $timestamps=false;
    protected $guarded = [];
    public function product()
    {
        return $this->hasOne('App\Models\Amazons\AmazonOkProduct','product_id','id');
    }
    public function catalog(){
        return $this->hasOne('App\Models\Amazons\AmazonOkCategory','catalog_id','id');
    }
    public function scopeStep($query,$value=1){
        return $query->where('step','=',$value);
    }
}
