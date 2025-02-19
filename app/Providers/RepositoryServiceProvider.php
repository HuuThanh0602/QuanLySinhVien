<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Department\DepartmentRepositoriesInterface;
use App\Repositories\Department\DepartmentRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DepartmentRepositoriesInterface ::class , DepartmentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
