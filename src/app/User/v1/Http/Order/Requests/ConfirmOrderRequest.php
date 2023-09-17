<?php
namespace App\User\v1\Http\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'gateway_client_payment_id' => ['required'],
        ];
    }
}
