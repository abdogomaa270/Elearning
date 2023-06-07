<?php

namespace App\project\Courses\Requests;

use App\Http\Requests\ApiRequest;

class Course_Update_Request extends ApiRequest
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
            'sub_category_id' => 'nullable|numeric',
            'instructor_id' => 'nullable|numeric',
            'course_name'=>'nullable|string|max:255',
            'course_description'=>'nullable|string|max:65535',
            'course_price'=>'nullable|numeric|min:0',
            'image' => 'nullable|image',
        ];
    }
}
