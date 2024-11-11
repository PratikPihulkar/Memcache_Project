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
        Schema::create('movie', function (Blueprint $table) {
            $table->string('id', 10)->primary();                         // Primary key as VARCHAR(10)
            $table->string('title', 200)->nullable();                    // Title with VARCHAR(200) and nullable
            $table->integer('year')->nullable();                         // Year as integer and nullable
            $table->date('date_published')->nullable();                  // Date published as DATE type
            $table->integer('duration')->nullable();                     // Duration as integer and nullable
            $table->string('country', 250)->nullable();                  // Country with VARCHAR(250) and nullable
            $table->string('worlwide_gross_income', 30)->nullable();     // Worldwide gross income with VARCHAR(30)
            $table->string('languages', 200)->nullable();                // Languages with VARCHAR(200)
            $table->string('production_company', 200)->nullable();       // Production company with VARCHAR(200)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie');
    }
};
