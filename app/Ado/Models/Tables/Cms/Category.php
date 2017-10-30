<?php namespace App\Ado\Models\Tables\Cms;

use Illuminate\Database\Eloquent\Model;
use App\Ado\Models\Constuct\Node;

class Category extends Node {

	//
    protected $table = 'categories';

    //public $timestamps=false;
    public function articles(){
        return $this->belongsToMany('App\Ado\Models\Tables\Cms\Article');
    }

    public function scopeSearch($query, $value){
        return $query->where('name','like','%'.$value.'%')
            ->orWhere('title','like','%'.$value.'%')
            ->orderBy('_lft');
    }
}
