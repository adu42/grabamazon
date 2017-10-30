<?php namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {
    protected $table='answers';
    protected $fillable = ['answer', 'question_id', 'user_id','ip','report_ip','report','report_email','report_user_id'];
    /**
     * 属于某个问题的回复
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function question(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\Question','id','question_id');
    }

    /**
     * 谁回复的
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne('App\Ado\Models\Tables\User\User','id','user_id');
    }


    public function scopeSearch($query,$value){
        if(empty($value))return $query;
        return $query->where('answer','like','%'.$value.'%');
    }
}
