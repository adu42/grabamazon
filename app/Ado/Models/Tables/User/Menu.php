<?php namespace App\Ado\Models\Tables\User;

use Illuminate\Database\Eloquent\Model;
use App\Ado\Models\Constuct\Node;
use DB;


class Menu extends Node {
    protected $table='menus';
    protected $fillable = ['name','image','url_key','description','is_top','is_active'];
    public $timestamps=false;

    /**
     * 1、获得所有子节点
     * 2、获得所在的父根节点和父节点
     * 3、
     * @param User $user
     * @return array
     */
    public function scopeSearch($query,$value){
        return $query->where('name','like','%'.$value.'%')
            ->orWhere('url_key','like','%'.$value.'%');
    }


}
