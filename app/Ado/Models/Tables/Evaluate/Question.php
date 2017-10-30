<?php namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

	//
    protected $table='questions';

    protected $fillable = ['question', 'evaluate_id', 'user_id','ip','report_ip','report','report_email','report_user_id'];

    /**
     * 有多个回复
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\Answer','question_id','id');
    }

    /**
     * 属于某个网站
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function evaluate(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\Evaluate','id','evaluate_id');
    }

    /**
     * 谁提问的
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne('App\Ado\Models\Tables\User\User','id','user_id');
    }


    public function scopeSearch($query,$value){
        if(empty($value))return $query;
        return $query->where('question','like','%'.$value.'%');
    }
}
