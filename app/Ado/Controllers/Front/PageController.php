<?php

namespace App\Ado\Controllers\Front;

use Former\Form\Fields\Input;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ado\Models\Tables\Cms\Page;
use App\Ado\Models\Tables\Cms\Contact;
use View;
use App\Facades\Strview;;
use DataEdit;
use Config;

class PageController  extends BaseController
{
    //单文章展示
    public function Page($url_key=null,$page=null){
        $this->initDbConfig();

        if(!$page){
             $page = Page::where('url_key',$url_key)->first();
        }
        $relations = Page::where('enable',1)->take(10)->get();
        $this->viewComposerInit();
        return View::make(config('front.template').'page_show',compact('page','relations'));
    }

    /**
     * cms.contact
     *  Contact US
     *
     * @return mixed
     */
    public function Contact(){
        $this->initDbConfig();
        $contact = new Contact();
        $edit = DataEdit::source($contact);
        Config::set('rapyd.data_edit.button_position.save','BL');
      //  Config::set('rapyd.data_edit.button_hide.show',true);
        $edit->label(trans('article.contact_label'));
        $edit->link(route('cms.contact'),trans("article.back"), "BL")->back();
        $edit->add('title',trans('article.title'), 'text')->rule('required|min:5')->attributes(['placeholder'=>trans("article.placeholder_title")]);
        $edit->add('email',trans('article.email'), 'text')->rule('required|min:5|email')->attributes(['placeholder'=>trans("article.placeholder_email")]);
        $edit->add('content',trans('content'), 'textarea')->rule('required|min:20')->attributes(['placeholder'=>trans("article.placeholder_content") ]);

        $edit->saved(function ($form){
            $form->message("You contact post saved.");
            $form->link('/',"back to home");
        });
        $this->viewComposerInit();
        return View::make(config('front.template').'page_contact_form',compact('edit'));
    }
}
