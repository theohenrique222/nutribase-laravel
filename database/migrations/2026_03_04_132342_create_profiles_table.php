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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->float('height');
            $table->float('weight');
            $table->float('arm_l')->nullable();
            $table->float('arm_r')->nullable();
            $table->float('chest')->nullable();
            $table->float('waist');
            $table->float('scruff');
            $table->float('thigh_l')->nullable();
            $table->float('thigh_r')->nullable();
            $table->float('calf_l')->nullable();
            $table->float('calf_r')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
