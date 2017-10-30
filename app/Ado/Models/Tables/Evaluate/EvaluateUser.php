<?php

namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class EvaluateUser extends Model
{
    protected $table = 'evaluate_user';
    public $timestamps=false;
    protected $fillable = array('user_id', 'evaluate_id');

    public function reviews(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\Review','evaluate_id','evaluate_id');
    }

    public function evaluate(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\Evaluate','id','evaluate_id');
    }

    public function user(){
        return $this->hasOne('App\Ado\Models\Tables\User\User','id','user_id');
    }

    /**
     * 提取验证过的evaluate_id
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeUserPassEvaluate($query,$value){
        return $query->where('user_id',$value)->where('pass',1)->leftJoin('evaluates',function($join){ $join->on('evaluates.id','=','evaluate_id');});
    }

}
