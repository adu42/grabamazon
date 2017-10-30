<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-8-24
 * Time: 上午1:42
 */

namespace App\Ado\Models\Screen;
use Symfony\Component\Process\Process;
use App\Ado\Models\Screen\CutyCaptGenerator as CommandGenerator;
use Image;
use File;



class CutyCapt {
    protected $timeout=false;
    protected $CommandGenerator;
    protected static $debug_mode;
    protected $fileWebPath = '';
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

    public function url($value)
    {
        return $this->setter('url', $value);
    }

    public function output($value = null)
    {
        if ($value) $this->CommandGenerator->setOut($value);
        return $this->run();
    }

    public function cuteScreenOne($file,$size){
        if(empty($file)){
        $out = $this->getOut();
        $base = CommandGenerator::$base_output;
        $file = $base . $out;
        }
        if(!empty($file)){
            $resize_path = ltrim(config('app.image_web_path.'.$size),'/');
            $sizes = config('app.images_size.'.$size);
          //  $size = config('app.images_size.x360240');
            if(!File::isDirectory($resize_path)){
                File::makeDirectory($resize_path,  $mode = 0744,true,true);
            }
            $_files = explode('/',$file);
            $out =  end($_files);
            if(file_exists($file)){
                Image::make($file)->fit($sizes['width'],$sizes['height'],function ($constraint) {
                    $constraint->upsize();
                },'top')->save($resize_path.$out);
                $this->fileWebPath = '/'.$resize_path.$out;
            }
        }
    }

    public function show($value=null,$cuteOneScreen=false)
    {
        $file = $this->getFile($value=null,$cuteOneScreen=false);
        header("Content-type: image/png");
        readfile("$file");
        exit;
    }

    public function getFile($value=null,$cuteOneScreen=false,$size='x400300')
    {
        if($value)$this->output($value);
        $out = $this->getOut();
        $base = CommandGenerator::$base_output;
        $file = $base . $out;
        @chmod($file,0777);
        if($cuteOneScreen)
        $this->cuteScreenOne($file,$size);
        return ($this->fileWebPath ?: $file);
    }

    public function run($useSudo=true)
    {
        $command = $this->CommandGenerator->getCommand();
        $command = escapeshellcmd($command);
        if(PHP_OS=='WINNT'){
            $command=str_replace('^','',$command);
           list($status,$output,$err)  = $this->executeCommand($command);
            if($status){
                throw new \Exception('ERR '.$err);
            }
        }

        if($useSudo)$command='/usr/bin/sudo '.$command;

        if(function_exists('shell_exec')){
            shell_exec($command);
        }else{
            throw new \Exception('Function shell_exec not found');
        }
        return $this;
    }
    protected function executeCommand($command)
    {
        $process = new Process($command, null, null);

        if (false !== $this->timeout) {
            $process->setTimeout($this->timeout);
        }

        $process->run();

        return array(
            $process->getExitCode(),
            $process->getOutput(),
            $process->getErrorOutput(),
        );
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
            case 'set_base_output': CommandGenerator::$base_output = isset($parameters[0]) ? $parameters[0] : null; break;
            default: throw new \Exception('Method "' . $method . '" not found'); break;
        }
    }

}