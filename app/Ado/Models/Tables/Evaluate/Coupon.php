<?php namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;
use App\Ado\Models\Tables\Evaluate\Evaluate;
use App\Ado\Models\Screen\DomainCheck;
use Currency;

class Coupon extends Model {

	//
    protected $table='coupons';

    protected $fillable = ['coupon', 'evaluate_id', 'user_id'];

    /**
     * 属于哪个网站的优惠券 一对一
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function evaluate(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\Evaluate','id','evaluate_id');
    }

    /**
     * 信息发布人 一对一关系
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne('App\Ado\Models\Tables\User\User','id','user_id');
    }

    public function getOffPriceAttribute($value){
        if(!isset($this->attributes['currency']) || empty($this->attributes['currency'])){
            $this->attributes['currency']='USD';
        }
        $value = $this->attributes['off_price']=Currency::format($this->attributes['discount'],$this->attributes['currency']);
        return $this->attributes['off_price'];
    }

    /**
     * 在加入网址的时候，查找是否有关联的评价网址，没有，就加入没有的行列，有就加 evaluate_id
     * @param $value
     * @return $this
     */
    public function setSiteAttribute($value){
        $check = new DomainCheck();
        $domain = $check->getDomain($value);
        $evaluate = Evaluate::where('domain',$domain)->first();
        if($evaluate){
            $this->attributes['evaluate_id']=$evaluate->id;
        }
    }

    public function scopeUsers($query,$value){
        return $query->where('user_id',$value);
    }

    /**
     * scope self
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSearch($query,$value){
        if(!empty($value)){
            return $query->where('coupon','like','%'.$value.'%')
                ->orWhereHas('evaluate',function($q) use ($value){
                    $q->where('domain','like','%'.$value.'%');
                });
        }
        return $query;
    }
}
