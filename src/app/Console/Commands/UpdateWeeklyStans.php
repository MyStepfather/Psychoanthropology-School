<?php

namespace App\Console\Commands;

use App\Models\Stans;
use Illuminate\Console\Command;

class UpdateWeeklyStans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-weekly-stans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update stans every week';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $currentActiveStans = Stans::where('is_active', true)->first();
        $nextActiveStans = Stans::where('is_active', false)->where('id', '>', $currentActiveStans->id)->first();

        if (!$nextActiveStans) {
            $nextActiveStans = Stans::where('is_active', false)->first();
        }

        if ($currentActiveStans && $nextActiveStans) {
            $currentActiveStans->is_active = false;
            $currentActiveStans->save();

            $nextActiveStans->is_active = true;
            $nextActiveStans->save();
        }
    }
}
