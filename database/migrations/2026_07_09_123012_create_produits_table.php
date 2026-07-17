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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('code'); // unique par entreprise
            $table->string('reference')->unique();
            $table->string('nom');
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->decimal('prix_achat', 12, 2)->default(0);
            $table->decimal('prix_vente', 12, 2);
            $table->integer('stock')->default(100);
            $table->integer('stock_min')->default(10);
            $table->foreignId('fournisseur_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('categorie_id')->nullable()->constrained()->onDelete('cascade');
            $table->boolean('statut')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
