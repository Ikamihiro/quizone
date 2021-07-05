<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationResource extends JsonResource
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
            'user' => new UserResource($this->whenLoaded('user')),
            'questionnaire' => new QuestionnaireResource($this->whenLoaded('questionnaire')),
            'finished_at' => $this->finished_at,
        ];
    }
}
