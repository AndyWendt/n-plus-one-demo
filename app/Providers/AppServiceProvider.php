<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $count = 0;
        \DB::listen(function($query) use (&$count) {
            \Log::info([
                'count' => ++$count,
                'time'  => $query->time,
                'bindings' => $query->bindings,
                'sql' => $query->sql,
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
