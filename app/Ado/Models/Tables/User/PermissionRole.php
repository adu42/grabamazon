<?php namespace App\Ado\Models\Tables\User;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model {

	//
    protected $table = 'permission_role';
    public $timestamps=false;
    protected $fillable = array('role_id', 'permission_id');
}
