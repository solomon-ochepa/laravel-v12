<?php

use App\Helpers\Phone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Nwidart\Modules\Module;

if (! function_exists('is_phone')) {
    /**
     * Check if a string is a phone number.
     */
    function is_phone($phone): bool
    {
        return Phone::validate($phone);
    }
}

if (! function_exists('is_email')) {
    /**
     * Check if a string is an email address.
     */
    function is_email($email): bool
    {
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}

if (! function_exists('username')) {
    function username(string $username): array
    {
        return match (true) {
            is_email($username) => ['email' => $username],
            is_phone($username) => ['phone' => $username],
            default => ['username' => $username],
        };
    }
}

if (! function_exists('routed')) {
    function routed(string|array $name): bool
    {
        return Route::has($name);
    }
}

if (! function_exists('can')) {
    /**
     * Determine if the entity has the given abilities.
     */
    function can($abilities, $arguments = []): bool
    {
        return Auth::check() and Auth::user()->can($abilities, $arguments);
    }
}

if (! function_exists('module')) {
    /**
     * Retrieves a module status or its instance.
     *
     * @param  string  $name  The name of the module.
     * @param  bool  $instance  Whether to return the module's instance instead of the status. Defaults to false [status].
     * @return bool|Module The module instance or its status.
     */
    function module(string $name, bool $instance = false): bool|Module
    {
        $modules = app('modules');
        if (! $modules->has($name)) {
            Log::error("Module '$name' not found.");

            return false;
        }

        return $instance ? $modules->find($name) : $modules->isEnabled($name);
    }
}
