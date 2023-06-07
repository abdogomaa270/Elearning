<?php

namespace App\project\Lessons\Requests;

use App\Http\Requests\ApiRequest;

class Lesson_Update_Request extends ApiRequest
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
            'name'=>'string|max:255',
            'description' => 'string|max:65535',
            'course_id' => 'nullable',
            'content'=>'url|max:255',
            'image' => 'image',
        ];
    }
}
