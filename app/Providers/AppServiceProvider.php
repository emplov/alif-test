<?php

namespace App\Providers;

use App\Http\Logic\Repositories\ContactRepository;
use App\Http\Logic\Repositories\Contracts\ContactRepositoryInterface;

use App\Http\Logic\Repositories\EmailRepository;
use App\Http\Logic\Repositories\Contracts\EmailRepositoryInterface;

use App\Http\Logic\Repositories\PhoneRepository;
use App\Http\Logic\Repositories\Contracts\PhoneRepositoryInterface;

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
        $this->registerRepositoryInterfaces();
    }

    public function registerRepositoryInterfaces()
    {
        $this->app->bind(EmailRepositoryInterface::class, EmailRepository::class);
        $this->app->bind(PhoneRepositoryInterface::class, PhoneRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
    }
}
