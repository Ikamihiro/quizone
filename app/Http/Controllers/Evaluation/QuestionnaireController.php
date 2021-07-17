<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionnaireResource;
use App\Models\Questionnaire;

class QuestionnaireController extends Controller
{
    public function index()
    {
        $questionnaires = Questionnaire::paginate();

        return QuestionnaireResource::collection($questionnaires);
    }

    public function show(Questionnaire $questionnaire)
    {
        $questionnaire->load([
            'questions' => function ($query) {
                $query->with('options')->inRandomOrder();
            },
        ]);

        return new QuestionnaireResource($questionnaire);
    }
}
