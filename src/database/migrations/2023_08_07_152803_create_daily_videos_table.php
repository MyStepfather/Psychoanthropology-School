<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_videos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->comment('Дата видео');
            $table->string('name')->comment('Название видео');
            $table->string('url')->comment('Ссылка на видео');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_videos');
    }
};
