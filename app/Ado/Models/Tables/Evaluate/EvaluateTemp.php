<?php

namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class EvaluateTemp extends Model
{
    protected $table='evaluate_temps';
    protected $fillable = ['domain', 'used', 'enable','shop','ad_url','redirect'];
    //
    public function evaluate_group(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\EvaluateGroup','id','group_id');
    }

    public function scopeSearch($query, $value){
        if(!empty($value)){
            return $query->where('domain','like','%'.$value.'%')->where('title','like','%'.$value.'%')
                ->orWhereHas('evaluate_group',function($q) use($value){
                    $q->where('group','like','%'.$value.'%');
                });
        }
        return $query;
    }
}
