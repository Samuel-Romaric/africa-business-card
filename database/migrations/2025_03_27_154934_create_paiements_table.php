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
            
            $table->enum('type', ['souscription', 'vente']); // Subscriptions Or Sales
            $table->string('id_transaction');
            $table->string('method'); // OM, Wave, MTN, etc
            $table->string('amount'); // 10 000 XOF, etc
            $table->string('status'); // Effectue or Echoue
            $table->string('quantity'); // 1, 2, 3, etc
            $table->string('reseau'); // Transactional Marketing Network 
            $table->string('offer_validity'); // Validity of the offer
            $table->string('offer_price'); // Price of the offer
            $table->string('offer_quantity'); // Quantity of the offer
            $table->string('offer_type'); // Type of the offer (e.g., monthly, yearly)
            $table->string('card_used'); // Card used for the payment
            
            // $table->foreignId('author_id'); // Author
            $table->foreignId('business_id'); // Business
            $table->foreignId('user_id'); // User who made the payment
            $table->foreignId('offer_id'); // Offer associated with the payment
            $table->foreignId('subscription_id'); // Subscription associated with the payment
            $table->foreignId('sale_id'); // Sale associated with the payment
            
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
