<?php

namespace App\Providers;

use App\Models\Region;
use App\Models\Ville;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // comp code
        Blade::directive('bind', function ($bind = null) {
            return '<?php \App\classes\FormDataBinder::bind(' . $bind  . ') ?>';
        });
        Blade::directive('endbind', function () {
            return '<?php \App\classes\FormDataBinder::end() ?>';
        });



        Blade::aliasComponent('components.forms.input' , 'input');


        // temp code


        view()->composer('layout.master', function($view) {
            $theme = \Cookie::get('theme');
            if ($theme == 'darkmode') {
                $theme = 'dark';
            }

            $view->with('theme', $theme);
        });

        view()->composer('layout.master-auth', function($view) {
            $theme = \Cookie::get('theme');
            if ($theme == 'darkmode') {
                $theme = 'dark';
            }

            $view->with('theme', $theme);
        });







        // unguard
        Ville::unguard();
        Region::unguard();


    }
}
