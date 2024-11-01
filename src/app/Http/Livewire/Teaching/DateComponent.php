<?php

namespace App\Http\Livewire\Teaching;

use App\Models\Exercise;
use Carbon\Carbon;
use Livewire\Component;

class DateComponent extends Component
{
    public $date;
    public $currentSlideDate;

    public $dateDate;
    public $dateText;
    public $daysInMonth;
    public $chosenMonth;
    public $chosenYear;


    //отвечает за отображение календаря
    public $isShown;

    public function mount(): void
    {
        //генерация календаря
        $this->generateCalendar(Carbon::now());
        //получение ближайшего упражнения
        $this->getTodayTask();
    }

    public function getTodayTask(): void
    {
        $today = Carbon::now();
        $this->currentSlideDate = $today;
        $task = Exercise::query()
            ->where('type', 1)
            ->where('date', '<=', $today)->select('date', 'text')
            ->get()
            ->sortBy('date')
            ->map(function ($item) {
                $dateToFix = Carbon::parse($item->date)->locale('ru')->isoFormat('D MMMM Y ');
                $item->date = $dateToFix;
                return $item;
            })
            ->last();
        $this->date = $task;
        $this->dateDate = $this->date->date ?? null;
        $this->dateText = $this->date->text ?? null;
    }


    public function previousMonth():void
    {
        $date=Carbon::parse("$this->chosenYear-$this->chosenMonth")->subMonth();
        $this->generateCalendar($date);
    }
    public function nextMonth():void
    {
        $date=Carbon::create($this->chosenYear,$this->chosenMonth)->addMonth();
        $this->generateCalendar($date);
    }

    public function generateCalendar($date)
    {
        $year = $date->year;
        $month = $date->month;
        $this->chosenMonth=$date->month;
        $this->chosenYear=$date->year;
        $firstDayOfMonth = Carbon::create($year, $month, 1);
        $daysToAdd = ($firstDayOfMonth->dayOfWeek - Carbon::MONDAY + 7) % 7;
        $daysToEndOfWeek = 7 - ($firstDayOfMonth->copy()->addDays($daysToAdd)->dayOfWeek + 1) % 7;
        $firstDayToInclude = $firstDayOfMonth->copy()->subDays($daysToAdd);
        $daysInMonth = [];
        $exercisesInThisMonth = Exercise::query()
            ->where('type', 1)
            ->where('date', '>=', Carbon::create($year, $month))
            ->where('date', '<=', Carbon::create($year, $month)->endOfMonth())
            ->select('date', 'text')
            ->get()
            ->map(function ($item) {
                $item->date = Carbon::parse($item->date)->day;
                return $item;
            });
        for ($day = 0; $day < $firstDayOfMonth->daysInMonth + $daysToAdd + $daysToEndOfWeek; $day++) {
            $currentDay = $firstDayToInclude->copy()->addDays($day);

            if ($day < $daysToAdd) {
                $monthType = 'previous';
            } elseif ($day < $firstDayOfMonth->daysInMonth + $daysToAdd) {
                $monthType = 'current';
            } else {
                $monthType = 'next';
            }
            $hasExercise = $exercisesInThisMonth
                    ->filter(fn ($item) => $item->date == $currentDay->day)
                    ->count() != 0;
            $daysInMonth[] = [
                'day' => $currentDay->day,
                'month' => $month,
                'year' => $year,
                'monthType' => $monthType,
                'hasExercise' => $hasExercise
            ];
        }
        $this->daysInMonth = $daysInMonth;
    }

    public function increment(): void
    {
        $this->toggleExercise("increment");
    }

    public function decrement(): void
    {
        $this->toggleExercise('decrement');
    }

    public function chooseDay($item)
    {
        extract($item);
        $currentDate = Carbon::create($year, $month, $day);
        $chosenExercise = Exercise::query()
            ->where('type', 1)
            ->where('date', $currentDate)
            ->select('text', 'date')
            ->get()
            ->map(function ($item) {
                $dateToFix = Carbon::parse($item->date)->locale('ru')->isoFormat('D MMMM Y ');
                $item->date = $dateToFix;
                return $item;
            })
            ->first();
        if ($chosenExercise) {
            $this->dateDate = $chosenExercise->date;
            $this->dateText = $chosenExercise->text;
            $this->isShown=false;
        }
    }
    public function calendarToggle():void
    {
        $this->isShown=!$this->isShown;
    }
    public function toggleExercise($actionType): void
    {
        $task=null;
        switch ($actionType) {
            case "increment":
                $this->currentSlideDate->addDay();
                $task = Exercise::query()
                    ->where('type', 1)
                    ->where('date', '<=', $this->currentSlideDate)
                    ->select('date', 'text')
                    ->get()
                    ->sortBy('date')
                    ->map(function ($item) {
                        $dateToFix = Carbon::parse($item->date)->locale('ru')->isoFormat('D MMMM Y ');
                        $item->date = $dateToFix;
                        return $item;
                    })->last();

                break;
            case "decrement":
                $this->currentSlideDate = $this->currentSlideDate->subDay();
                $task = Exercise::query()
                    ->where('type', 1)
                    ->where('date', '<', $this->currentSlideDate)
                    ->select('date', 'text')
                    ->get()
                    ->sortBy('date')
                    ->map(function ($item) {
                        $dateToFix = Carbon::parse($item->date)->locale('ru')->isoFormat('D MMMM Y ');
                        $item->date = $dateToFix;
                        return $item;
                    })
                    ->last();
                break;
        }
        if ($task !== null) {
            $this->date = $task;
            $this->dateDate = $this->date->date;
            $this->dateText = $this->date->text;
        }
    }

    public function render()
    {
        return view('livewire.teaching.date-component');
    }
}
