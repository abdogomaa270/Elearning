<?php

namespace App\project\Courses\Requests;

use App\Http\Requests\ApiRequest;

class CourseRequest extends ApiRequest
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
            'sub_category_id' => 'required|numeric',
            'instructor_id' => 'required|numeric',
            'course_name'=>'required|string|max:255',
            'course_description'=>'nullable|string|max:65535',
            'course_price'=>'required|numeric|min:0',
            'image' => 'required|image',
            'certificate' => 'required|image',
        ];
    }
}
