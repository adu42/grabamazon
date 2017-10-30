<?php

namespace App\Models\Amazons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AmazonOkProductImage extends Model
{
    protected $table = 'amazon_ok_product_images';
    public $timestamps=false;
    protected $guarded = [];

    public function product()
    {
        return $this->hasOne('App\Models\Amazons\AmazonOkProduct','id','product_id');
    }
}
