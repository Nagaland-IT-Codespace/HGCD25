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
        Schema::create('reassignment_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained()->onDelete('cascade');
            $table->string('requester_emp_code');
            $table->string('requested_to_emp_code');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('requester_emp_code')->references('emp_code')->on('users')->onDelete('cascade');
            $table->foreign('requested_to_emp_code')->references('emp_code')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reassignment_requests');
    }
};
