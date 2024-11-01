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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->comment('ID группы')->nullable();
            $table->string('login')->unique()->comment('Логин')->nullable();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->string('name_first')->comment('Имя')->nullable();
            $table->string('name_last')->comment('фамилия')->nullable();
            $table->string('name_middle')->comment('Отчество')->nullable();
            $table->string('full_name')->virtualAs('concat(name_last, \' \', name_first)');
            $table->string('avatar')->comment('Аватар(ссылка на картинку)')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('telegram')->comment('Аккаунт в Телеграм')->nullable();
            $table->json('social')->comment('Аккаунты в соцсетях')->nullable();
            $table->boolean('is_active')->default(false)->comment('Активный пользователь?')->nullable();
            $table->boolean('is_public')->default(false)->comment('Данные видны другим пользователям')->nullable();
            $table->date('entered_at')->comment('Дата поступления в школу')->nullable();
            $table->date('birthdate')->comment('Дата рождения')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
