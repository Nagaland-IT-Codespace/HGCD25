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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_code');
            $table->string('full_name');
            $table->string('mobile')->nullable();
            $table->date('dob');
            $table->string('fathers_name');
            $table->string('gender');
            $table->string('office_name');
            $table->string('district');
            $table->string('designation');
            $table->string('tribe_name');
            $table->string('district_id')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
