<?php

namespace App\Providers;

use App\Models\NoteBook;
use App\Models\NoteTree;
use App\Models\Source;
use App\Models\Tag;
use App\Policies\NoteBookPolicy;
use App\Policies\NoteTreePolicy;
use App\Policies\SourcePolicy;
use App\Policies\TagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Source::class => SourcePolicy::class,
        NoteTree::class => NoteTreePolicy::class,
        NoteBook::class => NoteBookPolicy::class,
        Tag::class=>TagPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
