<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Ответственные за заказ книг
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_managers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Id user, ответсвенного за заказ книг');
            $table->string('name')->comment('Название региона/города')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_managers');
    }
};
