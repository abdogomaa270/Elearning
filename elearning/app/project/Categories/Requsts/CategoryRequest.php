<?php

namespace App\project\Categories\Requsts;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends ApiRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_name' => 'required',
            'category_description' => 'required',
            'image' => 'required|image',
        ];
    }
}
