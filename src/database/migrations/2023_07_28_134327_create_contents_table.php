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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('Вид контента из const');
            $table->unsignedInteger('number')->comment('Номер документа')->nullable();
            $table->dateTime('date')->comment('Дата')->nullable();
            $table->string('name')->comment('Название')->nullable();
            $table->string('description')->comment('Описание')->nullable();
            $table->string('url')->comment('Ссылка на документ')->nullable();
            $table->text('text')->comment('Текст/html')->nullable();
            $table->boolean('is_publish')->comment('Опубликована?')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
