<?php

namespace App\project\pdf\Requests;

use App\Http\Requests\ApiRequest;

class PdfRequest extends ApiRequest
{

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
            'pdf' => 'required|file|mimes:pdf',
        ];
    }
}
