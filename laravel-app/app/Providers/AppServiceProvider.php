<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\TaskPolicy;
use App\Models\Task;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
        Task::class => TaskPolicy::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-any-task', [TaskPolicy::class, 'viewAny']);
        Gate::define('view-task', [TaskPolicy::class, 'view']);
        Gate::define('create-task', [TaskPolicy::class, 'create']);
        Gate::define('update-task', [TaskPolicy::class, 'update']);
        Gate::define('delete-task', [TaskPolicy::class, 'delete']);
        Gate::define('restore-task', [TaskPolicy::class, 'restore']);
        Gate::define('force-delete-task', [TaskPolicy::class, 'forceDelete']);
    }
}
