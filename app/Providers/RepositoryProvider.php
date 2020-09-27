<?php

namespace App\Providers;

use App\Repositories\ArticlesRepository;
use App\Repositories\ArticlesRepositoryInterface;
use App\Repositories\AuthorRepository;
use App\Repositories\AuthorRepositoryInterface;
use App\Repositories\CategoriesRepository;
use App\Repositories\CategoriesRepositoryInterface;
use App\Repositories\SubscriptionRepository;
use App\Repositories\SubscriptionRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class, );
        $this->app->bind(CategoriesRepositoryInterface::class,CategoriesRepository::class, );
        $this->app->bind(ArticlesRepositoryInterface::class,ArticlesRepository::class, );
        $this->app->bind(AuthorRepositoryInterface::class,AuthorRepository::class, );
        $this->app->bind(SubscriptionRepositoryInterface::class,SubscriptionRepository::class, );
    }

    public function boot()
    {
        //
    }
}
