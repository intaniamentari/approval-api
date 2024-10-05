<?php

namespace App\Providers;

use App\Repositories\ApprovalRepository;
use App\Repositories\ApprovalStageRepository;
use App\Repositories\ApproverRepository;
use App\Repositories\Contracts\ApprovalRepositoryInterface;
use App\Repositories\Contracts\ApprovalStageRepositoryInterface;
use App\Repositories\Contracts\ApproverRepositoryInterface;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use App\Repositories\ExpenseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ApprovalStageRepositoryInterface::class, ApprovalStageRepository::class);
        $this->app->bind(ApproverRepositoryInterface::class, ApproverRepository::class);
        $this->app->bind(ExpenseRepositoryInterface::class, ExpenseRepository::class);
        $this->app->bind(ApprovalRepositoryInterface::class, ApprovalRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
