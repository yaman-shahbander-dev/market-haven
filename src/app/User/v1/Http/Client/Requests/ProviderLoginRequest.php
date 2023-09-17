<?php
namespace App\User\v1\Http\Client\Requests;

use Domain\Client\Enums\ProviderTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProviderLoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'provider' => ['required', new Enum(ProviderTypes::class)],
        ];
    }
}
