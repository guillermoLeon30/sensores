<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Horizon;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot(){
    Horizon::auth(function ($request) {
      if (optional(auth()->user())->isSuperAdmin()) {
        return true;
      }

      return false;
    });
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register(){
    //
  }
}
