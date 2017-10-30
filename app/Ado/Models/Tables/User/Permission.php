<?php namespace App\Ado\Models\Tables\User;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

	//
    protected $table = 'permissions';

    /**
     * 根据权限找角色，一对多
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(){
        return $this->belongsToMany('App\Ado\Models\Tables\User\Role');
    }

    /**
     * 这个权限下有多少菜单，根据权限取菜单
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus(){
        return $this->belongsToMany('App\Ado\Models\Tables\User\Menu');
    }

    /**
     * 根据权限找页面
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages(){
        return $this->belongsToMany('App\Ado\Models\Tables\User\Page');
    }


}
