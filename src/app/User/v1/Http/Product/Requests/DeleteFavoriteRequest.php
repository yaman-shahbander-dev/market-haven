<?php
namespace App\User\v1\Http\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shared\Enums\MorphEnum;

class DeleteFavoriteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'uuid',
                Rule::exists('products', 'id')
            ],
        ];
    }

    public function passedValidation()
    {
        $this->replace([
            'user_id' => auth()->user()->id,
            'favorable_id' => $this->product_id,
            'favorable_type' => MorphEnum::PRODUCT->value,
        ]);
    }
}
