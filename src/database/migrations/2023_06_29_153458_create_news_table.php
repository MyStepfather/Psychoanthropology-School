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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id')->comment('Автор статьи user_id')->nullable();
            $table->unsignedBigInteger('editor_id')->comment('Кто последний изменил user_id')->nullable();
            $table->string('title')->comment('Заголовок статьи');
            $table->text('description')->comment('Анонс')->nullable();
            $table->text('text')->comment('Текст')->nullable();
            $table->string('image_url')->comment('Картинка к новости')->nullable();
            $table->string('video_url')->comment('Видео к новости')->nullable();
            $table->boolean('is_video_show')->comment('Показывать на главной странице?')->default(false);
            $table->datetime('published_at')->comment('Дата публикации, если null, то не опубликована')->nullable();
            $table->boolean('is_show')->comment('Показывать на главной странице?')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
