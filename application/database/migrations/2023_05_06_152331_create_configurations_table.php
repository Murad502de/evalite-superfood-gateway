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
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid')->index();
            $table->string('amocrm_subdomain');
            $table->string('amocrm_redirect_uri');
            $table->string('amocrm_client_secret');
            $table->unsignedInteger('amocrm_utm_source_id');
            $table->unsignedBigInteger('min_payout');
            $table->string('personal_link_host');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
