<?php
/**
 * Email: 114458573@qq.com .
 * User: 杜兵
 * Date: 15-6-27
 * Time: 上午8:41
 */

namespace App\Providers;
use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider{
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // Frontend
        View::composer('frontend.layout.menu', 'App\Ado\Composers\Frontend\MenuComposer');
        View::composer('frontend.layout.layout', 'App\Ado\Composers\Frontend\SettingComposer');
        View::composer('frontend.layout.footer', 'App\Ado\Composers\Frontend\ArticleComposer');
        View::composer('frontend.news.sidebar', 'App\Ado\Composers\Frontend\NewsComposer');

      //  View::composer(config('front.template').'layouts.partials.head', 'App\Ado\Composers\Frontend\HeadComposer');
      //  View::composer(config('front.template').'layouts.partials.breadcrumb', 'App\Ado\Composers\Frontend\BreadcrumbsComposer');
        View::composer(config('front.template').'layouts.partials.header', 'App\Ado\Composers\Frontend\NavbarComposer');

        // Backend
       // View::composer(config('front.template').'backend.layouts.partials.head', 'App\Ado\Composers\Backend\HeadComposer');
        View::composer(config('adminhtml.template').'layouts.partials.sidebar', 'App\Ado\Composers\Backend\SidebarComposer');

    }
}