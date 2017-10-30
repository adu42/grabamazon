<?php

namespace App\Models\Amazons;

use Illuminate\Database\Eloquent\Model;

class AmazonOkProductOptionValue extends Model
{
    protected $table = 'amazon_ok_product_option_values';
    public $timestamps=false;
    protected $guarded = [];

    public function option()
    {
        return $this->hasOne('App\Models\Amazons\AmazonOkProductOption','id','option_id');
    }
}
