<?php

namespace App\Models\Helpers;

use Illuminate\Filesystem\Filesystem as File;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Exception\NotReadableException;
const _DS_ = DIRECTORY_SEPARATOR;
const _WS_ = '/';
class ImageHelper
{
    public $data = [];
    public $base_dir = 'media';
    protected $image = null;
    /**
     * 本地
     * 处理图片尺寸
     * @param string $size
     * @return array $data
     */
    public function splitPath($size = '')
    {
        if(empty($size)){
            $size = '320x240';
        }
        $size = str_replace(array('X','|',','),'x',$size);
        $_size = explode('x',$size);
        if(count($_size)==1)$_size[1]=(int)$_size[0];
        $this->data['width'] =(int)$_size[0];
        $this->data['height'] =(int)$_size[1];
        $this->data['quality'] =isset($_size[2])?(int)$_size[2]:80;
        $this->data['dir'] =$this->data['width'].'x'.$this->data['height'];
        $this->data['server_full_dir'] = public_path()._DS_.$this->base_dir._DS_.'resize'._DS_.$this->data['dir']._DS_;
        $this->data['server_dir'] =$this->base_dir._DS_.'resize'._DS_.$this->data['dir'];
        $this->data['client_dir'] = _WS_.$this->base_dir._WS_.'resize'._WS_.$this->data['dir']._WS_;
        $this->data['client_path'] = '';
        $this->data['server_path'] = '';
        return $this;
    }

    /**
     * 图片默认原地址
     * @return string
     */
    public function getImageSavePath(){
        return $this->base_dir._DS_.'images';
    }

    /**
     * 上传文件的根路径
     * @return string
     */
    public function getFileSavePath(){
        return $this->base_dir._DS_.'files';
    }

    /**
     * 获取路径属性
     *
     *
     * @return array
     */
    public function getPathAttribbutes($key=null){
        if($key && isset($this->data[$key]))return $this->data[$key];
        return $this->data;
    }

    /*
     * 设置图片
     */
    public function setOriginalImage($serverImagePath)
    {
        try{
            $this->image = ImageManagerStatic::make($serverImagePath);
        }catch (NotReadableException $e){
            $this->image = null;
            //   print_r($e);
        }
        return $this;
    }

    public function getImageManager(){
        return $this->image;
    }

    /**
     * @param string $size
     * @param string $serverImagePath
     * @param bool $absolute
     * @return Image
     */
    public function resize($size = '', $serverImagePath = '', $absolute = true)
    {
        if($absolute){
            return $this->resizeAbsolute($size,$serverImagePath);
        }else{
            return $this->resizeWiden($size, $serverImagePath);
        }
    }

    /**
     * 按照绝对大小进行裁剪，小了会放大再裁剪
     * @param string $size
     * @param string $serverImagePath
     */
    public function resizeAbsolute($size = '', $serverImagePath = '')
    {
        if(!empty($serverImagePath))$this->setOriginalImage($serverImagePath);
        if(!empty($size))$this->splitPath($size);

        if($image = $this->getImageManager()){
            $w = $this->data['width'];  //要缩放截取的宽和高
            $h = $this->data['height'];
            $imageSize = $image->getSize(); //原图的尺寸
            $ow = $imageSize->width;
            $oh = $imageSize->height;
            //以宽为参照等比例，计算高，计算当宽缩放到w时，高可以缩放到多少？
            //以高为参照等比例，计算宽,计算当高缩放到w时，宽可以缩放到多少？
            //比较缩放标准，是否需要以缩放宽或高，进行放大，
            //如果原宽高比现宽高都大，就不需要放大，直接截取
            $rw = $ow/$w; $rh=$oh/$h;   //宽高缩放比例
            $ew = $rh*$ow; $eh=$rw*$oh; //直接缩放按比例可以到多少.
            //可能的操作：1先按照大比例放大，再进行裁剪,而不是直接截取，不留等比例短板，可取性更高
            $refer = $rw>$rh ? $rw:$rh;
            $e1w = intval($ow*$refer);
            $e1h = intval($oh*$refer);

            $constaintFun = function ($constraint){
                $constraint->aspectratio();
            };
            $this->makeIfNotExsitDir($this->data['server_full_dir']);
            $this->addPath($image);
            $image->resize($e1w,$e1h)->fit($w,$h,$constaintFun)->save($this->data['server_full_dir'].$image->basename,$this->data['quality']);
            unset($image);
        }
        return $this;
    }

    /**
     * 按比例
     * @param string $size
     * @param string $serverImagePath
     * @return $this
     */
    public function resizeWiden($size = '', $serverImagePath = '')
    {
        if(!empty($serverImagePath))$this->setOriginalImage($serverImagePath);
        if(!empty($size))$this->splitPath($size);
        if($image = $this->getImageManager()) {
            $constaintFun = function ($constraint) {
                $constraint->aspectratio();
            };
            $this->makeIfNotExsitDir($this->data['server_full_dir']);
            $this->addPath($image);
            $image->widen($this->data['width'], $constaintFun)->save($this->data['server_full_dir'] . $image->basename,$this->data['quality']);
            unset($image);
        }
        return $this;
    }

    /**
     * 补齐路径
     * @param $image
     */
    public function addPath($image){
        $this->data['server_path'] = $this->data['server_full_dir'].$image->basename;
        $this->data['client_path'] = $this->data['client_dir'].$image->basename;
        $this->data['server_path'] = $this->data['server_full_dir'].$image->basename;
    }
    /**
     * 检查目录
     * 创建目录，如果目录不存在
     * @param string $pathFormDocumentRoot
     */
    public function makeIfNotExsitDir($pathFormDocumentRoot = '')
    {
        if(empty($pathFormDocumentRoot) && !empty($this->data['server_dir'])){
            $pathFormDocumentRoot=$this->data['server_dir'];
        }
        $file =  new File();
        if(!$file->isDirectory($pathFormDocumentRoot)){
            try{ $file->makeDirectory($pathFormDocumentRoot,  $mode = 0744,true,true);
            }catch (\Exception $e){
                print_r($e);
            }
        }
        return $this;
    }

    /**
     * 检查Mime类型是不是可上传的类型
     * @param array $allowdTypes
     * @param array $currentMime
     * @return bool
     */
    public static function checkMimeType($allowdTypes=array(),$currentMime=array()){
        if(empty($currentMime))return false;
        if(empty($allowdTypes))return false;
        $mimes = [
            'zip'  => 'application/zip',
            'gif'  => 'image/gif',
            'png'  => 'image/png',
            'txt'  => 'text/plain',
            'aif'  => 'audio/x-aiff',
            'aiff' => 'audio/x-aiff',
            'avi'  => 'video/avi',
            'bmp'  => 'image/bmp',
            'bz2'  => 'application/x-bz2',
            'csv'  => 'text/csv',
            'dmg'  => 'application/x-apple-diskimage',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'gz'   => 'application/x-gzip',
            'htm'  => 'text/html',
            'html' => 'text/html',
            'jpeg' => 'image/jpeg',
            'jpg'  => 'image/jpeg',
            'm3u'  => 'audio/x-mpegurl',
            'm4a'  => 'audio/mp4',
            'mdb'  => 'application/x-msaccess',
            'mid'  => 'audio/midi',
            'midi' => 'audio/midi',
            'mov'  => 'video/quicktime',
            'mp3'  => 'audio/mpeg',
            'mp4'  => 'video/mp4',
            'mpeg' => 'video/mpeg',
            'mpg'  => 'video/mpeg',
            'odg'  => 'vnd.oasis.opendocument.graphics',
            'odp'  => 'vnd.oasis.opendocument.presentation',
            'odt'  => 'vnd.oasis.opendocument.text',
            'ods'  => 'vnd.oasis.opendocument.spreadsheet',
            'ogg'  => 'audio/ogg',
            'pdf'  => 'application/pdf',
            'ppt'  => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'rar'  => 'application/x-rar-compressed',
            'rtf'  => 'application/rtf',
            'tar'  => 'application/x-tar',
            'svg'  => 'image/svg+xml',
            'tif'  => 'image/tiff',
            'tiff' => 'image/tiff',
            'vcf'  => 'text/x-vcard',
            'wav'  => 'audio/wav',
            'wma'  => 'audio/x-ms-wma',
            'wmv'  => 'audio/x-ms-wmv',
            'xls'  => 'application/excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xml'  => 'application/xml',
        ];
        $type = array_keys($currentMime)[0];
        $mime = array_values($currentMime)[0];
        if(in_array($type,$allowdTypes)){
            if(isset($mimes[$type]) && $mimes[$type]==$mime)return true;
        }
        return false;
    }
}
