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
        Schema::create('souscriptions', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_offre');
            $table->enum('reseau', ['Marketing Transactionnel', 'Marketing Relationnel'])->nullable(); // Ajout du champ 'reseau' Marketing Transactionnel ou Marketing Relationnel
            $table->string('montant'); // 10 000 XOF, etc
            $table->string('quantite')->nullable(); // 1, 2, 3, etc
            $table->string('mode_paiement'); // OM, Wave, MTN, etc
            $table->string('status'); // Effectue or Echoue or En attente
            $table->string('id_transaction')->nullable(); // Transaction ID from payment gateway

            $table->foreignId('business_id')->constrained()->onDelete('cascade');
            $table->foreignId('offer_id')->constrained()->onDelete('cascade');
            $table->foreignId('card_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('souscriptions');
    }
};
