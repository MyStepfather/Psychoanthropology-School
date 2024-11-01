<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название');
            $table->string('category')->comment('Категория из const')->nullable();
            $table->string('code')->comment('Код из const')->nullable();
            $table->text('description')->comment('Описание')->nullable();
            $table->string('year')->comment('Год')->nullable();
            $table->decimal('price', 19, 4)->comment('Цена');
            $table->string('cover')->comment('Обложка')->nullable();
            $table->unsignedBigInteger('artist_id')->comment('ID автора')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
