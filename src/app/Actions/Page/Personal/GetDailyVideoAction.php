<?php

namespace App\Actions\Page\Personal;

use App\Models\DailyVideo;

class GetDailyVideoAction
{
    public function handle($user, $subscribe)
    {
        if (! is_array($subscribe)) {

            $video = DailyVideo::whereDate('date', '>=', $subscribe->pivot->date_start)
                ->whereDate('date', '<=', $subscribe->pivot->date_end)
                ->get();

            if ($video) {
                return $video;
            }
        }

    }
}
