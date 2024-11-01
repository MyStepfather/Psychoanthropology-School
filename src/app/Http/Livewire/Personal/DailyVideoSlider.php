<?php

namespace App\Http\Livewire\Personal;

use App\Actions\Page\Personal\GetDailyVideoAction;
use App\Actions\Subscribes\GetSubscribesAction;
use App\Constants\SubscribesTypes;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DailyVideoSlider extends Component
{
    public $activeSubscribe;
    public $user;
    public $dailyVideos;
    public $video;
    public $currentday;
    public function mount(GetSubscribesAction $getSubscribe, GetDailyVideoAction $getDailyVideo)
    {
        $this->user = Auth::user();

        $this->activeSubscribe = $getSubscribe
            ->handle($this->user, [
                SubscribesTypes::VIDEO,
                SubscribesTypes::ZOOM,
            ], 'active');
        if ($this->activeSubscribe) {
            $this->dailyVideos = $getDailyVideo->handle($this->user, $this->activeSubscribe);

            $this->currentday = now();
            $video = $this->dailyVideos
                ->where('date','<=', $this->currentday)
                ->last();
            if($video) {
                $this->video = $video;
                $this->currentday = $this->video->date;
            }

        } else {
            $this->dailyVideos = 0;
        }
    }

    public function incrementCurrentDay()
    {
        $video = $this->dailyVideos
            ->where('date','>', $this->currentday)
            ->first();
        if ($video) {
            $this->video = $video;
            $this->currentday = $this->video->date;
        }

    }

    public function decrementCurrentDay()
    {
        $video = $this->dailyVideos
            ->where('date','<', $this->currentday)
            ->last();

        if($video) {
            $this->video = $video;
            $this->currentday = $this->video->date;
        }
    }
    public function render()
    {
        return view('livewire.personal.daily-video-slider');
    }
}
