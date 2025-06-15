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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('address');
            $table->date('hire_date');
            $table->string('department');
            $table->string('dob');
            $table->longText('education');
            $table->string('image_path')->nullable();
            
            /* $table->foreignId('department_id')->constrained('departments')->onDelete('cascade'); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
