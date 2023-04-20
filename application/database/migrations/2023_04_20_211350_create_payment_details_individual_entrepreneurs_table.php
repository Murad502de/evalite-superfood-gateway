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
        Schema::create('payment_details_individual_entrepreneurs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid')->index();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('organization_legal_address');
            $table->string('inn');
            $table->string('ogrn');
            $table->string('transaction_account');
            $table->string('bank');
            $table->string('bank_inn');
            $table->string('bank_bic');
            $table->string('bank_correspondent_account');
            $table->string('bank_legal_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details_individual_entrepreneurs');
    }
};
