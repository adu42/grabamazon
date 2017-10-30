<?php namespace App\Ado\Models\Tables\User;

use Illuminate\Database\Eloquent\Model;

class MenuPermission extends Model {

	//
    protected $table = 'menu_permission';
    public $timestamps=false;
    protected $fillable = array('menu_id', 'permission_id');

}
