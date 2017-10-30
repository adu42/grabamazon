<?php

namespace App\Models\Amazons;

use Illuminate\Database\Eloquent\Model;
use App\Models\Amazons\AmazonCategory;
use App\Models\Amazons\AmazonProduct;

class AmazonFocusTag extends Model
{
    protected $table = 'amazon_focus_tags';
    public $timestamps=false;
    protected $appends = ['items_count'];

    // protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        AmazonFocusTag::deleting(function($amazonFocusTag){
            $active = 0;
            AmazonCategory::where('name','like','%'.$amazonFocusTag->word.'%')->pluck('id','is_active')->chunk(100,function($categories) use ($active){
                foreach ($categories as $category){
                    AmazonProduct::where('catalog_id',$category->id)->update(['is_active'=>$active]);
                    $category->is_active=$active;
                    $category->save();
                }
            });
        });
    }



    /**
     * 设置属性
     * @param string $key
     * @param mixed $value
     * @return $this
     */

    public function setAttribute($key, $value)
    {
        if($key=='is_active' && $value==1 && $this->attributes['word'] && !empty($this->attributes['word'])){
            $this->activeWord($this->attributes['word']);
        }else if($key=='is_active' && !$value && $this->attributes['word'] && !empty($this->attributes['word'])){
            $this->unActiveWord($this->attributes['word']);
        }
        return parent::setAttribute($key, $value);
    }

    public function getItemsCountAttribute(){
        if(isset($this->attributes['word']) && !empty($this->attributes['word'])){
            $rs = AmazonProduct::where('name','like','%'.$this->attributes['word'].'%')->count();
            return $rs;
        }
        return '';
    }

    /**
     * 激活
     * 更新状态，active越大越优先
     * @param $word
     * @param int $active
     */

    public function activeWord($word,$active=2){
        foreach (AmazonCategory::where('name','like','%'.$word.'%')->cursor() as $category){
            AmazonProduct::where('catalog_id',$category->id)->update(['is_active'=>$active]);
            $category->is_active=$active;
            $category->save();
        }
        foreach (AmazonProduct::where('name','like','%'.$word.'%')->cursor() as $product){
            $product->is_active=$active;
            $product->save();
        }
    }
    /**
     * 取消
     * @param $word
     * @param int $active
     */

    public function unActiveWord($word,$active=-1){
        $this->activeWord($word,$active);
    }

    /**
     * 搜索
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSearch($query, $value){
        return $query->where('word','like','%'.$value.'%');
    }

}
