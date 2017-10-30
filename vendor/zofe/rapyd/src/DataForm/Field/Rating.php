<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/20
 * Time: 16:41
 */

namespace Zofe\Rapyd\DataForm\Field;
use Collective\Html\FormFacade as Form;
use Zofe\Rapyd\Rapyd;

class Rating extends Field
{
    public $type = "number";
    public $clause = "where";
    public $rule = ['Numeric'];

    public function build()
    {
        $output = "";

        if (parent::build() === false) {
            return;
        }

        switch ($this->status) {
            case "disabled":
            case "show":

                if ($this->type == 'hidden' || $this->value == "") {
                    $output = "";
                } elseif ((!isset($this->value))) {
                    $output = $this->layout['null_label'];
                } else {
                    $output = $this->value;
                }
                $output = "<div class='help-block'>" . $output . "&nbsp;</div>";
                break;

            case "create":
            case "modify":
         //   Rapyd::js('js/star-rating.min.js',true);
        //    Rapyd::css('css/star-rating.min.css',true);
                $output = Form::number($this->name, $this->value, $this->attributes);
                Rapyd::script("$('#".$this->name."').rating()");
                break;

            case "hidden":
                $output = Form::hidden($this->name, $this->value);
                break;

            default:
        }
        $this->output = "\n" . $output . "\n" . $this->extra_output . "\n";
    }

}