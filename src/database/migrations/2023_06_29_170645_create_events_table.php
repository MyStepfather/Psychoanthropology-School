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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_type_id')
                ->comment('ID типа события( например Дни ПА, Стаж');
            $table->string('title')->comment('Заголовок')->nullable();
            $table->text('text')->comment('Текст')->nullable();
            $table->dateTime('date_start')->comment('Дата начала');
            $table->dateTime('date_end')->comment('Дата окончания');
            $table->boolean('is_show')->comment('Показывать на главной странице?')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
