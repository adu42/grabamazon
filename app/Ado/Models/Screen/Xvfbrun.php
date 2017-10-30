<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-8-24
 * Time: 上午1:45
 */

namespace App\Ado\Models\Screen;
use App\Ado\Models\Screen\XvfbrunGenerator as CommandGenerator;

class Xvfbrun {
    protected $CommandGenerator;
    protected static $debug_mode;

    function __construct(CommandGenerator $commandGenerator)
    {
        $this->CommandGenerator = $commandGenerator;
    }

    protected function getter($key)
    {
        $method = 'get' . ucfirst(camel_case($key));
        return $this->CommandGenerator->$method();
    }

    protected function setter($key, $value)
    {
        $method = 'set' . ucfirst(camel_case($key));
        $this->CommandGenerator->$method($value);
        return $this;
    }

    public function run()
    {
        $command = $this->CommandGenerator->getCommand();
        exec($command);
        return $this;
    }

    public static function debug($mode = 0)
    {
        self::$debug_mode = $mode;
        CommandGenerator::debug($mode);
    }

    public function __call($method, $parameters)
    {
        switch(substr(snake_case($method), 0, 4))
        {
            case 'get_': return $this->getter(substr(snake_case($method), 4)); break;
            case 'set_': return $this->setter(substr(snake_case($method), 4), isset($parameters[0]) ? $parameters[0] : null); break;
            default: throw new \Exception('Method "' . $method . '" not found'); break;
        }
    }

    public static function __callStatic($method, $parameters)
    {
        switch(snake_case($method))
        {
            default: throw new \Exception('Method "' . $method . '" not found'); break;
        }
    }

}
