<?php

namespace App\Ado\Models\Tables\Talk;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    protected $table = 'talk';
    //
    public function talk_shows()
    {
        return $this->hasMany('App\Ado\Models\Tables\Talk\TalkShow','talk_id','id');
    }

    public function talk_comments()
    {
        return $this->hasMany('App\Ado\Models\Tables\Talk\TalkComments','talk_id','id');
    }


}
