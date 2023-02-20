<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // サンプル
        $this->app->bind(
            \App\Repositories\Interfaces\SampleInterface::class,
            \App\Repositories\SampleRepository::class
        );
        // 休暇申請
        $this->app->bind(
            \App\Repositories\Interfaces\HolidayInterface::class,
            \App\Repositories\HolidayRepository::class
        );

    }
}
