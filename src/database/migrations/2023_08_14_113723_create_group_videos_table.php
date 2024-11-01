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
        Schema::create('group_videos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->comment('Дата видео')->nullable();
            $table->string('name')->comment('Название видео')->nullable();
            $table->unsignedInteger('duration')->comment('Продолжительность в минутах')->nullable();
            $table->string('code')->comment('Код видео')->nullable();
            $table->string('password')->comment('Пароль видео')->nullable();
            $table->string('url')->comment('Ссылка')->nullable();
            $table->dateTime('date_start')->comment('Дата начала действия ')->nullable();
            $table->dateTime('date_end')->comment('Дата окончания недели')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_videos');
    }
};
