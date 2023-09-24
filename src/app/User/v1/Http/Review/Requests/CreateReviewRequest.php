<?php
namespace App\User\v1\Http\Review\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateReviewRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => request()->user()->id,
            'reviewable_type' => 'product'
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
            'reviewable_id' => [
                'required',
                'uuid',
                Rule::exists('products', 'id')
                    ->withoutTrashed()
            ],
            'rating' => ['required', 'integer', 'min:0', 'max:5'],
            'review' => ['required', 'string', 'min: 3']
        ];
    }
}
