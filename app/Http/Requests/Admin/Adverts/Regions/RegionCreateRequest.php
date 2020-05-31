<?php

namespace App\Http\Requests\Admin\Adverts\Regions;

use Illuminate\Foundation\Http\FormRequest;

class RegionCreateRequest extends FormRequest
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
            'name'   => 'required|string|max:255|unique:regions,name,NULL,id,parent_id,' . ($this->parent ?: 'NULL'),
            //'slug'   => 'required|string|max:255|unique:regions,slug,NULL,id,parent_id,' . ($this->parent ?: 'NULL'),
            'parent' => 'nullable|exists:regions,id',
        ];
    }
}
