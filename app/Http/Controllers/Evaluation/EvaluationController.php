<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\Controller;
use App\Http\Resources\EvaluationResource;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with([
            'user',
            'questionnaire',
        ])->get();

        return EvaluationResource::collection($evaluations);
    }

    public function show(Evaluation $evaluation)
    {
        $evaluation->load([
            'user',
            'questionnaire',
        ]);

        return new EvaluationResource($evaluation);
    }
}
