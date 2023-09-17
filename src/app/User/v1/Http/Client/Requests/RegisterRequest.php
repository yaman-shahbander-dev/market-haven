<?php

namespace App\User\v1\Http\Client\Requests;

use Domain\Client\Enums\UserGenders;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:1', 'max:55'],
            'last_name' => ['required', 'string', 'min:1', 'max:55'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => ['required', Password::min(8)],
            'email' => ['required', Rule::unique('users', 'email'), 'max:255'],
            'gender' => ['required', new Enum(UserGenders::class)],
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'name' => $this->first_name . ' ' . $this->last_name,
        ]);
    }
}
