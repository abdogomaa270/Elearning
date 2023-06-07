<?php

namespace App\project\Categories\Requsts;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CatupdateRequest extends ApiRequest
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
            'category_name' => 'min:3',
            'category_description' => 'max:255',
            'image' => 'image',
        ];
    }
}
