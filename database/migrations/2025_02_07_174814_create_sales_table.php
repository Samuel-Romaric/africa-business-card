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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->string('code');
            $table->string('montant_recu');
            $table->string('prix');
            $table->string('quantite')->nullable();
            $table->string('nom_client');
            $table->string('prenom_client');
            $table->string('telephone_client');
            $table->string('total');
            
            $table->foreignId('offer_id')->constrained()->onDelete('cascade');
            $table->foreignId('business_id')->nullable()->constrained()->onDelete('cascade');
            // $table->foreignId('commercial_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('manager_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_id')->constrained()->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
