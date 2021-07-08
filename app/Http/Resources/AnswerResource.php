<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'evaluation' => new EvaluationResource($this->whenLoaded('evaluation')),
            'question' => new QuestionResource($this->whenLoaded('question')),
            'option' => new OptionResource($this->whenLoaded('option')),
        ];
    }
}
