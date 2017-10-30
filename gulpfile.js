const elixir = require('laravel-elixir');

//require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
/*
elixir(function(mix) {
    mix.scripts(['jquery.min.js',
            'bootstrap.min.js',
            'bootstrap-switch.min.js',
        ], 'public/assets/js/base.js')
        .styles(['bootstrap.min.css',
                 'bootstrap-switch.min.css',
             ] , 'public/assets/css/base.css');
});
*/

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.scripts([
        'vue.min.js',
        'jquery.min.js',
        'bootstrap.min.js',
        'Chart.min.js',
        'bootstrap-switch.min.js',
        'jquery.matchHeight-min.js',
        'jquery.dataTables.min.js',
        'dataTables.bootstrap.min.js',
        'select2.full.min.js',
        'ace/ace.js',
        'ace/mode-html.js',
        'ace/theme-github.js',
        'app.js',
        'index.js'], 'public/assets/js/all.js')
        .scripts([
            'vue.min.js',
            'jquery.min.js',
            'bootstrap.min.js',
            'bootstrap-switch.min.js',
            'jquery.matchHeight-min.js',
            'select2.full.min.js',
            'ace/ace.js',
            'ace/theme-github.js',
            'webcalendar.js',
            'star-rating.min.js'], 'public/assets/js/base.js')
        .scripts(['redactor/redactor.js',
            'redactor/plugins/fontfamily/fontfamily.js',
            'redactor/plugins/fontcolor/fontcolor.js',
            'redactor/plugins/fontsize/fontsize.js',
            'redactor/plugins/textdirection/textdirection.js',
            'redactor/plugins/textexpander/textexpander.js',
            'redactor/plugins/imagemanager/imagemanager.js',
            'redactor/plugins/video/video.js',
            'redactor/plugins/table/table.js',
            'redactor/plugins/definedlinks/definedlinks.js',
            'redactor/plugins/counter/counter.js',
            'redactor/plugins/limiter/limiter.js',
            'redactor/plugins/clips/clips.js',
            'redactor/plugins/fullscreen/fullscreen.js'], 'public/assets/js/redactor.js')
        .styles(['../js/redactor/redactor.css'],'public/assets/css/redactor.css')
        .styles(['bootstrap.min.css',
            'font-awesome.min.css',
            'animate.min.css',
            'bootstrap-switch.min.css',
            'checkbox3.min.css',
            'select2.min.css',
            'style.css',
            'star-rating.min.css',
            'bootstrap-social.css',
            'themes/flat-blue.css'], 'public/assets/css/base.css')
        .styles(['bootstrap.min.css',
            'font-awesome.min.css',
            'animate.min.css',
            'bootstrap-switch.min.css',
            'checkbox3.min.css',
            'jquery.dataTables.min.css',
            'dataTables.bootstrap.css',
            'select2.min.css',
            'style.css',
            'bootstrap-social.css',
            'themes/flat-blue.css'], 'public/assets/css/all.css')
        .scripts([
            'vue.min.js',
            'jquery.min.js',
            'bootstrap.min.js',
            'bootstrap-dialog.js',
            'select2.full.min.js',
            'webcalendar.js',
            'star-rating.min.js',
            'custom.js'
        ], 'public/assets/js/app.js')
        .styles(['bootstrap.min.css',
            'bootstrap-theme.min.css',
            'font-awesome.min.css',
            'bootstrap-dialog.css',
            'animate.min.css',
            'select2.min.css',
            'star-rating.min.css'
            //  'custom.css'
        ], 'public/assets/css/app.css')
        .version([
            'public/assets/js/all.js',
            'public/assets/css/all.css',
            'public/assets/js/base.js',
            'public/assets/css/base.css',
            'public/assets/js/app.js',
            'public/assets/css/app.css',
            'public/assets/js/redactor.js',
            'public/assets/css/redactor.css'
        ]);
});
