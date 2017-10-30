<?php namespace App\Ado\Models\Tables\User;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Ado\Models\Tables\User\Menu;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password','nickname','gender','province','city','year','avatar','domain_in','cash_back_in','post_in','comment_in','email_verified','virtual'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /**
     * 是否过屏蔽期限
     * bad_expire
     * @param $value
     */
    public function setBadExpireAttribute($value){
         if(is_numeric($value)){
             $haveDay=0;
             if(isset($this->attributes['bad_expire']) && $this->attributes['bad_expire']){
                 $haveDay = strtotime($this->attributes['bad_expire'])-time()-86400;
                 $haveDay=($haveDay>0)?ceil($haveDay/86400):0;
             }
             $value+=$haveDay;
             if($value<100 && $value>1){
                 $value =$this->attributes['bad_expire']= date('Y-m-d H:i:s',strtotime("+$value days"));
             }elseif($value==1||$value==-1){
                 $value =$this->attributes['bad_expire']= date('Y-m-d H:i:s',strtotime("$value day"));
             }elseif($value<-1){
                 $value =$this->attributes['bad_expire']= date('Y-m-d H:i:s',strtotime("$value days"));
             }
         }
    }

    public function isInPrison(){
        $haveDay=0;
        if(isset($this->attributes['bad_expire']) && $this->attributes['bad_expire']){
            $haveDay = strtotime($this->attributes['bad_expire'])-time()-86400;
              $haveDay=($haveDay>0)?ceil($haveDay/86400):0;
        }
        return $haveDay;
    }
    /**
     * 用户多角色
     * */
    public function roles(){
        return $this->belongsToMany('App\Ado\Models\Tables\User\Role');
    }

    /**
     * 用户文章
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(){
        return $this->hasMany('App\Ado\Models\Tables\Cms\Article');
    }

    /**
     * 用户所在的组，多对多
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups(){
        return $this->belongsToMany('App\Ado\Models\Tables\User\Group');
    }

    /**
     * 用户拥有网站
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluates(){
        return $this->belongsToMany('App\Ado\Models\Tables\Evaluate\Evaluate','evaluate_user','user_id','evaluate_id');
    }

    public function evaluate_users(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\EvaluateUser','user_id','id');
    }

    public function evaluate_links(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\EvaluateLinks','user_id','id');
    }
    /**
     * @param $value
     */
    public function setHasDomainAttribute($value){
        if($value){
            $this->attributes['has_domain']=$value;
        }else{
            if($this->evaluates){
                $this->attributes['has_domain']=1;
            }
        }
    }

    /**
     * 有域名，已验证域名是否是这个用户的
     * @param $value
     * @return mixed
     */
    public function getHasDomainAttribute($value){
        if($value){
            $this->attributes['has_domain']=$value;
        }else{
            if($this->evaluate_users && $this->evaluate_users->count()){
                foreach($this->evaluate_users as $evaluate_user){
                    if($evaluate_user->pass){
                        $this->attributes['has_domain']=1;
                        break;
                    }
                }
                //$this->attributes['has_domain']=1;
            }
        }
        return $this->attributes['has_domain'];
    }




    public function getWavatarAttribute($value){
        if(isset($this->attributes['avatar']))
            $this->attributes['wavatar'] = avatar_to(config('gravatar.path') . $this->attributes['avatar'], 'x80', null, ['class' => 'img-thumbnail']);

    }


    public function menus(){
        $ids = $this->getMenuIds();
        if(!empty($ids)){
            return Menu::whereIn('id',$ids)->orderBy('_lft')->get();
        }
        return false;
    }

    public function getMenuIds(){
        $memuIds = array();
        $userRoles = $this->roles;
        if($userRoles){
            foreach($userRoles as $role){
                $permissions =  $role->permissions;
                if($permissions){
                    foreach($permissions as $permission){
                        if($permission->menus->count()){
                            foreach($permission->menus as $menu){
                                $memuIds[$menu->id] =  $menu->id;
                            }
                        }
                    }
                }
            }
        }
        return $memuIds;
    }

    /*
     * 过滤范围
     * Rapyd DI $query
     * Illuminate\Database\Eloquent\Builder $query
     * string $value
     *
     * */
    public function scopeSearch($query, $value)
    {
        return $query->where('name','like','%'.$value.'%')
            ->orWhere('email','like','%'.$value.'%')
            ->orWhereHas('groups',function($q) use ($value){
                $q->where('group_id','=',$value);
             });
        /*
            ->orWhereHas('author', function ($q) use ($value) {
                $q->whereRaw(" CONCAT(, ' ', lastname) like ?", array("%".$value."%"));
            })->orWhereHas('categories', function ($q) use ($value) {
                $q->where('name','like','%'.$value.'%');
            });
        */
    }
    /**
     * 审核角色
     */
    public function isRole($roleName=''){
        if(empty($roleName))return false;
        $roles = $this->roles;
        $has = false;
        foreach($roles as $role){
            if($role->name == $roleName)$has=true;
        }
        return $has;
    }


}
