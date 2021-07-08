<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Evaluation\StoreEvaluationRequest;
use App\Http\Resources\EvaluationResource;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with([
            'user',
            'questionnaire',
            'answers',
        ])->get();

        return EvaluationResource::collection($evaluations);
    }

    public function show(Evaluation $evaluation)
    {
        $evaluation->load([
            'user',
            'questionnaire',
            'answers',
        ]);

        return new EvaluationResource($evaluation);
    }

    public function store(StoreEvaluationRequest $request)
    {
        DB::beginTransaction();

        try {
            $evaluation = Auth::user()->evaluations()->create([
                'questionnaire_id' => $request->questionnaire_id,
            ]);

            foreach ($request->answers as $answer) {
                $evaluation->answers()->create($answer);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        return new EvaluationResource($evaluation);
    }
}
