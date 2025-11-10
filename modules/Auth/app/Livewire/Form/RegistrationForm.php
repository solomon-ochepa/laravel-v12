<?php

namespace Modules\Auth\app\Livewire\Form;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;
use Modules\Auth\App\Http\Requests\CreateUserRequest;
use Modules\User\App\Models\User;

class RegistrationForm extends Form
{
    public string $first_name = '';

    public string $other_name = '';

    public string $last_name = '';

    public string $username = '';

    public ?string $phone = '';

    public ?string $phone_country_code = 'NG';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $terms;

    public function rules()
    {
        return (new CreateUserRequest)->rules();
    }

    /**
     * Handle an incoming registration request.
     */
    public function store()
    {
        if (Auth::check()) {
            return redirect(route('dashboard', absolute: false));
        }

        $validated = $this->validate();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::firstOrCreate(Arr::only($validated, ['username', 'phone', 'email']), $validated);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
