<?php

namespace App\Ado\Models\Tables\Cms;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['title', 'email', 'content','enable'];

    public function scopeSearch($query, $value){
        return $query->where('email','like','%'.$value.'%')->orWhere('title','like','%'.$value.'%');
    }

}
