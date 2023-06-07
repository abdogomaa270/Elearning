<?php

namespace App\project\quizzes\Requsts;

use App\Http\Requests\ApiRequest;

class QuizRequest extends ApiRequest
{ /**
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
            'course_id' => 'required|exists:courses,id',
            'question' => 'required|string|max:255',
            'ques_options'=>'required|string|max:256',
            'answer'=>'required|max:255',

        ];
    }

}
