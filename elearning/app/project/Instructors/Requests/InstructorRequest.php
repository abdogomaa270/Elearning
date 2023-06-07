<?php

namespace App\project\Instructors\Requests;

use App\Http\Requests\ApiRequest;

class InstructorRequest extends ApiRequest
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
            'instructor_name' => 'required|min:3',
            'instructor_description' => 'required',
            'image' => 'required|image',
        ];
    }
}
