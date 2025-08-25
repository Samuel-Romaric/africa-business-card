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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('firstname');
            $table->string('slug');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->enum('reseau', ['Marketing Transactionnel', 'Marketing Relationnel'])->nullable(); // Ajout du champ 'reseau' Marketing Transactionnel ou Marketing Relationnel

            $table->enum('role', ['admin', 'manager', 'commercial', 'business'])->nullable();
            $table->boolean('is_global_admin')->default(0);
            $table->string('num_cni')->nullable();
            $table->date('date_naissance')->nullable();
            $table->integer('age')->nullable();
            $table->string('code')->unique()->nullable();
            $table->string('telephone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('diplome')->nullable();
            $table->string('pays')->nullable();
            $table->string('departement')->nullable();
            $table->string('ville')->nullable();
            $table->string('commune')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_blocked')->default(0); // user status

            $table->foreignId('manager_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('commercial_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('business_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('activity_sector_id')->nullable()->constrained()->onDelete('cascade');

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
