<?php

namespace App\Web\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Web\Events\Event'    => [
            'App\Web\Listeners\EventListener',
        ],
        SocialiteWasCalled::class => [
            \SocialiteProviders\Weixin\WeixinExtendSocialite::class,
            \SocialiteProviders\WeixinWeb\WeixinWebExtendSocialite::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
