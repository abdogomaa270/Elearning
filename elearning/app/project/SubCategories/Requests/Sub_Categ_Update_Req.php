<?php

namespace App\project\SubCategories\Requests;

use App\Http\Requests\ApiRequest;

class Sub_Categ_Update_Req extends ApiRequest
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
            'category_id'=>'numeric',
            'sub_category_name' => 'min:3',
            'sub_category_description' => 'max:255',
            'image' => 'image',
        ];
    }
}
