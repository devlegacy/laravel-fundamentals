<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Repositories\MessagesInterface;
use App\Repositories\CacheMessages;
use App\Repositories\Messages;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MessagesInterface::class, CacheMessages::class);
        // app()->bind(MessagesInterface::class, Messages::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // * Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
        Schema::defaultStringLength(191);
        // * Change route verbs
        Route::resourceVerbs([
          'create'  => __('create'),
          'edit'    => __('edit'),
        ]);
    }
}
