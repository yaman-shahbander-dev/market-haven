<?php
namespace App\User\v1\Http\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrderRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => request()->user()->id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:2'],
            'last_name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'email'],
            'payment_gateway' => [
                'required',
                Rule::exists('payment_gateways', 'key')
                    ->withoutTrashed()
                    ->whereNull('disabled_at')
            ],
            'cart_id' => [
                'required',
                'uuid',
                Rule::exists('carts', 'id')->withoutTrashed()
            ],
            'cart_products' => [
                'required',
                'array',
                'min:1',
            ],
            'cart_products.*.id' => ['required', 'uuid', Rule::exists('cart_product', 'id')->withoutTrashed()],
            'cart_products.*.quantity' => ['required', 'integer']
        ];
    }
}
