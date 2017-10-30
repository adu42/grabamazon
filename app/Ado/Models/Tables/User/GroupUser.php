<?php namespace App\Ado\Models\Tables\User;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model {

	//
    protected $table = 'group_user';
    public $timestamps=false;
    protected $fillable = array('group_id', 'user_id');

}
