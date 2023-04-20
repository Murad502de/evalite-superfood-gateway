<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid')->index();
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('second_name');
            $table->string('third_name');
            $table->enum('gender', ['male', 'female']);
            $table->date('birthday');
            $table->string('email')->index();
            $table->string('password');
            $table->string('token');
            $table->string('phone');
            $table->string('invite_code')->index();
            $table->string('individual_code')->index();
            $table->string('promo_code')->index();
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
