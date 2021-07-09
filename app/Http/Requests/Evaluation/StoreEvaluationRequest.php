<?php

namespace App\Http\Requests\Evaluation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEvaluationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'questionnaire_id' => ['required', 'exists:questionnaires,id'],
            'answers.*.question_id' => ['required', 'exists:questions,id'],
            'answers.*.option_id' => ['required', 'exists:options,id'],
        ];
    }
}
