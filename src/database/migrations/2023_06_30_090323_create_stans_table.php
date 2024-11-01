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
        Schema::create('stans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('media_id')->comment('Связь с таблицой Media');
            $table->integer('number')->comment('Номер станса от 0')->nullable();
            $table->boolean('is_active')->comment('Активный станс')->default(false);
            $table->dateTime('date_start')->comment('Дата начала недели действия станста')->nullable();
            $table->dateTime('date_end')->comment('Дата окончания недели действия станста')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stans');
    }
};
