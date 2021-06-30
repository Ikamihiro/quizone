<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Topic\{DeleteTopicRequest, StoreTopicRequest, UpdateTopicRequest};
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Support\Facades\Log;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::with('questionnaires')->get();

        return TopicResource::collection($topics);
    }

    public function show(Topic $topic)
    {
        $topic->load([
            'questionnaires',
        ]);

        return new TopicResource($topic);
    }

    public function store(StoreTopicRequest $request)
    {
        $topic = Topic::create($request->validated());

        return new TopicResource($topic);
    }

    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        $topic->update($request->validated());

        return new TopicResource($topic);
    }

    public function delete(DeleteTopicRequest $request, Topic $topic)
    {
        Log::debug($request);

        $topic->delete();

        return response()->noContent();
    }
}
