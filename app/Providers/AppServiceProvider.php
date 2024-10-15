<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

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
        Vite::macro('image', fn (string $asset) => Vite::asset("resources/imgs/{$asset}"));

        Blade::directive('datetime', function (string $expression) {
            return "<?php echo ($expression)->format('m/d/Y H:M:S'); ?>";
        });

        Blade::directive('date', function (string $expression) {
            return "<?php echo ($expression)->format('m/d/Y'); ?>";
        });

        Blade::directive('time', function (string $expression) {
            return "<?php echo ($expression)->format('H:M:S'); ?>";
        });

        Gate::define('update-post', function (User $user, Post $post) {
            return $post->user_id === $user->id;
        });

        Gate::define('delete-post', function (User $user, Post $post) {
            return
                $post->user_id === $user->id ||
                $user->role === 'admin' ||
                $user->role === 'moderator';
        });

        Gate::define('update-comment', function (User $user, Comment $comment) {
            return $comment->user_id === $user->id;
        });

        Gate::define('delete-comment', function (User $user, Comment $comment) {
            return
                $comment->user_id === $user->id ||
                $user->role === 'admin' ||
                $user->role === 'moderator';
        });

        Gate::define('update-account', function (User $user, User $account) {
            return $user->id === $account->id || $user->role === 'admin';
        });

        Gate::define('delete-account', function (User $user, User $account) {
            return
                $user->id === $account->id ||
                $user->role === 'admin' ||
                $user->role === 'moderator' && $user->role === 'user';
        });

        Gate::define('report-account', function (User $user, User $account) {
            return $user->id !== $account->id;
        });

        Gate::define('report-post', function (User $user, Post $post) {
            return $user->id !== $post->user->id;
        });

        Gate::define('admin-dashboard', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
