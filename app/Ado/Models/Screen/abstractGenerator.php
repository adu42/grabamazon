<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-8-24
 * Time: 上午3:12
 */

namespace app\Ado\Models\Screen;
use Validator;

abstract class abstractGenerator {
    protected $values =array();

    //获得命令
    abstract public function  getCommand();

    //可执行命令存放路径
    public function cutycapt_path(){
        return __DIR__ . '/Bin/CutyCapt';
    }

    //可执行命令存放路径
    public function xvfb_run_path(){
        return __DIR__ . '/Bin/xvfb-run';
    }

    //验证命令参数
    public function  validator($value, $rules){
        $method = camel_case($rules['validate']);
        if (method_exists($this, $method)) return $this->$method($value, $rules);
        return Validator::single($value, $rules);
    }

    /** 以下是构造器 **/
    protected function setter($key, $value)
    {
        $key = str_replace('_', '-', $key);
        if (isset($this->values[$key])) $this->values[$key]['value'] = $value;
        return $this;
    }

    protected function getter($key)
    {
        $key = str_replace('_', '-', $key);
        return isset($this->values[$key]) && isset($this->values[$key]['value']) ? $this->values[$key]['value'] : null;
    }

    public function __call($method, $parameters)
    {
        switch (substr(snake_case($method), 0, 4))
        {
            case 'get_': return $this->getter(substr(snake_case($method), 4)); break;
            case 'set_': return $this->setter(substr(snake_case($method), 4), isset($parameters[0]) ? $parameters[0] : null); break;
            default: throw new \Exception('Method "' . $method . '" not found'); break;
        }
    }
}