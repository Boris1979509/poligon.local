<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|min:5|max:200',
            'description' => 'required|max:500|min:3',
            'parent_id'   => 'required|integer|exists:blog_categories,id',
        ];
    }
}
