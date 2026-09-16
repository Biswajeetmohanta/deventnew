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
        Schema::create('calculator_project_types', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->decimal('min_price', 10, 2);
            $table->decimal('max_price', 10, 2);
            $table->string('icon')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('calculator_complexities', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->float('multiplier');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('calculator_features', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->decimal('min_price', 10, 2);
            $table->decimal('max_price', 10, 2);
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('calculator_screens', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->float('multiplier');
            $table->timestamps();
        });

        Schema::create('calculator_timelines', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->string('duration');
            $table->float('multiplier');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculator_timelines');
        Schema::dropIfExists('calculator_screens');
        Schema::dropIfExists('calculator_features');
        Schema::dropIfExists('calculator_complexities');
        Schema::dropIfExists('calculator_project_types');
    }
};
