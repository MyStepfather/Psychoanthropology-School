<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Группы
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('Тип группы work, read, new');
            $table->unsignedBigInteger('coordinator_user_id')->comment('ID user - координатор')->nullable();
            $table->unsignedBigInteger('country_id')->comment('ID страны')->nullable();
            $table->unsignedBigInteger('town_id')->comment('Город (NULL для дистанционных групп)')->nullable();
            $table->unsignedInteger('weekday')->comment('День проведения группы')->nullable();
            $table->time('time')->comment('Время проведени группы')->nullable();
            $table->string('place')->comment('Место проведения группы')->nullable();
            $table->boolean('is_online')->default(false)->comment('Дистанционная?');
            $table->boolean('is_active')->default(true)->comment('Активна?');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
