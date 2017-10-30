<?php namespace App\Ado\Controllers\Front;
use Illuminate\Support\Facades\View;
use Route;
use App\Ado\Models\Tables\Cms\Article;
use App\Ado\Models\Tables\Cms\Category;
use App\Ado\Models\Tables\Cms\ArticleCategory;
use App\Ado\Models\Tables\Cms\Comments;
use App\Ado\Models\Document;
use App\Ado\Models\Breadcrumbs;
use App\Ado\Models\Tables\Core\Setting;
use Auth;
use DataForm;
use DataEdit;
use Config;
use Redirect;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

}
