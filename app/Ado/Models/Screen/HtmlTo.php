<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/14
 * Time: 14:02
 *   $HtmlTo = new HtmlTo();
 *    return $HtmlTo->urlToPdf('http://21cn.com');
 */

namespace App\Ado\Models\Screen;
use App\Ado\Models\Screen\HtmlToImage as HtmlToImage;
use App\Ado\Models\Screen\HtmlToPdf as HtmlToPdf;
use App\Ado\Models\Screen\CutyCapt;
use Illuminate\Support\Str as Str;
use Image;
use File;

class HtmlTo
{
    protected $binary = '';
    protected $saveto = '';
    protected $file_prex='htmlto';
    protected $file='';
    protected $path_file='';
    protected $file_extension='';
    protected $toObj = null;
    protected $options;
    protected $configred = '';
    protected $resize_web_path;

    protected function configure($to='image'){
        if($this->configred!=$to){
            if (config('front')) {
                if(PHP_OS=='WINNT'){
                    $this->binary       = config('front.winnt_binary_path').DIRECTORY_SEPARATOR.strtolower(PHP_OS).'-wkhtmltopdf'.DIRECTORY_SEPARATOR.'bin'.DIRECTORY_SEPARATOR;
                    if($to=='image'){
                        $this->binary=$this->binary.'wkhtmltoimage';
                    }else{
                        $this->binary=$this->binary.'wkhtmltopdf';
                    }
                }else{
                    if($to=='image'){
                        $this->binary =config('front.linux_binary_path');
                    }else{
                        $this->binary =config('front.linux_binary_path_pdf');
                    }
                }
                $this->saveto      = config('front.save_to');
                $this->saveto = rtrim(rtrim($this->saveto,'/'),'\\');
                $this->file_prex   = config('front.file_prex');
                $this->file_web_path = config('front.file_web_path');
                $this->file_web_path = rtrim($this->file_web_path,'/').'/';
                if($to=='image'){
                    $this->file_extension   = config('front.image_file_extension');
                    $this->file_extension = trim($this->file_extension,'.');
                    $this->options = config('front.save_to_image_options');
                    $this->toObj = new HtmlToImage($this->binary,$this->options);
                }else{
                    $this->file_extension   = config('front.pdf_file_extension');
                    $this->file_extension = trim($this->file_extension,'.');
                    $this->options = config('front.save_to_pdf_options');
                    $this->toObj = new HtmlToPdf($this->binary,$this->options);
                }
                $this->configred=$to;
                $this->binary = strtolower($this->binary);
                $this->file_prex = date('Y/m').DIRECTORY_SEPARATOR.$this->file_prex;
            }else{
                throw new exception('config can not load.');
            }
        }
    }

    protected function generatorFileName($fileName=''){
         if(empty($fileName))$fileName=$this->file_prex.date('YmdHis').Str::random(4);
         $this->file = $fileName.'.'.$this->file_extension;
         return $this;
    }

    protected function getFileName(){
        return $this->file;
    }

    protected function getServerFileName(){
        return $this->path_file;
    }

    protected function generatorFullFilePath(){
          $this->path_file = $this->saveto.DIRECTORY_SEPARATOR.$this->file;
          return $this;
    }

    protected function getWebPath(){
        return $this->file_web_path.(str_replace(['\\','//'],'/',$this->file));
    }

    protected function getResizeWebPath(){
        return $this->resize_web_path;
    }

    protected function setResizeWebPath($pathFile){
        $this->resize_web_path= '/'.$pathFile;
    }
    /**
     * generate($input, $output, array $options = array(), $overwrite = false)
     * @param $input
     */
    public function urlToImage($input,$fileName=''){

        $this->configure('image');
        $this->generatorFileName($fileName)->generatorFullFilePath();
        $rs = true;
        try{
            $this->toObj->generate($input,$this->getServerFileName());

        }catch(\RuntimeException $e){
            $rs = false;
         // dd($e);
            // return false;
        }
        if($rs){
            return $this->getWebPath();
        }
        return '';
    }

    public function urlToPdf($input,$fileName=''){
        $this->configure('pdf');
        $this->generatorFileName($fileName)->generatorFullFilePath();
        try{
            $this->toObj->generate($input,$this->getServerFileName());
        }catch(\RuntimeException $e){
           // return false;
        }
        return $this->getWebPath();
    }

    public function resize($size='x400300'){
        $file = $this->getServerFileName();
        if(!empty($file)){
            $resize_path = ltrim(config('app.image_web_path.'.$size),'/');
            $sizes = config('app.images_size.'.$size);
            //  $size = config('app.images_size.x360240');
            if(!File::isDirectory($resize_path)){
                File::makeDirectory($resize_path,  $mode = 0744,true,true);
            }
            $file = str_replace(array('\\'),'/',$file);
            $_files = explode('/',$file);
            $out =  end($_files);
            if(file_exists($file)){
                Image::make($file)->fit($sizes['width'],$sizes['height'],function ($constraint) {
                    $constraint->upsize();
                },'top')->save($resize_path.$out);
              //  Image::make($file)->resize(360,240)->save($resize_path.$out);
                $this->setResizeWebPath($resize_path.$out);
            }
            return $this->getResizeWebPath();
        }
        return '';
    }

    public function __destruct()
    {
        unset($this->toObj);
    }
}