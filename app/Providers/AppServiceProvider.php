<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Agent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('layouts.nav', function ($view) {
            $view->with('navs', \App\Models\Category::getNavs());
            $view->with('noticeUnread', \App\Models\Notice::getUnread());
            $view->with('enums', [
                'types' => config('enums.types'),
            ]);
            $agent = new Agent();
            if ($agent->match('MicroMessenger')) {
                $view->with('isWeixin', true);
            } else {
                $view->with('isWeixin', false);
            }
        });
        View::composer('*', function ($view) {
            $view->with('enums', [
                'project' => [
                    'type' => config('enums.project.type'),
                ],
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \DB::enableQueryLog();
        // dd(\DB::getQueryLog());
        //
    }
}
