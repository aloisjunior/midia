<?php

namespace ARsig\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'ARsig\Events\NovoContatoSite' => [
            'ARsig\Listeners\EmailBoasVindasNovoContato',
            'ARsig\Listeners\NotificarAdminsSobreNovoContato',
        ],
        'ARsig\Events\NovoDownloadSite' => [
            'ARsig\Listeners\EnviarLinkDownloadContato',
            'ARsig\Listeners\NotificarAdminsSobreNovoDownload',
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Illuminate\Auth\Events\Verified' => [
            'ARsig\Listeners\Usuario_EmailVerificado',
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
