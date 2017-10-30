<?php namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EvaluateGroup extends Model {

	//
    protected $table='evaluate_groups';
    protected $fillable = ['group', 'logo', 'icon','description','related','is_top','reviews','hits','sort_order'];
    public $timestamps=false;

    public function evaluates(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\Evaluate','group_id','id');
    }

    /**
     * 关键词
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function keywords(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\EvaluateGroupKeyword','group_id','id');
    }

    /**
     * 搜刮的域名，暂存的
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function temp_domain(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\EvaluateTemp','group_id','id');
    }

    public function getRouteKey()
    {
        return $this->url_path;
    }

    /**
     * 获得urlpath
     * @param $value
     * @return string
     */
    public function getUrlPathAttribute($value){
        $value = trim($value);
        if(empty($value))$value=str_slug($this->attributes['group']);
        return $value;
    }

    /**
     * 设置urlpath
     * @param $value
     */
    public function setUrlPathAttribute($value){
        if(empty($value))$value=$this->attributes['group'];
        $value = str_slug($value);
        $this->attributes['url_path'] = $value;
    }




}
