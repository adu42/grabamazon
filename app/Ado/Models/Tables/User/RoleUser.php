<?php namespace App\Ado\Models\Tables\User;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model {

	//
    protected $table = 'role_user';
    public $timestamps=false;
    protected $fillable = array('role_id', 'user_id');

}
