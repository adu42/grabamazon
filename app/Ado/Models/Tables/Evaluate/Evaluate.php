<?php namespace App\Ado\Models\Tables\Evaluate;

use Illuminate\Database\Eloquent\Model;

class Evaluate extends Model {

    protected $table='evaluates';

    protected $fillable = ['title','domain', 'screen', 'image','ip','hits','enable','online','cash_back_in'];


    /**
     * @return EvaluateGroup|null
     */
    public function evaluate_group(){
        return $this->hasOne('App\Ado\Models\Tables\Evaluate\EvaluateGroup','id','group_id');
    }

    /**
     * @return Review|null
     */
    public function reviews(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\Review','evaluate_id','id');
    }

    public function coupons(){
        $today = date('Y-m-d');
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\Coupon','evaluate_id','id')->where('enable',1)->where('begin','<=',$today)->where('expire','>=',$today);
    }
    /**
     * @return Question|null
     */
    public function questions(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\Question','evaluate_id','id');
    }

    public function users(){
        return $this->belongsToMany('App\Ado\Models\Tables\User\User','evaluate_user','evaluate_id','user_id')->wherePivot('pass','>=',0);
    }

    /**
     * 建议tips
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tips(){
        return $this->belongsToMany('App\Ado\Models\Tables\Evaluate\EvaluateGroupTip','evaluate_tips','evaluate_id','tip_id');
    }

    public function tips_success(){
        return $this->belongsToMany('App\Ado\Models\Tables\Evaluate\EvaluateGroupTip','evaluate_tips','evaluate_id','tip_id')->where('evaluate_group_tips.type',1)->orderBy('sort_order');
    }


    public function tips_notice(){
        return $this->belongsToMany('App\Ado\Models\Tables\Evaluate\EvaluateGroupTip','evaluate_tips','evaluate_id','tip_id')->where('evaluate_group_tips.type',2)->orderBy('sort_order');
    }

    public function tips_warning(){
        return $this->belongsToMany('App\Ado\Models\Tables\Evaluate\EvaluateGroupTip','evaluate_tips','evaluate_id','tip_id')->where('evaluate_group_tips.type',3)->orderBy('sort_order');
    }



    /**
     * 外链，允许是g+ FB TW等
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\EvaluateLink','evaluate_id','id');
    }

    public function evaluate_users(){
        return $this->hasMany('App\Ado\Models\Tables\Evaluate\EvaluateUser','evaluate_id','id');
    }
    /**
     * 注册域名验证码
     * @param $value
     */
    public function setVerificationCodeAttribute($value){
        if(empty($value) || !isset($this->attributes['verification_code']) || empty($this->attributes['verification_code'])){
            $value =  str_random(16);
            $this->attributes['verification_code']=$value;
        }
    }

    /**
     *
     * @param $value
     */
    public function setCashBackEndAttribute($value){
        if(isset($this->attributes['cash_back_in']) && $this->attributes['cash_back_in']){
            if(empty($value)|| !strtotime($value))$value=date('Y-m-d H:i:s',strtotime('+30 days'));
        }
        $this->attributes['cash_back_end']=$value;
    }

    public function setCashBackStartAttribute($value){
        if(isset($this->attributes['cash_back_in']) && $this->attributes['cash_back_in']){
            if(empty($value)|| !strtotime($value))$value=date('Y-m-d H:i:s');
        }
        $this->attributes['cash_back_start']=$value;
    }

    public function setCashBackInAttribute($value){
        if(isset($this->attributes['cash_back_end']) && isset($this->attributes['cash_back_start'])){
            $now = time();
            $begin =(int)strtotime($this->attributes['cash_back_start']);
            $end = (int)strtotime($this->attributes['cash_back_end']);
            if($end){
                $value=0;
                if($now>=$begin && $now<$end)$value=1;
            }
        }
        $this->attributes['cash_back_in']=$value;
    }

    public function getCashBackInAttribute($value){
        if(isset($this->attributes['cash_back_end']) && isset($this->attributes['cash_back_start'])){
            $now = time();
            $begin =(int)strtotime($this->attributes['cash_back_start']);
            $end = (int)strtotime($this->attributes['cash_back_end']);
            if($end){
                $value=0;
                if($now>=$begin && $now<$end)$value=1;
            }

        }
      return  $this->attributes['cash_back_in']=$value;
    }



    public function getStar1Attribute($value){
        if(isset($this->attributes['star_num']) && !empty($this->attributes['star_num']))
               $value= round($value/$this->attributes['star_num'],2)*100;
        return $value;
    }

    public function getStar2Attribute($value){
        if(isset($this->attributes['star_num']) && !empty($this->attributes['star_num']))
              $value= round($value/$this->attributes['star_num'],2)*100;
        return $value;
    }

    public function getStar3Attribute($value){
        if(isset($this->attributes['star_num']) && !empty($this->attributes['star_num']))
               $value= round($value/$this->attributes['star_num'],2)*100;
        return $value;
    }

    public function getStar4Attribute($value){
        if(isset($this->attributes['star_num']) && !empty($this->attributes['star_num']))
               $value= round($value/$this->attributes['star_num'],2)*100;
        return $value;
    }

    public function getStar5Attribute($value){
        if(isset($this->attributes['star_num']) && !empty($this->attributes['star_num']))
              $value= round($value/$this->attributes['star_num'],2)*100;
        return $value;
    }

    public function scopeSearch($query, $value){
        if(!empty($value)){
            return $query->where('domain','like','%'.$value.'%')
                ->orWhere('email','like','%'.$value.'%')->orderBy('enable','asc');
        }
        return $query->orderBy('id','desc');
    }

    public function scopeUser($query,$value){
        return $query->whereHas('users',function($q) use($value){
             $q->where('id','=',$value);
        });
    }

    public function scopeEnable($query,$value=1){
        return $query->where('enable',$value);
    }


    public function scopeKeyword($query,$value){
        return $query->orWhere('brand','like','%'.$value.'%')
            ->orWhere('domain','like','%'.$value.'%')
            ->orWhere('summary','like','%'.$value.'%')
            ->orWhere('content','like','%'.$value.'%')
            ->orWhereHas('evaluate_group',function($q) use($value){
            $q->where('group','like','%'.$value.'%');
        });
    }

    public function hasCoupon(){
        return count($this->coupons);
    }

}
