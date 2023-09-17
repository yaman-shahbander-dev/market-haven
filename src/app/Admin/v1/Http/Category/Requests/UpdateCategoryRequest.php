<?php

namespace App\Admin\v1\Http\Category\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
           'id' => $this->route('category')?->id
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
            'name' => [
                'required',
                'string',
                'min:3',
                'max:55',
                Rule::unique('categories', 'name')->ignore($this->route('category'))
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
