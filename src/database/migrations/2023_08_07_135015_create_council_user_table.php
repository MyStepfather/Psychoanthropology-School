<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Члены совета
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('council_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('council_id')->comment('Id совета');
            $table->unsignedBigInteger('user_id')->comment('Id пользователя');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('council_user');
    }
};
