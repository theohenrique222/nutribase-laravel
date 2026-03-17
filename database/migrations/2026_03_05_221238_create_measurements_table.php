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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete(); // vincula ao aluno
            $table->string('description')->nullable();
            $table->float('height');
            $table->float('weight');
            $table->float('arm_l')->nullable();
            $table->float('arm_r')->nullable();
            $table->float('chest')->nullable();
            $table->float('waist');
            $table->float('scruff');
            $table->float('hip'); // adicionado para cálculo de gordura
            $table->float('thigh_l')->nullable();
            $table->float('thigh_r')->nullable();
            $table->float('calf_l')->nullable();
            $table->float('calf_r')->nullable();

// campos calculados
            $table->float('tmb')->nullable();
            $table->float('water')->nullable();
            $table->float('proteins')->nullable();
            $table->float('carbs')->nullable();
            $table->float('fat_percent')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
