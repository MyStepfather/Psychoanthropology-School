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
        Schema::create('media_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('media_id')->comment('ID станса');
            $table->unsignedBigInteger('language_id')->comment('ID языка')->nullable();
            $table->unsignedBigInteger('artist_id')->comment('ID исполнителя')->nullable();
            $table->string('url')->comment('Путь к файлу');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_resources');
    }
};
