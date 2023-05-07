<?php

use App\Traits\SharedEmploymentTypesTrait;
use App\Traits\SharedGendersTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use SharedGendersTrait,
        SharedEmploymentTypesTrait;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $verification_statuses = [
            config('constants.user.verification_statuses.waiting'),
            config('constants.user.verification_statuses.processing'),
            config('constants.user.verification_statuses.completed'),
        ];

        Schema::create('users', function (Blueprint $table) use ($verification_statuses) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid')->index();
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('second_name');
            $table->string('third_name');
            $table->enum('gender', [self::$GENDER_MALE, self::$GENDER_FEMALE]);
            $table->date('birthday');
            $table->enum('employment_type', [self::$INDIVIDUAL_ENTREPRENEUR, self::$SELF_EMPLOYED]);
            $table->string('email')->index();
            $table->string('password');
            $table->string('token');
            $table->string('phone');
            $table->string('invite_code')->index();
            $table->string('individual_code')->index();
            $table->string('promo_code')->index();
            $table->enum('verification_status', $verification_statuses)->index();
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
