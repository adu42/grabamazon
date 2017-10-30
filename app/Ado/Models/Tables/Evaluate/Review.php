<?php namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

	//
    protected $table='reviews';
    protected $fillable = ['evaluate_id','review','title','rating','service','value','shipping','returns','quality','ip','external_link_count','bad_word_count','enable','user_id','helpful','created_at','updated_at'];

    /**
     * 评论属于哪个站
     * @return Evaluate|| null
     */
    public function evaluate(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\Evaluate','id','evaluate_id');
    }

    public function evaluate_user(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\EvaluateUser','evaluate_id','evaluate_id');
    }
    //评论图片
    public function images(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\ReviewImage','review_id','id');
    }
    //评论解释
    public function review_explain(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\ReviewExplain','review_id','id');
    }

    /**
     * 谁发表的
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne('App\Ado\Models\Tables\User\User','id','user_id');
    }

    public function setServiceAttribute($value){
        if($value>0){
            $this->attributes['service']=$value;
        }elseif(isset($this->attributes['rating'])){
            $this->attributes['service']=$this->attributes['rating'];
        }
    }

    public function setValueAttribute($value){
        if($value>0){
            $this->attributes['value']=$value;
        }elseif(isset($this->attributes['rating'])){
            $this->attributes['value']=$this->attributes['rating'];
        }
    }

    public function setShippingAttribute($value){
        if($value>0){
            $this->attributes['shipping']=$value;
        }elseif(isset($this->attributes['rating'])){
            $this->attributes['shipping']=$this->attributes['rating'];
        }
    }

    public function setReturnsAttribute($value){
        if($value>0){
            $this->attributes['returns']=$value;
        }elseif(isset($this->attributes['rating'])){
            $this->attributes['returns']=$this->attributes['rating'];
        }
    }

    public function setQualityAttribute($value){
        if($value>0){
            $this->attributes['quality']=$value;
        }elseif(isset($this->attributes['rating'])){
            $this->attributes['quality']=$this->attributes['rating'];
        }
    }

    /*
   * 把结果存放在capacity属性里，直接取capacity
   * 如果有badword，替换成**输出，然后汇总进表里
   *
   */
    public function getCapacityAttribute($value){
        $value = isset($this->attributes['review'])?$this->attributes['review']:'';
        $value = str_bad_word_filter($value);
        if(!isset($this->attributes['bad_word_count']) || $this->attributes['bad_word_count']){
            $this->attributes['bad_word_count'] = bad_word_count($value);
            if($this->attributes['bad_word_count']){
                $this->update(['bad_word_count'=>$this->attributes['bad_word_count']]);
            }
        }
        return $this->attributes['capacity']= $value;
    }



    /**
     * user's 如果是有域名的商家
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function scopeUsers($query,$value){
        return $query->whereHas('evaluate_user',function($q) use($value){
            $q->where('user_id',$value);
        })->orderBy('created_at','desc');
    }

    public function scopeUsersCashBackOrders($query,$value){
        return $query->whereHas('evaluate_user',function($q) use($value){
            $q->where('user_id',$value);
        })->where('cash_back_in',1)
            ->where('cash_back_order_number','!=','')
            ->orderBy('created_at','desc');
    }


    public function scopeUsersCashBackMyOrders($query,$value){
        return $query->where('user_id',$value)->where('cash_back_in',1)
            ->where('cash_back_order_number','!=','')
            ->orderBy('created_at','desc');
    }

    /**
     * user's 如果是无域名的客户
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeMyReview($query,$value){
        return $query->where('user_id',$value);
    }


    public function scopeSearch($query, $value){
        if(!empty($value)){
            return $query->where('title','like','%'.$value.'%')
                ->orWhere('review','like','%'.$value.'%');
        }
        return $query;
    }

    public function scopeEnable($query, $value){
        $value = (int)$value;
        return $query->where('enable','=',$value);
    }

    public function scopeUsersCashBackOrdersSearch($query, $value){
        if(!empty($value)){
            return $query->where('title','like','%'.$value.'%')
                ->orWhere('cash_back_order_number','like','%'.$value.'%');
        }
        return $query;
    }
}
