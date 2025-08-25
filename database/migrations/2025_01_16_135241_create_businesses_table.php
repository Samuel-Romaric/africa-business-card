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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('nom_commercial');
            $table->string('slug');
            $table->enum('reseau', ['Marketing Transactionnel', 'Marketing Relationnel'])->nullable(); // Ajout du champ 'reseau' Marketing Transactionnel ou Marketing Relationnel
            $table->string('forme_juridique');
            $table->string('num_rccm');
            $table->string('capital')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_blocked')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
