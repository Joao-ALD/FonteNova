<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topicos', function (Blueprint $table) {
            $table->id(); // equivale a id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('nome'); // exemplo: "Reutilização de água da chuva"
            $table->text('palavras_chave'); // "chuva,reutilizar,conta,armazenar"
            $table->text('resumo'); // resposta curta do chatbot
            $table->string('link_site');
            $table->string('link_premium')->nullable(); // pode ser nulo
            $table->timestamps(); // cria created_at e updated_at
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topicos');
    }
};
