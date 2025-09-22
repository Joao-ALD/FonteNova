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
        Schema::create('topicos', function (Blueprint $table) {
            $table->id(); // ID automático
            $table->string('titulo'); // Ex: "Reutilização de água da chuva"
            $table->text('palavras_chave'); // Ex: "chuva,reutilizar,conta,armazenar"
            $table->text('resumo'); // Resposta curta do chatbot
            $table->string('link_site'); 
            $table->string('link_premium')->nullable(); // Opcional
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topicos');
    }
};
