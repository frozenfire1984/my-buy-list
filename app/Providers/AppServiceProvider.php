<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /* for output into browser use dump instead Log::debug */
        app()->booted(function () {
            $request = app(Request::class);

            if (str_contains($request->url(), '.well-known')) {
                return;
            }

            $startTime = microtime(true);
            $queryCount = 0;

            Log::info('');
            Log::info('');
            Log::debug('>>> ' . $request->method() . ' ' . $request->url());


            DB::listen(function ($query) use (&$queryCount) {
                $queryCount++;
                Log::debug($query->sql, [
                    'bindings' => $query->bindings,
                    'time'     => $query->time . 'ms',
                ]);
            });

            app()->terminating(function () use ($startTime, &$queryCount) {
                $totalTime = round((microtime(true) - $startTime) * 1000, 2);
                Log::debug("<<< total: {$queryCount} queries, {$totalTime}ms");
            });
        });

        Gate::define('update-item', function (User $user, Item $item) {
            return $user->id === $item->user_id || $user->is_super_admin;
        });

        Gate::define('view-item', function (?User $user, Item $item) {
            return $item->user_id === null || $item->user_id === $user?->id || $user?->is_super_admin;
        });

        Gate::define('create-item', function (User $user) {
            return true;
        });

        /*Gate::define('super-admin', function (?User $user) {
            return $user->is_super_admin === true;
        });*/
    }
}
