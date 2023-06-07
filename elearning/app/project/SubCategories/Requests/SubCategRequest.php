<?php

namespace App\project\SubCategories\Requests;

use App\Http\Requests\ApiRequest;

class SubCategRequest extends ApiRequest
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
            'category_id'=>'required|numeric',
            'sub_category_name' => 'required',
            'sub_category_description' => 'required',
            'image' => 'required|image',
        ];
    }
}
