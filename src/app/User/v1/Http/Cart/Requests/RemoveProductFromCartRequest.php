<?php
namespace App\User\v1\Http\Cart\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveProductFromCartRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'product_id' => $this->product->id,
            'cart_id' => $this->cart->id,
            'price' => $this->product->productDetail()->first()->price,
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
            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],
        ];
    }
}
