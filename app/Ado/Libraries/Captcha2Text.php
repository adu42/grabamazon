<?php
/**
 * Created by PhpStorm.
 * User: 杜兵
 * Date: 2017/1/13
 * Time: 11:50
 */

namespace App\Ado\Libraries;
use Storage;
define("ccTOPLEFT", 0);
define("ccTOP", 1);
define("ccTOPRIGHT", 2);
define("ccLEFT", 3);
define("ccCENTRE", 4);
define("ccCENTER", 4);
define("ccRIGHT", 5);
define("ccBOTTOMLEFT", 6);
define("ccBOTTOM", 7);
define("ccBOTTOMRIGHT", 8);

class Captcha2Text
{
    protected $_imgOrig;
    protected $_imgFinal;
    protected $_showDebug;
    protected $_gdVersion;
    private $letterlist = [
        ['id' => '3', 'letter' => 'x', 'hash' => '000000001000001000000000000110001100000000000001101100000000000000011100000000000000001110000000000000001101100000000000001100011000000000000100000100001'],
        ['id' => '4', 'letter' => 'y', 'hash' => '000000001111100100000000000111111001000000000000000110100000000000000001010000000000000000101000000000000000100100000000001111111110000000000111111110001'],
        ['id' => '5', 'letter' => 'c', 'hash' => '000000000011100000000000000011111000000000000011000110000000000001000001000000000000100000100000000000010000010000000000001100011000000000000010001000001'],
        ['id' => '6', 'letter' => '9', 'hash' => '000000011000000000000000011110011000000000011001100110000000001000010001000000000100001000100000000011001000110000000000111111110000000000001111110000001'],
        ['id' => '7', 'letter' => 'm', 'hash' => '000000001111111000000000000011111100000000000010000000000000000001111111000000000000011111100000000000010000000000000000001111111000000000000011111100001'],
        ['id' => '8', 'letter' => '8', 'hash' => '000000010001100000000000011101111000000000011011100110000000001000100001000000000100010000100000000011011100110000000000111011110000000000001000110000001'],
        ['id' => '9', 'letter' => 'p', 'hash' => '000000001111111110000000000111111111000000000001000100000000000001000001000000000000100000100000000000011000110000000000000111110000000000000001110000001'],
        ['id' => '10', 'letter' => 'i', 'hash' => '0000000000000010000000000001000001000000000110111111100000000011011111110000000000000000001000000000000000000100001'],
        ['id' => '11', 'letter' => 'u', 'hash' => '000000001111100000000000000111111000000000000000000110000000000000000001000000000000000000100000000000000000100000000000001111111000000000000111111100001'],
        ['id' => '12', 'letter' => 'q', 'hash' => '000000000011100000000000000011111000000000000011000110000000000001000001000000000000100000100000000000001000100000000000001111111110000000000111111111001'],
        ['id' => '13', 'letter' => 'd', 'hash' => '000000000011100000000000000011111000000000000011000110000000000001000001000000000000100000100000000000001000100000000001111111111000000000111111111100001'],
        ['id' => '15', 'letter' => 'g', 'hash' => '000000000111010100000000000111111111000000000010001010100000000001000101010000000000100010101000000000011111010100000000000111001110000000000110000010001'],
        ['id' => '16', 'letter' => 'o', 'hash' => '000000000011100000000000000011111000000000000011000110000000000001000001000000000000100000100000000000011000110000000000000111110000000000000001110000001'],
        ['id' => '17', 'letter' => '2', 'hash' => '000000010000001000000000011000001100000000011000001110000000001000001101000000000100001100100000000011001100010000000000111100001000000000001100000100001'],
        ['id' => '18', 'letter' => '7', 'hash' => '000001000000011000000000100000011100000000010000011000000000001000011000000000000100011000000000000010011000000000000001111000000000000000111000000000001'],
        ['id' => '19', 'letter' => 'n', 'hash' => '000000001111111000000000000111111100000000000001000000000000000001000000000000000000100000000000000000011000000000000000000111111000000000000001111100001'],
        ['id' => '20', 'letter' => 'b', 'hash' => '000001111111111000000000111111111100000000000001000100000000000001000001000000000000100000100000000000011000110000000000000111110000000000000001110000001'],
        ['id' => '21', 'letter' => 'h', 'hash' => '000001111111111000000000111111111100000000000001000000000000000001000000000000000000100000000000000000011000000000000000000111111000000000000001111100001'],
        ['id' => '22', 'letter' => 't', 'hash' => '000000001000000000000000000100000000000000001111111100000000000111111111000000000000100000100000000000010000010000000000000000011000000000000000001000001'],
        ['id' => '26', 'letter' => 'r', 'hash' => '000000001000000000000000000111111100000000000001111110000000000001100000000000000000100000000000000000010000000000000000001100000000000000000010000000001'],
        ['id' => '24', 'letter' => 'e', 'hash' => '000000000011100000000000000011111000000000000011010110000000000001001001000000000000100100100000000000011010010000000000000111011000000000000001101000001'],
        ['id' => '25', 'letter' => 'f', 'hash' => '000000000010000000000000000001000000000000001111111110000000001111111111000000000100001000000000000010000100000000000001110000000000000000011000000000001'],
        ['id' => '27', 'letter' => 'a', 'hash' => '000000000000110000000000000010111100000000000011010010000000000001001001000000000000100100100000000000010010100000000000001111111000000000000011111100001'],
        ['id' => '28', 'letter' => 'v', 'hash' => '000000001100000000000000000111100000000000000000111100000000000000000111000000000000000011100000000000000111100000000000001111000000000000000110000000001'],
        ['id' => '29', 'letter' => 'k', 'hash' => '00000111111111100000000011111111110000000000000011000000000000000011110000000000000011001100000000000001000011000000000000000000100001'],
        ['id' => '30', 'letter' => '6', 'hash' => '000000011111100000000000011111111000000000011000100110000000001000100001000000000100010000100000000011001100110000000000110011110000000000000000110000001'],
        ['id' => '31', 'letter' => 'j', 'hash' => '00000000000000110000000000000000011100000000000000000010000000000000000001000000000010000000100000001101111111110000000110111111110001'],
        ['id' => '32', 'letter' => '5', 'hash' => '000001111100100000000000111110011000000000010001000110000000001001000001000000000100100000100000000010011000110000000001000111110000000000000001110000001'],
        ['id' => '33', 'letter' => 'w', 'hash' => '000000001111110000000000000111111100000000000000000110000000000000011110000000000000001111000000000000000000110000000000001111111000000000000111111000001'],
        ['id' => '34', 'letter' => 'z', 'hash' => '0000000010000110000000000001000111000000000000100110100000000000010110010000000000001110001000000000000110000100001'],
        ['id' => '35', 'letter' => 's', 'hash' => '000000000110010000000000000111101100000000000010010010000000000001001001000000000000100100100000000000010010010000000000001101111000000000000010011000001'],
        ['id' => '36', 'letter' => '3', 'hash' => '000000100000010000000000110000001100000000010000000010000000001000100001000000000100010000100000000011011100110000000000111011110000000000001000110000001'],
        ['id' => '37', 'letter' => '4', 'hash' => '000000000011000000000000000011100000000000000011010000000000000011001000000000000011000100000000000011111111110000000001111111111000000000000000100000001']
    ];

    /**
     * main
     * 主入口
     */
    public function c2t($imageName)
    {
        $image =  Storage::get($imageName);
        $path = storage_path('/app/'.$imageName);

        //------------------------------------------------------//
        $src = imagecreatefromJPEG($path) or die('Problem with source');
        $out = ImageCreateTrueColor(imagesx($src), imagesy($src)) or die('Problem In Creating image');
        // scan image pixels
        for ($x = 0; $x < imagesx($src); $x++) {
            for ($y = 0; $y < imagesy($src); $y++) {
                $src_pix = imagecolorat($src, $x, $y);
                $src_pix_array = $this->rgb_to_array($src_pix);
                if ($src_pix_array[0] > 100 && $src_pix_array[1] > 100 && $src_pix_array[2] > 100) {
                    $src_pix_array[0] = 255;
                    $src_pix_array[1] = 255;
                    $src_pix_array[2] = 255;
                } else {
                    $src_pix_array[0] = 0;
                    $src_pix_array[1] = 0;
                    $src_pix_array[2] = 0;
                }
                imagesetpixel($out, $x, $y, imagecolorallocate($out, $src_pix_array[0], $src_pix_array[1], $src_pix_array[2]));
            }
        }
        for ($fx = 0; $fx < 60; $fx++) {
            imagesetpixel($out, $fx, 0, imagecolorallocate($out, 255, 255, 255));
        }
        for ($fy = 0; $fy < 20; $fy++) {
            imagesetpixel($out, 59, $fy, imagecolorallocate($out, 255, 255, 255));
        }
        for ($fx = 0; $fx < 60; $fx++) {
            imagesetpixel($out, $fx, 19, imagecolorallocate($out, 255, 255, 255));
        }
        for ($fy = 0; $fy < 20; $fy++) {
            imagesetpixel($out, 0, $fy, imagecolorallocate($out, 255, 255, 255));
        }
// write $out to disc
        imagejpeg($out, 'output.jpg', 100) or die('Problem saving output image');
        imagedestroy($out);
        $src = imagecreatefromJPEG('output.jpg') or die('Problem with source');
        $out = ImageCreateTrueColor(imagesx($src), imagesy($src)) or die('Problem In Creating image');
// scan image pixels
        $ino = 0;
        $started = 0;
        for ($x = 0; $x < imagesx($src); $x++) {
            for ($y = 0; $y < imagesy($src); $y++) {
                $src_pix = imagecolorat($src, $x, $y);
                $src_pix_array = $this->rgb_to_array($src_pix);
                if ($src_pix_array[0] < 100 && $src_pix_array[1] < 100 && $src_pix_array[2] < 100 && $started == 0) {
                    $csx = $x;
                    $csy = 0;
                    $started = 1;
                    $white = 0;
                }
                if ($src_pix_array[0] < 100 && $src_pix_array[1] < 100 && $src_pix_array[2] < 100) {
                    $white = 0;
                }
                if ($started == 1 && $y == 19 && $white == 1) {
                    $cey = 19;
                    $cex = $x;
                    $this->loadImage('output.jpg');
                    $this->cropToDimensions($csx, $csy, $cex, $cey);
                    $this->saveImage('ltr' . $ino . '.jpg');
                    $ino++;
                    $started = 0;
                    $csx . "," . $csy . "," . $cex . "," . $cey;
                    "<br />";
                }
            }
            $white = 1;
        }
        $srr = '';

        for ($ino = 0; $ino < 6; $ino++) {
            $src = imagecreatefromJPEG('ltr' . $ino . '.jpg') or die('Problem with source');
            $out = ImageCreateTrueColor(imagesx($src), imagesy($src)) or die('Problem In Creating image');
            $string = '';
            // scan image pixels
            for ($x = 0; $x < imagesx($src); $x++) {
                for ($y = 0; $y < imagesy($src); $y++) {
                    $src_pix = imagecolorat($src, $x, $y);
                    $src_pix_array = $this->rgb_to_array($src_pix);
                    if ($src_pix_array[0] > 100 && $src_pix_array[1] > 100 && $src_pix_array[2] > 100) {
                        $string .= '0';
                    } else {
                        $string .= '1';
                    }
                }
            }
            $string .= '1';
//echo $string."<br />";  //Uncomment this when building database
            for ($i = 0; $i < count($this->letterlist); $i++)
                if (strcmp($this->letterlist[$i]['hash'], $string) == 0) {
                    $srr .= $this->letterlist[$i]['letter'];
                    break;
                }
        }
        file_put_contents("res.txt", $srr);
        return $srr;
    }

    // split rgb to components
    private function rgb_to_array($rgb)
    {
        $a[0] = ($rgb >> 16) & 0xFF;
        $a[1] = ($rgb >> 8) & 0xFF;
        $a[2] = $rgb & 0xFF;
        return $a;
    }

    private function hashToText($hash)
    {
        for ($i = 0; $i < count($this->letterlist); $i++)
            if ($this->letterlist[$i]['hash'] === $hash)
                return $this->letterlist[$i]['letter'];
        return 'X';
    }

    /**
     * @return canvasCrop
     * @param bool $debug
     * @desc Class initializer
     */
    protected function canvasCrop($debug = false)
    {
        $this->_showDebug = ($debug ? true : false);
        $this->_gdVersion = (function_exists('imagecreatetruecolor')) ? 2 : 1;
    }


    /**
     * @return bool
     * @param string $filename
     * @desc Load an image from the file system - method based on file extension
     */
    protected function loadImage($filename)
    {
        if (!@file_exists($filename)) {
            $this->_debug('loadImage', "The supplied file name '$filename' does not point to a readable file.");
            return false;
        }

        $ext = strtolower($this->_getExtension($filename));
        $func = "imagecreatefrom$ext";

        if (!@function_exists($func)) {
            $this->_debug('loadImage', "That file cannot be loaded with the function '$func'.");
            return false;
        }

        $this->_imgOrig = @$func($filename);

        if ($this->_imgOrig == null) {
            $this->_debug('loadImage', 'The image could not be loaded.');
            return false;
        }

        return true;
    }


    /**
     * @return bool
     * @param string $string
     * @desc Load an image from a string (eg. from a database table)
     */
    protected function loadImageFromString($string)
    {
        $this->_imgOrig = @ImageCreateFromString($string);
        if (!$this->_imgOrig) {
            $this->_debug('loadImageFromString', 'The image could not be loaded.');
            return false;
        }
        return true;
    }


    /**
     * @return bool
     * @param string $filename
     * @param int $quality
     * @desc Save the cropped image
     */
    protected function saveImage($filename, $quality = 100)
    {
        if ($this->_imgFinal == null) {
            $this->_debug('saveImage', 'There is no processed image to save.');
            return false;
        }

        $ext = strtolower($this->_getExtension($filename));
        $func = "image$ext";

        if (!@function_exists($func)) {
            $this->_debug('saveImage', "That file cannot be saved with the function '$func'.");
            return false;
        }

        $saved = false;
        if ($ext == 'png') $saved = $func($this->_imgFinal, $filename);
        if ($ext == 'jpeg') $saved = $func($this->_imgFinal, $filename, $quality);
        if ($saved == false) {
            $this->_debug('saveImage', "Could not save the output file '$filename' as a $ext.");
            return false;
        }

        return true;
    }


    /**
     * @return bool
     * @param string $type
     * @param int $quality
     * @desc Shows the cropped image without any saving
     */
    protected function showImage($type = 'png', $quality = 100)
    {
        if ($this->_imgFinal == null) {
            $this->_debug('showImage', 'There is no processed image to show.');
            return false;
        }
        if ($type == 'png') {
            echo @ImagePNG($this->_imgFinal);
            return true;
        } else if ($type == 'jpg' || $type == 'jpeg') {
            echo @ImageJPEG($this->_imgFinal, '', $quality);
            return true;
        } else {
            $this->_debug('showImage', "Could not show the output file as a $type.");
            return false;
        }
    }


    /**
     * @return int
     * @param int $x
     * @param int $y
     * @param int $position
     * @desc Determines the dimensions to crop to if using the 'crop by size' method
     */
    protected function cropBySize($x, $y, $position = ccCENTRE)
    {
        if ($x == 0) {
            $nx = @ImageSX($this->_imgOrig);
        } else {
            $nx = @ImageSX($this->_imgOrig) - $x;
        }
        if ($y == 0) {
            $ny = @ImageSY($this->_imgOrig);
        } else {
            $ny = @ImageSY($this->_imgOrig) - $y;
        }
        return ($this->_cropSize(-1, -1, $nx, $ny, $position, 'cropBySize'));
    }


    /**
     * @return int
     * @param int $x
     * @param int $y
     * @param int $position
     * @desc Determines the dimensions to crop to if using the 'crop to size' method
     */
    protected function cropToSize($x, $y, $position = ccCENTRE)
    {
        if ($x == 0) $x = 1;
        if ($y == 0) $y = 1;
        return ($this->_cropSize(-1, -1, $x, $y, $position, 'cropToSize'));
    }


    /**
     * @return int
     * @param int $sx
     * @param int $sy
     * @param int $ex
     * @param int $ey
     * @desc Determines the dimensions to crop to if using the 'crop to dimensions' method
     */
    protected function cropToDimensions($sx, $sy, $ex, $ey)
    {
        $nx = abs($ex - $sx);
        $ny = abs($ey - $sy);
        $position = ccCENTRE;
        return ($this->_cropSize($sx, $sy, $nx, $ny, $position, 'cropToDimensions'));
    }


    /**
     * @return int
     * @param int $percentx
     * @param int $percenty
     * @param int $position
     * @desc Determines the dimensions to crop to if using the 'crop by percentage' method
     */
    protected function cropByPercent($percentx, $percenty, $position = ccCENTER)
    {
        if ($percentx == 0) {
            $nx = @ImageSX($this->_imgOrig);
        } else {
            $nx = @ImageSX($this->_imgOrig) - (($percentx / 100) * @ImageSX($this->_imgOrig));
        }
        if ($percenty == 0) {
            $ny = @ImageSY($this->_imgOrig);
        } else {
            $ny = @ImageSY($this->_imgOrig) - (($percenty / 100) * @ImageSY($this->_imgOrig));
        }
        return ($this->_cropSize(-1, -1, $nx, $ny, $position, 'cropByPercent'));
    }


    /**
     * @return int
     * @param int $percentx
     * @param int $percenty
     * @param int $position
     * @desc Determines the dimensions to crop to if using the 'crop to percentage' method
     */
    protected function cropToPercent($percentx, $percenty, $position = ccCENTRE)
    {
        if ($percentx == 0) {
            $nx = @ImageSX($this->_imgOrig);
        } else {
            $nx = ($percentx / 100) * @ImageSX($this->_imgOrig);
        }
        if ($percenty == 0) {
            $ny = @ImageSY($this->_imgOrig);
        } else {
            $ny = ($percenty / 100) * @ImageSY($this->_imgOrig);
        }
        return ($this->_cropSize(-1, -1, $nx, $ny, $position, 'cropByPercent'));
    }


    /**
     * @return bool
     * @param int $threshold
     * @desc Determines the dimensions to crop to if using the 'automatic crop by threshold' method
     */
    protected function cropByAuto($threshold = 254)
    {
        if ($threshold < 0) $threshold = 0;
        if ($threshold > 255) $threshold = 255;

        $sizex = @ImageSX($this->_imgOrig);
        $sizey = @ImageSY($this->_imgOrig);

        $sx = $sy = $ex = $ey = -1;
        for ($y = 0; $y < $sizey; $y++) {
            for ($x = 0; $x < $sizex; $x++) {
                if ($threshold >= $this->_getThresholdValue($this->_imgOrig, $x, $y)) {
                    if ($sy == -1) $sy = $y;
                    else $ey = $y;

                    if ($sx == -1) $sx = $x;
                    else {
                        if ($x < $sx) $sx = $x;
                        else if ($x > $ex) $ex = $x;
                    }
                }
            }
        }
        $nx = abs($ex - $sx);
        $ny = abs($ey - $sy);
        return ($this->_cropSize($sx, $sy, $nx, $ny, ccTOPLEFT, 'cropByAuto'));
    }


    /**
     * @return void
     * @desc Destroy the resources used by the images
     */
    protected function flushImages()
    {
        @ImageDestroy($this->_imgOrig);
        @ImageDestroy($this->_imgFinal);
        $this->_imgOrig = $this->_imgFinal = null;
    }


    /**
     * @return bool
     * @param int $ox Original image width
     * @param int $oy Original image height
     * @param int $nx New width
     * @param int $ny New height
     * @param int $position Where to place the crop
     * @param string $function Name of the calling function
     * @desc Creates the cropped image based on passed parameters
     */
    protected function _cropSize($ox, $oy, $nx, $ny, $position, $function)
    {
        if ($this->_imgOrig == null) {
            $this->_debug($function, 'The original image has not been loaded.');
            return false;
        }
        if (($nx <= 0) || ($ny <= 0)) {
            $this->_debug($function, 'The image could not be cropped because the size given is not valid.');
            return false;
        }
        if (($nx > @ImageSX($this->_imgOrig)) || ($ny > @ImageSY($this->_imgOrig))) {
            $this->_debug($function, 'The image could not be cropped because the size given is larger than the original image.');
            return false;
        }
        if ($ox == -1 || $oy == -1) {
            list($ox, $oy) = $this->_getCopyPosition($nx, $ny, $position);
        }
        if ($this->_gdVersion == 2) {
            $this->_imgFinal = @ImageCreateTrueColor($nx, $ny);
            @ImageCopyResampled($this->_imgFinal, $this->_imgOrig, 0, 0, $ox, $oy, $nx, $ny, $nx, $ny);
        } else {
            $this->_imgFinal = @ImageCreate($nx, $ny);
            @ImageCopyResized($this->_imgFinal, $this->_imgOrig, 0, 0, $ox, $oy, $nx, $ny, $nx, $ny);
        }
        return true;
    }


    /**
     * @return array
     * @param int $nx
     * @param int $ny
     * @param int $position
     * @desc Determines dimensions of the crop
     */
    protected function _getCopyPosition($nx, $ny, $position)
    {
        $ox = @ImageSX($this->_imgOrig);
        $oy = @ImageSY($this->_imgOrig);

        switch ($position) {
            case ccTOPLEFT:
                return array(0, 0);
            case ccTOP:
                return array(ceil(($ox - $nx) / 2), 0);
            case ccTOPRIGHT:
                return array(($ox - $nx), 0);
            case ccLEFT:
                return array(0, ceil(($oy - $ny) / 2));
            case ccCENTRE:
                return array(ceil(($ox - $nx) / 2), ceil(($oy - $ny) / 2));
            case ccRIGHT:
                return array(($ox - $nx), ceil(($oy - $ny) / 2));
            case ccBOTTOMLEFT:
                return array(0, ($oy - $ny));
            case ccBOTTOM:
                return array(ceil(($ox - $nx) / 2), ($oy - $ny));
            case ccBOTTOMRIGHT:
                return array(($ox - $nx), ($oy - $ny));
        }
    }


    /**
     * @return float
     * @param resource $im
     * @param int $x
     * @param int $y
     * @desc Determines the intensity value of a pixel at the passed co-ordinates
     */
    protected function _getThresholdValue($im, $x, $y)
    {
        $rgb = ImageColorAt($im, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        $intensity = ($r + $g + $b) / 3;
        return $intensity;
    }


    /**
     * @return string
     * @param string $filename
     * @desc Get the extension of a file name
     */
    protected function _getExtension($filename)
    {
        $ext = @strtolower(@substr($filename, (@strrpos($filename, ".") ? @strrpos($filename, ".") + 1 : @strlen($filename)), @strlen($filename)));
        return ($ext == 'jpg') ? 'jpeg' : $ext;
    }


    /**
     * @return void
     * @param string $function
     * @param string $string
     * @desc Shows debugging information
     */
    protected function _debug($function, $string)
    {
        if ($this->_showDebug) {
            echo "<p><strong style=\"color:#FF0000\">Error in function $function:</strong> $string</p>\n";
        }
    }


    /**
     * @return array
     * @desc Try to ascertain what the version of GD being used is, based on phpinfo output
     */
    protected function _getGDVersion()
    {
        static $version = array();

        if (empty($version)) {
            ob_start();
            phpinfo();
            $buffer = ob_get_contents();
            ob_end_clean();
            if (preg_match("|<B>GD Version</B></td><TD ALIGN=\"left\">([^<]*)</td>|i", $buffer, $matches)) {
                $version = explode('.', $matches[1]);
            } else if (preg_match("|GD Version </td><td class=\"v\">bundled \(([^ ]*)|i", $buffer, $matches)) {
                $version = explode('.', $matches[1]);
            } else if (preg_match("|GD Version </td><td class=\"v\">([^ ]*)|i", $buffer, $matches)) {
                $version = explode('.', $matches[1]);
            }
        }
        return $version;
    }
}