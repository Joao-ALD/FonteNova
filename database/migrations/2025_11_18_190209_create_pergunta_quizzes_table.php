<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pergunta_quiz', function (Blueprint $table) {
            $table->id();
            $table->text('pergunta'); // Texto da pergunta
            $table->string('opcao_a'); // Opção A
            $table->string('opcao_b'); // Opção B
            $table->string('opcao_c'); // Opção C
            $table->enum('resposta_correta', ['a', 'b', 'c']); // Qual é a correta
            $table->integer('litros_economizados'); // O valor 'liters'
            $table->integer('ordem')->default(0); // Para ordenar as perguntas
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pergunta_quizzes');
    }
};
