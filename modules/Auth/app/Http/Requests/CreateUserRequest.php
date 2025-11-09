<?php

namespace Modules\Auth\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class CreateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:1', 'max:32'],
            'other_name' => ['nullable', 'string', 'min:1', 'max:32'],
            'last_name' => ['required', 'string', 'min:1', 'max:32'],
            'phone' => ['required', 'string', 'max:16', 'unique:users'],
            'username' => ['nullable', 'lowercase', 'string', 'min:3', 'max:16', 'unique:users'],
            'email' => ['nullable', 'email', 'lowercase', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'terms' => ['accepted'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
