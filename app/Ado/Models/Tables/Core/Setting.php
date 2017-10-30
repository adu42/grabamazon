<?php namespace App\Ado\Models\Tables\Core;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

	//
    protected $table = 'setting';
    public $timestamps=false;

    public function SettingGroup(){
        return $this->hasOne('App\Ado\Models\Tables\Core\SettingGroup','id','group_id');
    }

    //查询
    public function scopeSearch($query, $value)
    {
        return $query->where('path', 'like', '%' . $value . '%')
            ->orWhere('description', 'like', '%' . $value . '%')
            ->orWhere('value', 'like', '%' . $value . '%')
            ->orWhereHas('SettingGroup', function ($q) use ($value) {
                $q->where('group', 'like', '%' . $value . '%');
            });
    }

    //查询组
    public function scopeGroup($query, $value)
    {
        return $query->whereHas('SettingGroup', function ($q) use ($value) {
                $q->where('group', '=',  $value );
            });
    }

    //从数据库中获取一个配置项值
    public static function getPathValue($key,$default=null){
        $clone =  self::where('path','=',$key)->first();
        if($clone)return $clone->value;
        return $default;
    }

    /**
     * 获得一组数据
     * @param $key
     * @param null $default
     * @return null
     */
    public static function getPathsValue($key){
        $clone =  self::where('path','like',"$key%")->get();
        if($clone)return $clone;
        return false;
    }


}
