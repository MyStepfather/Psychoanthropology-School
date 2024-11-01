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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('number')->comment('Номер курса');
            $table->string('name')->comment('Название курса');
            $table->text('text')->comment('Содержание курса');
            $table->dateTime('date_start')->comment('Дата начала недели действия курса')->nullable();
            $table->dateTime('date_end')->comment('Дата окончания недели действия курса')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
