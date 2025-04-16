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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            
            // $table->string('type'); // Subscriptions Or Sales
            $table->enum('type', ['souscription', 'vente']); // Subscriptions Or Sales
            $table->string('id_transaction');
            $table->string('method'); // OM, Wave, MTN, etc
            $table->string('amount'); // 10 000 XOF, etc
            $table->string('status'); // Effectue or Echoue
            
            $table->foreignId('author_id'); // Author
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
