<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Option\{DeleteOptionRequest, StoreOptionRequest, UpdateOptionRequest};
use App\Http\Resources\OptionResource;
use App\Models\Option;
use Illuminate\Support\Facades\Log;

class OptionController extends Controller
{
    public function index()
    {
        $option = Option::with([
            'question',
        ])->get();

        return OptionResource::collection($option);
    }

    public function show(Option $option)
    {
        $option->load([
            'question',
        ]);

        return new OptionResource($option);
    }

    public function store(StoreOptionRequest $request)
    {
        $option = Option::create($request->validated());

        return new OptionResource($option);
    }

    public function update(UpdateOptionRequest $request, Option $option)
    {
        $option->update($request->validated());

        return new OptionResource($option);
    }

    public function delete(DeleteOptionRequest $request, Option $option)
    {
        Log::debug($request);

        $option->delete();

        return response()->noContent();
    }
}
