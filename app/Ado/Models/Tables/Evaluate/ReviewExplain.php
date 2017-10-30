<?php namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class ReviewExplain extends Model {

	//
    protected $table='review_explains';
    protected $fillable = ['review_id','explain','affiliated','company','ip'];


    //属于某个评论
    public function review(){
        return $this->belongsTo('App\Ado\Models\Tables\Evaluate\Review','review_id','id');
    }

    /**
     * 谁解释的
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne('App\Ado\Models\Tables\User\User','id','user_id');
    }

    /**
     * 没人查询
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSearch($query, $value){
        return $query->where('explain','like','%'.$value.'%')
            ->orWhereHas('review', function ($q) use ($value) {
                $q->where("title", "like", "%" . $value . "%");
            });
    }


}
