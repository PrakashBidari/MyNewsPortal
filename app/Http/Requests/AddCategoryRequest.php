<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'parent_id' => ['nullable'],
            'slug' => ['required', 'max:40'],
            'image' => ['nullable', 'mimes:png,jpeg,jpg'],
        ];

        if ($this->isMethod('put')) {
            $rules['name'] = ['required', Rule::unique('categories')->ignore($this->category)];
        } else {
            $rules['name'] = ['required', 'max:35', 'unique:categories'];
        }

        return $rules;
    }
}
