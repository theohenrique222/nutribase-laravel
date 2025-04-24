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
        Schema::create('personal_data', function (Blueprint $table) {
            $table->id();
            $table->integer('age');
            $table->float('height');
            $table->float('weight');
            $table->float('arm_l');
            $table->float('arm_r');
            $table->float('chest');
            $table->float('waist');
            $table->float('scruff');
            $table->float('thigh_l');
            $table->float('thigh_r');
            $table->float('calf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_data');
    }
};
