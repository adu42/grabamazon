<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-8-24
 * Time: 上午1:46
 */

namespace App\Ado\Models\Screen;
use Validator;

class XvfbrunGenerator extends abstractGenerator {

    public function getCommand()
    {
        $command = $this->xvfb_run_path();
        $command .= " ";
        $command .= " --server-args=\"-screen 0, 1280x1024x24\"";

        //Validator::$error_mode = 'fail';

        foreach ($this->values AS $key => $value)
        {
            //Validator::validOrFail($value);
            if (isset($value['value']))
                $command .= " --" . $key . "=" . $value['value'];
        }

        return $command;
    }



}