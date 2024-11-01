<?php

namespace App\Http\Livewire\Personal;

use App\Actions\Page\Personal\GetDailyVideoAction;
use App\Actions\Subscribes\GetSubscribesAction;
use App\Constants\SubscribesTypes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DailyVideo extends Component
{
    public $user;

    public $allSubscribes;

    public $uniqueYearsMonths = [];

    public $activeSubscribe;

    public $dailyVideo;

    public $selectedYear;

    public $selectedMonth;

    public function mount(GetDailyVideoAction $getDailyVideo, GetSubscribesAction $getSubscribe)
    {
        $this->user = Auth::user();

        // Получаем все подписки для табов
        $this->allSubscribes = $getSubscribe
            ->handle($this->user, [
                SubscribesTypes::VIDEO,
                SubscribesTypes::ZOOM,
            ], 'all');

        // Собираем уникальные годы и месяцы в массиве только из записей с подписками
        foreach ($this->allSubscribes as $subscribe) {
            $date = Carbon::parse($subscribe->pivot->date_start);
            $year = $date->year;
            $month = $date->month;

            if (! isset($this->uniqueYearsMonths[$year])) {
                $this->uniqueYearsMonths[$year] = [];
            }

            if (! in_array($month, $this->uniqueYearsMonths[$year])) {
                $this->uniqueYearsMonths[$year][] = $month;
            }
        }

        //Устанавливаем текущий выбор табов
        $this->selectedYear = date('Y');
        $this->selectedMonth = date('n');



        //Получаем подписку на текущий месяц
        $this->activeSubscribe = $getSubscribe
            ->handle($this->user, [
                SubscribesTypes::VIDEO,
                SubscribesTypes::ZOOM,
            ], 'active');

        $this->dailyVideo = $getDailyVideo->handle($this->user, $this->activeSubscribe);

    }

    public function updateSelectedYear($year)
    {
        $this->selectedYear = $year;
        //TODO  добавить видео update
    }

    public function updateSelectedMonth($month)
    {
        $this->selectedMonth = $month;

        $this->updateVideo();

    }

    public function updateVideo()
    {
        $getSubscribe = new getSubscribesAction();
        $selectSubscribe = $getSubscribe
            ->handle($this->user, [
                SubscribesTypes::VIDEO,
                SubscribesTypes::ZOOM,
            ],
                [
                    'year' => $this->selectedYear,
                    'month' => $this->selectedMonth,
                ]);

        $getDailyVideo = new getDailyVideoAction();
        $this->dailyVideo = $getDailyVideo->handle($this->user, $selectSubscribe);
    }

    public function render()
    {
        //сортируем года и месяцы в порядке возрастания
        ksort($this->uniqueYearsMonths);
        foreach ($this->uniqueYearsMonths as &$months) {
            sort($months);
        }

        return view('livewire.personal.daily-video', [
            'periods' => $this->uniqueYearsMonths,
            'videos' => $this->dailyVideo,
            'selectedYear' => $this->selectedYear,
            'selectedMonth' => $this->selectedMonth,
        ]);
    }
}
