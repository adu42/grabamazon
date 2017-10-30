<?php

namespace App\Models\Amazons;

use Illuminate\Database\Eloquent\Model;

class AmazonHtmlRules extends Model
{
    protected $table = 'amazon_html_rules';
    protected $fillable = ['label', 'rule_name', 'kind','query_selector_1','query_selector_2','query_selector_3','query_selector_4','query_selector_5'];

    public $timestamps=false;
    const TYPE_CATALOG =1;
    const TYPE_PEODUCT =2;

    /**
     * @return array
     * //规则类别
     */
    public static function getTypes($type=null){
        $types = [self::TYPE_CATALOG=>'Catalog',self::TYPE_PEODUCT=>'Product'];
        return isset($types[$type])?$types[$type]:$types;

    }
    /**
     * 规则名称,我要找的亚马逊的数据
     * rule_name
     */
    public static function getRuleNames(){
        return [
            'Catalog'=>[
            '1.name'=>'Name',
            '1.url'=>'Url',
            '1.keywords'=>'Keywords',
            '1.description'=>'Description',
            '1.invalid_url'=>'Invalid Url',
            ],
            'Product'=>[
            '2.name'=>'Name',
                '2.price' => 'Price',
            '2.url'=>'Url',
            '2.keywords'=>'Keywords',
            '2.asin'=>'商品编码asin',
            '2.rank'=>'排序Rank',
                '2.image' => '商品Image',
                '2.images' => '商品gallery',
            '2.mbc'=>'跟卖数mbc',
            '2.reviews'=>'评论数reiews',
            '2.asks'=>'问答数asks',
                '2.description' => '商品description',
                '2.info' => '商品info',
                '2.size' => '商品size',
                '2.color' => '商品color',
                '2.attribute' => '商品attribute',
           // '2.invalid_url'=>'Invalid Url',
            ]
        ];
    }
    /**
     * //字符搜素
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSearch($query, $value){
        return $query->where('rule_name','like','%'.$value.'%')->orWhere('label','like','%'.$value.'%');
    }

    /**
     * //规则类别
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeType($query, $value){
        if(empty($value))return $query;
        return $query->where('kind','=',$value);
    }

    /**
     * //规则名称
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeRuleName($query, $value){
        if(empty($value))return $query;
        return $query->where('rule_name','=',$value);
    }


    public function setKindAttribute($value)
    {
         if(isset($this->attributes['rule_name'])){
            $_types = explode('.',$this->attributes['rule_name']);
            if(count($_types)==2){
                 $this->attributes['rule_name']=$_types[1];
                 $this->attributes['kind']=$_types[0];
            }
        }
    }




}
