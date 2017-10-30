<?php namespace App\Ado\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ado\Models\Screen\CutyCapt;
//use Illuminate\Http

use Input;
use Illuminate\Http\Request;
//use yajra\Datatables\Datatables;
use DataGrid;
use Zofe\Rapyd\DataEdit\DataEdit;
use App\Ado\Models\Tables\User\User;
use App\Ado\Models\Tables\User\Menu;
use Former as former;
use Auth;
use Html;
use menu as Vmenu;
use View;
use Context;
use Cache;
use Theme;
use Widget;
use Strview;
use Image;
use File;
use App\Ado\Models\Screen\HtmlTo as HtmlTo;
use App\Ado\Models\Screen\GoogleScraper;

class testController extends Controller {


    public function index(Request $request,CutyCapt $capt){
        $users = User::where('id','>',5)->where('id','<',205)->get();
        foreach($users as $user){
            $user->update(['avatar'=>$this->getAvatar(),'virtual'=>1]);
        }


        return 'ok';
        $googleScraper = new GoogleScraper();
        $ls = $googleScraper->getUrlList('prom dresses');
        dd($ls);


          $HtmlTo = new HtmlTo();
        $HtmlTo->urlToImage('http://www.21cn.com');
        $screen = $HtmlTo->resize('x400300');
            return $screen;


        return PHP_OS;

        echo  link_to('/oauth/facebook','facebook.login');
        echo '<br/>';
        return link_to('/oauth/github','github.login');

      //  Context::set('user',User::first());
    //    $user = Context::get('user');
      //  header("Content-type: text/html; charset=UTF-8");
     $imageTest = public_path('screens/2016/02/').'screenshot-www 163 com 2016-02-25 09-39-00.png';
        if(File::exists($imageTest)){
            $img = Image::make($imageTest);
            $img->fit(400,300,function ($constraint) {
                $constraint->upsize();
            },'top');
          // $img->resize(400, 300);
            return $img->response('jpg');
            $img->save(public_path('screens/2016/02/').'test.jpg');

        }



        return '';
        header("Content-Type: text/html;charset=utf-8");

        $_data['template']='{{ Widget::Block(\'asdsada-w-sd-23\') }}';
        $_data['updated_at']=0;
        $_data['cache_key']=isset($this->attributes['identifier'])?$this->attributes['identifier']:'block';
        $_data['template']= Strview::make($_data)->render();
        $value = Strview::make($_data)->render();
echo 111;
        return $value ;


return Widget::run('Block');
      //echo  $screen  =   $capt->url('http://21cn.com')->getFile('/21cn.png',true);
    //    $HtmlTo = new HtmlTo();
  //     return $HtmlTo->cutyCapt('http://21cn.com');



        Vmenu::make('MyNavBar', function($menu){

            $menu->add('Home');
            $menu->add('About',    'about');
            $menu->about->add('About',    'about');
            $menu->add('services', 'services');
            $menu->add('Contact',  'contact');

        });

      //  echo php_uname();
        echo PHP_OS;

       return View::make(config('front.template').'test');
        return View::make('vendor.laravel-menu.bootstrap-navbar-items',compact('MyNavBar'));

        die('====');

        echo  Html::script('/assets/js/jquery-2.1.3.min.js');
        echo  Html::style('/assets/js/redactor/redactor.css');
      echo  Html::script('/assets/js/redactor/redactor.min.js');
        echo  Html::script('/assets/js/redactor/lang/zh_cn.js');
        echo  Html::script('/assets/js/redactor/plugins/table/table.js');

        echo  Html::script('/assets/js/redactor/plugins/video/video.js');
        echo  Html::script('/assets/js/redactor/plugins/imagemanager/imagemanager.js');
        echo '<textarea id="messageArea" name="messageArea" rows="7" class="form-control ckeditor" placeholder="Write your message.."></textarea>';
        echo "<script type=\"text/javascript\">
         $('#messageArea').redactor({
            lang:'zh_cn',

            pasteBeforeCallback:function(html,event){
                if(event){
                console.log('==============');
                console.log((event.clipboardData || event.originalEvent.clipboardData).items);
               }
                return html;
            },
            pasteCallback: function(html)
            {
              //  console.log(html);
                return html;
            },
            plugins: ['table', 'video','image','paste'],
              imageManagerJson: '/upload/files',
              imageUpload: '/upload?_token=".csrf_token()."',
              fileUpload: '/upload?_token=".csrf_token()."'
        });
</script> ";
        return '';
        die('<h1>403</h1>');
        dd($request);

        $a = Config('adminhtml.url');
        dd($a);

        $user = User\User::find(2);
        Auth::setUser($user);
        $menu=Menu::getMenus($user);
        return view('test');
        dd($menu);



     exit;
     echo  former::horizontal_open()
           ->id('MyForm')
            ->secure()
            ->rules(['name' => 'required'])
            ->method('GET');

        echo  former::xlarge_text('name')
            ->class('myclass')
            ->value('Joseph')
            ->required();

        echo former::textarea('comments')
            ->rows(10)->columns(20)
            ->autofocus();

        echo former::actions()
            ->large_primary_submit('Submit')
            ->large_inverse_reset('Reset');

        echo former::close();
        dd();
        return $this->getIndex($request);
    }

    protected function getAvatar(){
        $avatars =  array (
            7 => 'Lovers-200x200-8.jpg',
            8 => 'Lovers-200x200-7.jpg',
            9 => 'Lovers-200x200-4.jpg',
            10 => 'Lovers-200x200-3.jpg',
            11 => 'Lovers-200x200-2.jpg',
            12 => 'Lovers-200x200-10.jpg',
            13 => 'Lovers-200x200-1.jpg',
            14 => '200x200-o9.jpg',
            15 => '200x200-o8.jpg',
            16 => '200x200-o7.jpg',
            17 => '200x200-o6.jpg',
            18 => '200x200-o5.jpg',
            19 => '200x200-o4.jpg',
            20 => '200x200-o3.jpg',
            21 => '200x200-o2.jpg',
            22 => '200x200-o18.jpg',
            23 => '200x200-o17.jpg',
            24 => '200x200-o16.jpg',
            25 => '200x200-o15.jpg',
            26 => '200x200-o14.jpg',
            27 => '200x200-o13.jpg',
            28 => '200x200-o12.jpg',
            29 => '200x200-o11.jpg',
            30 => '200x200-o10.jpg',
            31 => '200x200-o1.jpg',
            32 => '200x200-9.jpg',
            33 => '200x200-6.jpg',
            34 => '200x200-5.jpg',
            35 => '200x200-22.jpg',
            36 => '200x200-21.jpg',
            37 => '200x200-20.jpg',
            38 => '200x200-19.jpg',
            39 => '200x200-18.jpg',
            40 => '200x200-17.jpg',
            41 => '200x200-16.jpg',
            42 => '200x200-15.jpg',
            43 => '200x200-14.jpg',
            44 => '200x200-13.jpg',
            45 => '200x200-12.jpg',
            46 => '200x200-11.jpg',
        );
        return $avatars[rand(7,46)];
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex(Request $request)
	{

        $data=array(
            'form'=>array(
                'attributes'=>'name:form1',
                'options'=>'default_form_type:horizontal|fetch_errors:1|live_validation:1',
            ),
            'username'=>array(
                'attributes'=>'help:this is test username|state:error|label:Name',
                'rule'=>'required|max:20|alpha',
            ),
            'age'=>array(
                'type'=>'radio',
                'attributes'=>'help:set age|label:Age|value:2',
                'rule'=>'required|max:20|alpha',
                'options'=>array('1'=>1,2=>2,3=>2223,4=>4),
            ),
            'submit'=>array(
                'type'=>'submit',
                'attributes'=>'help:set age|label:submit|btn-primary',
            //    'rule'=>'required|max:20|alpha',
            //    'options'=>array('1'=>1,2=>2,3=>2223,4=>4),
            ),
        );

        die();

        $user = new User\User();
        $user->all();
        $grid = DataGrid::source($user);  //same source types of DataSet

        $grid->add('name','Username', true); //field name, label, sortable
        $grid->add('email','Email', true); //field name, label, sortable
     //   $grid->add('group.group_name','group_name'); //relation.fieldname
    //    $grid->add('{{ substr($body,0,20) }}...','Body'); //blade syntax with main field
     //   $grid->add('{{ $author->firstname }}','Author'); //blade syntax with related field
    //    $grid->add('body|strip_tags|substr[0,20]','Body'); //filter (similar to twig syntax)
   //     $grid->add('body','Body')->filter('strip_tags|substr[0,20]'); //another way to filter
        $grid->edit('/test/edit', 'Edit','modify|delete'); //shortcut to link DataEdit actions
        $grid->link('/test/edit',"Add New", "TR");  //add button
        $grid->orderBy('id','desc'); //default orderby
        $grid->paginate(10); //pagination

       return  view('test', compact('grid'));
        return view('test');//compact(array('table'=>$table)));
	}

    public function put()
    {
        print_r(Input::all());
        //
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function anyEdit()
	{

     //  dd(Input::All());
	//	$user =new Auth\User();
    //    $id = Input::get('modify');

     //   $user =  Auth\User::find();
//dd($user->name);
        $form = DataEdit::source( User\User::with('groups'));
        $form->add('modify','modify', 'hidden');
        $form->add('name','Name', 'text')->rule('required|min:2');
        $form->add('email','Email', 'text');
        $form->add('password','Password', 'password');
        $form->add('group.group_id','group','tags');
     //   $form->add('group.group_name','groupName','text');
      //  $form->add('photo','Photo', 'image')->move('uploads/demo/')->fit(240, 160)->preview(120,80);
       // $form->submit('Save');

        $form->saved(function () use ($form) {
            $form->message("ok record saved");
            $form->link("/test","back to the form",'BR');
        });
        $form->build();
        return view('test',compact('form'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
