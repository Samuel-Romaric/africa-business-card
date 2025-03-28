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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            $table->string('titre');
            $table->string('slug');
            $table->enum('type', ['produit', 'service']);
            $table->integer('quantite')->nullable();
            $table->string('price');
            // $table->enum('status', ['valide', 'en_attente', 'retirer']);
            $table->text('description')->nullable();

            $table->boolean('validated')->default(0);
            $table->date('validated_at')->nullable();
            $table->foreignId('validated_by')->nullable()->constrained()->on('users')->onDelete('cascade');

            $table->foreignId('business_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->constrained()->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
