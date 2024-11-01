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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')
                ->comment('0-актуальные, 1-ежедневные')
                ->default(0)
                ->unsigned()
                ->check('type IN (0, 1)');
            $table->string('title')->comment('Название')->nullable();
            $table->string('month')->comment('Месяц, в котором дано упражнение')->nullable();
            $table->datetime('date')->comment('Дата упражнения')->nullable();
            $table->text('text')->comment('Текст');
            $table->datetime('published_at')->comment('Дата публикации, если null, то не опубликована')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
