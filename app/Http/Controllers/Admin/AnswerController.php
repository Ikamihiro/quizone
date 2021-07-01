<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\{DeleteAnswerRequest, StoreAnswerRequest, UpdateAnswerRequest};
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use Illuminate\Support\Facades\Log;

class AnswerController extends Controller
{
    public function index()
    {
        $answers = Answer::with([
            'question',
        ])->get();

        return AnswerResource::collection($answers);
    }

    public function show(Answer $answer)
    {
        $answer->load([
            'question',
        ]);

        return new AnswerResource($answer);
    }

    public function store(StoreAnswerRequest $request)
    {
        $answer = Answer::create($request->validated());

        return new AnswerResource($answer);
    }

    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        $answer->update($request->validated());

        return new AnswerResource($answer);
    }

    public function delete(DeleteAnswerRequest $request, Answer $answer)
    {
        Log::debug($request);

        $answer->delete();

        return response()->noContent();
    }
}
