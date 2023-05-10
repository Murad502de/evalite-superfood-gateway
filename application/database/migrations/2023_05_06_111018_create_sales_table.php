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
            config('constants.sales.statuses.waiting'),
            config('constants.sales.statuses.processing'),
            config('constants.sales.statuses.closed'),
        ];

        Schema::create('sales', function (Blueprint $table) use ($statuses) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid')->index();
            $table->enum('status', $statuses)->index()->default(config('constants.sales.statuses.waiting')); //FIXME set default value
            $table->string('percent')->index();
            $table->foreignId('lead_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('payout_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
