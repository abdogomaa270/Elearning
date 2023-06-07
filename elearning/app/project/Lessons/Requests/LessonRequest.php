<?php

namespace App\project\Lessons\Requests;

use App\Http\Requests\ApiRequest;

class LessonRequest extends ApiRequest
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
            'name'=>'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'course_id' => 'required|exists:lessons,course_id',
            'content'=>'url|max:255',
            'image' => 'required|image',
        ];
    }
}
