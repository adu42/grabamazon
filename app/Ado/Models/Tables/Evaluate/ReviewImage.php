<?php namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model {

	//
    protected $table='review_images';
    protected $fillable = ['review_id','image','thumbnail'];
    public $timestamps=false;

    //属于某个评论
    public function review(){
        return $this->belongsTo('App\Ado\Models\Tables\Evaluate\Review','id','review_id');
    }

}
