<?php

namespace App\Ado\Models\Tables\Cms;

use Illuminate\Database\Eloquent\Model;
use Strview;

class Page extends Model
{
    protected $table = 'pages';
    public $timestamps=false;

    public function scopeSearch($query, $value){
        return $query->where('url_key','like','%'.$value.'%')->orWhere('title','like','%'.$value.'%');
    }

    public function setUrlKeyAttribute($value){
        if(!empty($value)){
            $value =str_slug($value);
        }elseif(isset($this->attributes['title'])&& !empty($this->attributes['title'])){
            $value =str_slug($this->attributes['title']);
        }
        $this->attributes['url_key'] = $value;
    }

    /*
     * 把结果模板转换后存放在capacity属性里，直接取capacity
     */
    public function getCapacityAttribute($value){
        $value = isset($this->attributes['content'])?$this->attributes['content']:'';
          $_data['template']=$value;
        $_data['updated_at']=0;
        $_data['cache_key']=isset($this->attributes['url_key'])?$this->attributes['url_key']:'page';
        $value = Strview::make($_data)->render();
        return  $this->attributes['capacity']= $value;

    }
}
