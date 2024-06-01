<?php

namespace Admin\Providers;

use Admin\Models\{
    Admin,Organization
};

use Admin\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AdminServiceProvider extends ServiceProvider
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
        //dd(config('database.default'), Admin::onlyTrashed()->count());
        view()->composer('Admin::_components.layout.sidebar', function ($view) {
            $view->with([
                'adminTrashesCount'    => Admin::onlyTrashed()->count(),
                'organizationTrashesCount'    => Organization::onlyTrashed()->count(),
                'roleTrashesCount'      => Role::onlyTrashed()->count(),
            ]);
        });

        $moduleName = 'Admin';
        config([
            $moduleName => File::getRequire(loadConfigFile('routePrefix', $moduleName))
        ]);
        $this->loadRoutesFrom(loadRoute('web', $moduleName));
        $this->loadViewsFrom(loadViews($moduleName), $moduleName);
        $this->loadTranslationsFrom(loadTranslations($moduleName), $moduleName);
        $this->loadMigrationsFrom(loadMigrations($moduleName));
        Blade::componentNamespace('Admin\View\Components', 'admin');
    }
}
