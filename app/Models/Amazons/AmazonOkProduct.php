<?php

namespace App\Models\Amazons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class AmazonOkProduct extends Model
{
    protected $table = 'amazon_ok_products';
    public $timestamps=false;
    protected $guarded = [];
    public function category()
    {
        return $this->hasOne('App\Models\Amazons\AmazonOkCategory','id','catalog_id');
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

    public function scopeCrawler($query)
    {
        return $query->where('is_active', '=', '0');
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('asin', 'like', '%' . $value . '%')->orWhere('url', 'like', '%' . $value . '%');
    }

    /**
     * 取随机数据
     * @param $query
     * @return mixed
     */
    public function scopeActive($query, $value = 1)
    {
        return $query->where('is_active', '>=', 1);
    }

    public function scopeSortActiveDesc($query)
    {
        return $query->orderBy('id','desc')->orderBy('is_active', 'asc');
    }

    public function images(){
        return $this->hasMany('App\Models\Amazons\AmazonOkProductImage','id','product_id');
    }

    public function options(){
        return $this->belongsToMany('App\Models\Amazons\AmazonOkProductOption','amazon_ok_product_option_provs','product_id','option_id');
    }

    public function toMagento(){
        $images = $this->images();
        $first = $images->first();
        if(!$first)return [];
        return [
            'image'=> $first->image,
            'gallimg'=> implode(';',$images->pluck('image')->all()),
            'small_image'=>$first->image,
            'thumbnail'=>$first->image,
            'typecsvname'=> $this->getAttribute('typecsvname'),
            'store'=>'admin',
            'websites'=>'base',
            'attribute_set'=>$this->getAttribute('typecsvname'),
            'type'=>'simple',
            'category_ids'=>'2',
            'sku'=>$this->getAttribute('asin'),
            'options_container'=>'Product Info Column',
         //   'is_imported'=>'',
            'has_options'=>'0',
            'name'=>$this->getAttribute('name'),
            'url_key'=>'',
            'meta_title'=>$this->getAttribute('name'),
            'meta_description'=>'',
         //   'gender'=>'',
            'url_path'=>'',
            'price'=>$this->getAttribute('price'),
            'special_price'=>'',
            'weight'=>'1000',
            'meta_keyword'=>'',
            'description'=>'',
            'short_description'=>$this->getAttribute('description'),
            'special_from_date'=>'',
            'news_from_date'=>date('Y-m-d H:i:s'),
            'news_to_date'=>'',
            'status'=>'Enabled',
            'visibility'=>'Catalog, Search',
            'tax_class_id'=>'None',
            'qty'=>'59',
            'is_in_stock'=>'1',
            'store_id'=>'0',
        ];
    }

}
