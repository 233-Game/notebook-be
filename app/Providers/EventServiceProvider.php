<?php

namespace App\Providers;

use App\Models\NoteBook;
use App\Models\NoteTree;
use App\Models\Source;
use App\Observers\NoteBookObserver;
use App\Observers\NoteTreeObserver;
use App\Observers\SourceObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Source::observe(SourceObserver::class);
        NoteTree::observe(NoteTreeObserver::class);
        NoteBook::observe(NoteBookObserver::class);
    }
}
