<?php
namespace App\Ado\Libraries;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/30
 * Time: 16:30
 * * Class Context
 * @package \Libraries
 */
class Context
{

    /**
     * Saves our current context for static facades
     * @var string
     */
    protected $data;

    protected $current;
    /**
     * Gets the current context
     *
     * @return string
     */
    public function current()
    {
        return  $this->current;
    }

    /**
     * 保存对象
     * @param $key
     * @param $val
     */
    public function set($key,$val,$array = false){
        if($array){
            $this->data[$key][]=$val;
        }else{
            $this->data[$key]=$val;
        }
    }

    /**
     * 取对象
     */
    public function get($key,$default=null){
        $this->current = isset($this->data[$key])?$this->data[$key]:$default;
        return $this->current;
    }

}