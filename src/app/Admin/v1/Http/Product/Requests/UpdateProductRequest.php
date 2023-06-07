<?php

namespace App\Admin\v1\Http\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('product')?->id
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
            'title' => ['required', 'string', 'min:3', 'max:255', Rule::unique('products', 'title')
                ->ignore($this->route('product')?->id)
            ],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'quantity' => ['required', 'integer'],
            'available' => ['required', 'boolean'],
            'product_color_info' => ['required', 'array', 'min:1'],
            'product_color_info.*.id' => ['required', 'uuid', Rule::exists('product_colors', 'id')->withoutTrashed()],
            'product_color_info.*.color' => ['required', 'string', 'min:1'],
            'product_color_info.*.quantity' => ['required', 'integer'],
            'product_brand_ids' => ['required', 'array', 'min:1', Rule::exists('brands', 'id')->withoutTrashed()],
            'product_category_ids' => ['required', 'array', 'min:1', Rule::exists('categories', 'id')->withoutTrashed()]
        ];
    }
}
