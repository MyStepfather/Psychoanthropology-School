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
        Schema::create('form_to_schools', function (Blueprint $table) {
            $table->id();
            $table->json('topic')->comment('Тема  JSON');
            $table->json('articles')->comment('url статьи  JSON');
            $table->json('recipient')->comment('кому  JSON');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_to_schools');
    }
};
