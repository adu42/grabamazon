<?php namespace App\Ado\Models\Tables\User;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    protected $table='groups';
    public $timestamps=false;

    public function users(){
        return $this->belongsToMany('App\Ado\Models\Tables\User\User');
    }
}
