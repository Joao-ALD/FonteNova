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
public function up(): void
{
    Schema::create('aulas', function (Blueprint $table) {
        $table->id();
        $table->string('titulo'); // Para o título da aula
        $table->text('descricao_html'); // Para o texto (usamos 'text' para caber muito conteúdo)
        $table->string('video_embed_url'); // Para o link "embed" do YouTube/Vimeo
        $table->integer('ordem'); // IMPORTANTE: Para saber quem vem antes/depois
        $table->timestamps(); // Cria created_at e updated_at
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aulas');
    }
};
