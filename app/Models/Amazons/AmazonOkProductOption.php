<?php

namespace App\Models\Amazons;

use Illuminate\Database\Eloquent\Model;

class AmazonOkProductOption extends Model
{
    protected $table = 'amazon_ok_product_options';
    public $timestamps=false;
    protected $guarded = [];

    public function values()
    {
        return $this->hasMany('App\Models\Amazons\AmazonOkProductOptionValue','option_id','id');
    }

    public function products(){
        return $this->belongsToMany('App\Models\Amazons\AmazonOkProduct','amazon_ok_product_option_provs','option_id','product_id');
    }

    public static function fieldTypes(){
        return [
            'drop_down'=>'Drop-down',
            'radio'=>'Radio',
            'checkbox'=>'Checkbox',
            'multiple'=>'Multiple Select',
            'field'=>'Text Field',
            'area'=>'TextArea',
            'file'=>'File',
        ];
    }
}
