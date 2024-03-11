<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->role && $user->role->full_access==1) {
                return true;
            }
        });
        if(Schema::hasTable('pages'))
        {
            $pages = Page::all();

            foreach ($pages as $page)
            {
                Gate::define($page->key, function (User $user)use($page){
                    $role_pages  = $user->role->pages()->pluck('pages.id')->toArray();
                    return in_array($page->id, $role_pages);
                });
            }
        }
    }
}
