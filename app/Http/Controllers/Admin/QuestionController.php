<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\DeleteQuestionRequest;
use App\Http\Requests\Question\StoreQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;
use App\Models\Question;
use App\Http\Resources\QuestionResource;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with([
            'questionnaire'
        ])->get();

        return QuestionResource::collection($questions);
    }

    public function show(Question $question)
    {
        $question->load([
            'questionnaire',
        ]);

        return new QuestionResource($question);
    }

    public function store(StoreQuestionRequest $request)
    {
        $question = Question::create($request->validated());

        return new QuestionResource($question);
    }

    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update($request->validated());

        return new QuestionResource($question);
    }

    public function delete(DeleteQuestionRequest $request, Question $question)
    {
        Log::debug($request);

        $question->delete();

        return response()->noContent();
    }
}
