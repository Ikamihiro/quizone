<?php

namespace App\Listeners;

use App\Events\CreatingAnswerEvent;
use App\Models\Option;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ValidateAnswer
{
    /**
     * Handle the event.
     *
     * @param  CreatingAnswerEvent  $event
     * @return void
     */
    public function handle(CreatingAnswerEvent $event)
    {
        $option = Option::find($event->getAnswer()->option_id);

        if ($option)
            $event->getAnswer()->correct = $option->correct;
    }
}
