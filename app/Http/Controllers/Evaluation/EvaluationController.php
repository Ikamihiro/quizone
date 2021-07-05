<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Evaluation\StoreEvaluationRequest;
use App\Http\Resources\EvaluationResource;
use App\Models\Evaluation;
use DB;
use Illuminate\Support\Facades\Auth;

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

    public function store(StoreEvaluationRequest $request)
    {
        $evaluation = Auth::user()->evaluations()->create([
            'questionnaire_id' => $request->questionnaire_id,
        ]);

        return new EvaluationResource($evaluation);
    }
}
