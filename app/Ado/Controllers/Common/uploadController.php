<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-9
 * Time: 上午7:03
 */

namespace App\Ado\Controllers\Common;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use File;
use Intervention\Image\ImageManager as Image;


class uploadController extends Controller {
    public function post(){
        $path = config('app.upload_dir');
        $size='';$resize_path='';
        if(Input::has('size')){
            $getSize = Input::get('size');
            $sizes = config('app.images_size');
            if(isset($sizes[$getSize])){
                $size = $sizes[$getSize];
                $resize_path = ltrim(config('app.image_web_path.'.$getSize),'/');
            }else{
                $size = 'x';
            }
        }

        if(empty($size)){
          $resize_path = ltrim(config('app.image_web_path.x360240'),'/');
          $size = config('app.images_size.x360240');
        }
        if (Input::hasFile('file'))
        {
            $fileInServer = '';

            $file = Input::file('file');

            $extension = $file->guessClientExtension();
            $extension = trim($extension,'.');

            $currentMime=[$extension=>$file->getMimeType()];
            if($this->checkMimeType(config('app.allow_extension'),$currentMime)){
                $fileName = $file->getClientOriginalName();
                if($file->move($path,$fileName)){
                    $fileInServer = $path.DIRECTORY_SEPARATOR.$fileName;
                }

                if($fileInServer && in_array($extension,config('app.allow_image_type'))){

                    if(!File::isDirectory($resize_path)){
                        File::makeDirectory($resize_path,  $mode = 0744,true,true);
                    }
                    $image = new Image();
                    if($size=='x'){
                        $image->make($fileInServer)->save($resize_path.$fileName);
                    }else{
                      $this->resizeAbsolute($size['width'],$size['height'],$fileInServer,$image,$resize_path.$fileName);
                  /*  $image->make($fileInServer)->fit($size['width'],$size['height'],function ($constraint) {
                        $constraint->upsize();
                    },'top')->save($resize_path.$fileName);
                  */
                    }
                    $url = '/'.$resize_path . $fileName;
                    $array = array(
                        'filelink' => $url
                    );
                    return stripslashes(json_encode($array));
                   // return app('html')->image($url);
                }elseif ($fileInServer && in_array($extension,config('app.allow_file_type'))){
                    $url = config('app.upload_web_path').$fileName;
                   // return app('html')->link($url,$fileName);
                    $array = array(
                        'filelink' => $url,$fileName,
                        'filename' => $fileName
                    );
                    return stripslashes(json_encode($array));
                }
            }
            return 'upload error,file type or size missmatch!';
        }else{
            return 'upload error!';
        }
    }

    /**
     * 按照绝对大小进行裁剪，小了会放大再裁剪
     * @param string $size
     * @param string $serverImagePath
     */
    protected function resizeAbsolute($width,$height,$fileInServer,$image,$saveFileName){
        if($image){
            $image->make($fileInServer);
            $w = $width;  //要缩放截取的宽和高
            $h = $height;
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
           $image->resize($e1w,$e1h)->fit($w,$h,$constaintFun)->save($saveFileName);
            unset($image);
        }
        return $saveFileName;
    }

    /**
     * @param array $allowdTypes [type1,type2...]
     * @param array $currentMime = [type=>mime]
     * @return bool
     */
    protected function checkMimeType($allowdTypes=array(),$currentMime=array()){
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