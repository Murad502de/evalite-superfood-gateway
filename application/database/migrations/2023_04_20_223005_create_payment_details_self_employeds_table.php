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
        Schema::create('payment_details_self_employeds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid')->index();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('transaction_account');
            $table->string('inn');
            $table->string('swift');
            $table->string('mailing_address');
            $table->string('bank');
            $table->string('bic');
            $table->string('correspondent_account');
            $table->string('bank_inn');
            $table->string('bank_kpp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details_self_employeds');
    }
};
