<?php

namespace App\Providers;

use App\Repositories\BaseRepositories\DepartRepository;
use App\Repositories\Interfaces\DepartRepositoriesInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DepartRepositoriesInterface::class , DepartRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
