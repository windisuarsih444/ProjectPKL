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
        Schema::create('teacher', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->enum('gender', ['L', 'P']);
             $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('teacher');
    }
};
