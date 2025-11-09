<?php

namespace Modules\Auth\app\Livewire;

use App\Helpers\Phone;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Modules\Auth\app\Livewire\Form\RegistrationForm;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public RegistrationForm $form;

    public function render(): View
    {
        return view('auth::livewire.register')->layout('components.layouts.auth', [
            'title' => __('Register'),
            'description' => __('Fill the form to create an account'),
        ]);
    }

    public function updatedFormPhone($phone): void
    {
        // Normalize the phone number
        $this->form->phone = Phone::normalize($phone, $this->form->phone_country_code ?? 'NG');
    }

    public function updatedFormPhoneCountryCode($code): void
    {
        $this->form->phone_country_code = $code;
        // Normalize the phone number if it exists
        if ($this->form->phone) {
            $this->form->phone = Phone::normalize($this->form->phone, $this->form->phone_country_code);
        }
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $this->form->store();
    }
}
