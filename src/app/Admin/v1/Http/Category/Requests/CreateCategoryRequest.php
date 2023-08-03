<?php

namespace App\Admin\v1\Http\Category\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:55',
                Rule::unique('categories', 'name')
            ],
            'main_category_id' => [
                'nullable',
                'uuid',
                Rule::exists('categories', 'id')
                    ->whereNull('main_category_id')
                    ->withoutTrashed()
            ]
        ];
    }
}
