<?php

namespace App\Admin\v1\Http\Brand\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
           'id' => $this->route('brand')?->id
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
                Rule::unique('brands', 'name')->ignore($this->route('brand')?->id)
            ],
        ];
    }
}
