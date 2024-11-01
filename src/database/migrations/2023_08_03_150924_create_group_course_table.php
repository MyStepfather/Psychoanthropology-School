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
        Schema::create('group_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->comment('ID группы');
            $table->unsignedBigInteger('course_id')->comment('ID курса');
            $table->unsignedBigInteger('user_id')->comment(' Id user, кто добавил запись')->nullable();
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
        Schema::dropIfExists('group_course');
    }
};
