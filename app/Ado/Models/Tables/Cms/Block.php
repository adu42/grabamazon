<?php

namespace App\Ado\Models\Tables\Cms;

use Illuminate\Database\Eloquent\Model;
use Strview;
use Blade;
use View;
use Context;

class Block extends Model
{
    //
    protected $table = 'block';
    public $timestamps=false;

    public function scopeSearch($query, $value){
        return $query->where('identifier','like','%'.$value.'%');
    }

    public function setIdentifierAttribute($value){
        $value = str_slug($value);
        $this->attributes['identifier']=$value;
    }

    /*
    * 把结果模板转换后存放在capacity属性里，直接取capacity
     * 清除本身块的死循环渲染
    */
    public function getCapacityAttribute($value){
        $value = isset($this->attributes['content'])?$this->attributes['content']:'';
        $identifier = isset($this->attributes['identifier'])?$this->attributes['identifier']:'';
        $self = ['Widget::block(\''.$identifier.'\')','Widget::run(\'block\','.$identifier.'\')'];
        $value = str_replace($self,'',$value);
        $_data['template']=$value;
        $_data['updated_at']=0;
        $_data['cache_key']=isset($this->attributes['identifier'])?$this->attributes['identifier']:'block';
        $value = Strview::make($_data)->render();
       return $this->attributes['capacity']= $value;
    }
}