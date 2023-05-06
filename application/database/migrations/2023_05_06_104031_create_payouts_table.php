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
        $statuses = [
            config('constants.payouts.statuses.processing'),
            config('constants.payouts.statuses.completed'),
        ];

        Schema::create('payouts', function (Blueprint $table) use ($statuses) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid')->index();
            $table->enum('status', $statuses)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};