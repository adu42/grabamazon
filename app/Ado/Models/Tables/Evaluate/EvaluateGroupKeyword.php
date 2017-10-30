<?php

namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class EvaluateGroupKeyword extends Model
{
    protected $table='evaluate_group_keywords';
    protected $fillable = ['keyword', 'used', 'enable'];
    //
    public function evaluate_group(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\EvaluateGroup','id','group_id');
    }

    public function scopeSearch($query, $value){
        if(!empty($value)){
            return $query->where('keyword','like','%'.$value.'%')
                ->orWhereHas('evaluate_group',function($q) use($value){
                    $q->where('group','like','%'.$value.'%');
                });
        }
        return $query;
    }
}
