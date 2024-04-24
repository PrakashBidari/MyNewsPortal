<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AddNewsRequest extends FormRequest
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
            'title' => ['required', 'max:200'],
            'author' => ['required', 'max:200'],
            'description' => ['required'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
            'view_no' => ['nullable'],
        ];

        if ($this->isMethod('put')) {
            $rules['slug'] = ['required', Rule::unique('news')->ignore($this->news)];
        } else {
            $rules['slug'] = ['required', 'max:200', 'unique:news'];
        }

        return $rules;
    }
}
