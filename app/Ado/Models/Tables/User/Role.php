<?php namespace App\Ado\Models\Tables\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	//
    protected $table = 'roles';

    /**
     * 根据角色找用户，某角色下有多个用户，一对多
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany('App\Ado\Models\Tables\User\User');
    }

    /**
     * 根据角色找权限，一个角色多个权限，一对多
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(){
        return $this->belongsToMany('App\Ado\Models\Tables\User\Permission');
    }



}
