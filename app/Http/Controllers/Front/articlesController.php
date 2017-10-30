<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-7-13
 * Time: 上午2:53
 */

namespace App\Http\Controllers\Front;
use Input;
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
use App\Http\Controllers\Front\PageController;
use App\Ado\Models\Tables\Cms\Page;
use Validator;
use Context;
use Session;
use Zofe\Rapyd\Helpers\HTML as RHelper;



class articlesController extends PageController {
    protected $paginate=20;
    /**
     * 默认显示自己的文章
     * 查询所有自己的文章和共享的文章
     *  * +
     * 默认显示自己的文章和共享的文章
     * 查询所有自己的文章和共享的文章
     *  //文章列表和阅读的
     * @param string $uri
     * @return mixed
     */
    public function index($uri=''){
        $page = Page::where('url_key',$uri)->first();
        if($page && $page->exists()){
            return $this->page($uri,$page);
        }
        $user_id = 0;
        $user = Auth::user();
        if($user && $user->id)$user_id = $user->id;
        $article=$articles=$category=null;
        if(is_numeric($uri)){
            $article = Article::where('id',$uri)->first();
        }elseif(!empty($uri)){
            $article = Article::where('url_key',$uri)->first();
        }
        if($article){
            return $this->showArticle($article);
        }else{
            if(is_numeric($uri)){
                $category = Category::where('id',$uri)->first();
            }elseif(!empty($uri)){
                $category = Category::where('url_key',$uri)->first();
            }
            if($category) {
                $articles = $category->articles()->where('is_active',1)
                    ->where(function($query)use($user_id){
                        $query->where('share',1);
                        if($user_id)$query->orWhere('author_id',$user_id);
                    })->orderBy('id','desc')->paginate($this->paginate);
                Context::set('current_category',$category);
                Session::set('current_catalog_id',$category->id);
            }elseif(Input::has('tag')){
                $articles = Article::where('is_active',1)
                    ->where(function($query){
                        $query->where('title','like','%'.Input::get('tag').'%')->orWhere('content_heading','like','%'.Input::get('tag').'%');
                    })
                    ->where(function($query)use($user_id){
                        $query->where('share',1);
                        if($user_id)$query->orWhere('author_id',$user_id);
                    })->orderBy('id','desc')
                    ->paginate($this->paginate);
                $articles->addQuery('tag',Input::get('tag'));
            }else{
                $articles = Article::where('is_active',1)
                    ->where(function($query)use($user_id){
                        if(Setting::getPathValue('article.default.show.share')){
                            $query->where('share',1);
                            if($user_id)$query->orWhere('author_id',$user_id);
                        }else{
                            $query->where('author_id',$user_id);
                        }
                    })->orderBy('id','desc')->paginate($this->paginate);
            }
            return $this->showArticles($articles);
        }
    }

    //单文章展示
    protected function showArticle($article,$relations=null){
        $this->initDbConfig();
        //推荐阅读
        if(!$relations){
            $relations = Article::where('is_active',1)->orderBy('hits','desc')->take(20)->get();
        }
        $article->hits+=1;
        $article->save();
        //相关阅读
        $_tags = $article->tags;
        $tags = explode(',',$_tags);
        $feature = Article::where('is_active',1);
        foreach($tags as $tag){
            $feature->where('tags','like','%'.$tag.'%');
        }
        $feature = $feature->orderBy('hits','desc')->take(5)->get();

        $this->setTitle($article->title);
        if(!empty($article->meta_keywords))
        $this->setKeywords($article->meta_keywords);
        if(!empty($article->meta_description))
        $this->setDescription($article->meta_description);
        $canPost = 0;
        $user = Auth::user();
        if($user && $user->post_in)$canPost = 1;
        $this->viewComposer('layouts.partials.relation',['Relations',$relations,$canPost],'relations');
        $this->viewComposer('layouts.partials.feature',['feature',$feature,1],'feature');

        //评论
        $this->viewComposer('comment_list',
            Comments::where('is_active',1)
                ->where('article_id',$article->id)
                ->orderBy('id','desc')
                ->get(),'comments');

        //评论表单填写
        $comment_form =  $this->comment_form($article);
        $this->viewComposerInit();
        return View::make(config('front.template').'article_read',compact('article','comment_form'));
    }

    protected function showArticles($articles,$relations=null){
        $this->initDbConfig();
        //推荐阅读
        if(!$relations){
            $relations = Article::where('is_active',1)->where('share',1)->orderBy('hits','desc')->take(20)->get();
        }
        $this->setTitle(trans('article.list_title'));
        $this->setKeywords(trans('article.list_keywords'));
        $this->setDescription(trans('article.list_Description'));
        $canPost = 0;
        $user = Auth::user();
        if($user && $user->post_in)$canPost = 1;
        $this->viewComposer('layouts.partials.relation',['Relations',$relations,$canPost],'relations');
        $this->viewComposerInit();
        return View::make(config('front.template').'article_list',compact('articles'));
    }

    //写评论的
    protected function comment_form($article){
        $comment = new Comments();
        $comment->article_id = $article->id;
        if(Auth::user())
        $comment->user_id = Auth::user()->id;
        $comment->is_active = 1;

        $form = DataForm::source($comment);
        $form->add('comment','comment', 'redactor');
      //  $form->add('article_id','article_id', 'hidden');
       // $form->add('user_id','user_id', 'hidden');
        $form->add('quote_id','quote_id', 'hidden');
        $form->set('article_id',$article->id);

        $quoteId = Input::has('quote_id')?Input::get('quote_id'):0;
        if($quoteId){
            $quote = Comments::find($quoteId);
            if($quote){
                $form->set('quote_user_id',$quote->user_id);
               // $form->set('article_id',$quote->article_id);
            }
        }

        $form->submit('Save');
        $form->saved(function () use ($form,$article) {
           // $form->message("ok record saved");
          //  return Redirect::to(url('post/'. $article->url_key));
            $form->message("Record Saved");
            $form->link(route('article.show',['uri'=>$article->url_key]),"Back");

        });
        $form->build();
        return View::make(config('front.template').'comment_form', compact('form'));
    }

    //写文章的
    public function add($id=''){
        if(!Auth::user()->post_in)return abort('404');
        $this->initDbConfig();
        if($id && is_numeric($id)){
            $article = Article::findOrNew($id);
        }else{
            $article = new Article();
        }
        //发布人
        $article->author_id = Auth::user()->id;

        //如果没有图，就找内容中的第一张图作为缩略图
        if(!$article->image){
            $pattern ='<img.*?src="(.*?)">';
            preg_match($pattern,$article->content,$matches);
            $image=isset($matches[1])?$matches[1]:'';
            if($image){
                if(stripos($image,config('app.url'))!==false){
                    $_filename = explode('/',$image);
                    $image = end($_filename);
                }
            }
            $article->image = $image;
        }

        //默认全过
        $article->is_active = 1;
        $edit = DataEdit::source($article);
    //   Config::set('rapyd.data_edit.button_position.save','BL');
        $edit->label(trans('article.edit article'));
        $edit->link("post/",trans("article.back"), "TR")->back();
        $edit->add('title',trans('Title'), 'text')->rule('required|min:5')->attributes(['placeholder'=>trans("article.placeholder_title")]);
        $edit->add('url_key',trans('url_key'), 'text')->rule('required|min:5|AlphaDash')->attributes(['placeholder'=>trans("article.placeholder_url_key")]);
        $edit->add('content',trans('content'), 'redactor')->rule('required|min:20')->attributes(['placeholder'=>trans("article.placeholder_content") ]);
        $edit->add('content_heading',trans('content_heading'), 'text')->attributes(['placeholder'=>trans("article.placeholder_content_heading") ]);
        $edit->add('tags',trans('tags'), 'text')->attributes(['placeholder'=>trans("article.placeholder_tags")]);
        $edit->add('author_id',trans('author_id'), 'hidden');
        $edit->add('category_ids[]',trans('category'),'select')->options(Category::select('name as title','id as value')->where('parent_id','>',0)->get()->toArray())
            ->attributes(['multiple'=>'multiple'])
            ->setValues(new ArticleCategory(),'article_id','category_id');

        //保存分类
        Article::created($this->saveArticleCategory($article));
        Article::saved($this->saveArticleCategory($edit->model));

        $relations = Article::where('is_active',1)->where('author_id',Auth::user()->id)->orderBy('id','desc')->take(20)->get();
        //展示其他块
        $this->setTitle(config('front.site_name'));
        $this->setKeywords(config('front.site_keywords'));
        $this->setDescription(config('front.site_description'));
        $this->viewComposer('layouts.partials.relation',['Relations',$relations,2],'relations');
        $this->viewComposerInit();
        return View::make(config('front.template').'article_add', compact('edit'));
    }

    //展示某人的文章列表
    public function author(){
        $id=Input::get('id');
        $user = User::where('id',(int)$id)->get();
        if($user->first()){
            $user = $user->first();
            $articles = $user->articles;
            return $this->showArticles($articles);
        }else{
            return $this->showArticles(null);
        }
    }
    /**
     * @param $article
     * @return callable
     */
    protected function saveArticleCategory($article){
        return function() use ($article){
            $article_id = $article->id;
            if(!$article_id)return ;
            if(Input::has('category_ids')){
                $category_ids =  Input::get('category_ids');
                if(!empty($category_ids)){
                    ArticleCategory::where('article_id',$article_id)->delete();
                    $data['article_id']=$article_id;
                    foreach($category_ids as $category_id){
                        $data['category_id']=$category_id;
                        ArticleCategory::create($data);
                    }
                }
            }
        };
    }

    //写评论的
    protected function comment_save(){
        $comment = new Comments();
        $input = Input::all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users',
        ]);
        $comment->article_id = Input::get('article_id');
        $comment->quote_id = Input::get('quote_id');
       // $comm = RHelper::xssfilter(Input::get('comment_content'));
        $comm = Input::get('comment_content');
        $comm = htmlentities($comm);
        $comment->comment = $comm;
        if(Auth::user())
            $comment->user_id = Auth::user()->id;
        $comment->is_active = 1;
        $quoteId = Input::has('quote_id')?Input::get('quote_id'):0;
        if($quoteId){
            $quote = Comments::find($quoteId);
            if($quote){
                $comment->quote_user_id=$quote->user_id;
                $comment->article_id = $quote->article_id;
            }
        }
        $comment->save();
        return back();
    }
}