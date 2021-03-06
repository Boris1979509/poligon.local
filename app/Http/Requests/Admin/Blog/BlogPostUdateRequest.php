<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostUdateRequest extends FormRequest
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
            'excerpt'     => 'string|max:500|min:3',
            'content_raw' => 'required|string|min:3|max:10000',
            'category_id' => 'required|integer|exists:blog_categories,id',
        ];
    }
}
