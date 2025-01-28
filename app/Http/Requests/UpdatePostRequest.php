<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->hasPermissionTo('edit-post');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'file' => ['array'],
            'file.*' => ['mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function messages() {
        return [
            'title.required' => 'Title is required',
            'contenttiny.required' => 'Content is required',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Category not found',
            'file.*.mimes' => 'File must be an image (jpeg, png, jpg)',
            'file.*.max' => 'File must not exceed 2MB',
        ];

    }
}
