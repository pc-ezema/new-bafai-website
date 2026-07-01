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
        Schema::create('sponsorship_applications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['sponsor', 'student']); // sponsor = organisation, student = individual
            $table->string('name');   // Full name or organisation name
            $table->string('email');
            $table->string('phone');
            $table->integer('student_count')->nullable(); // only for sponsor type
            $table->text('essay')->nullable();            // only for student type
            $table->boolean('consent')->default(true);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsorship_applications');
    }
};
