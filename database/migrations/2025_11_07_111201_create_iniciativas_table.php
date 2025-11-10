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
        Schema::create('iniciativas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_id')->constrained('estados')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descricao');
            $table->enum('tipo', ['água', 'ecologia', 'saneamento', 'energia', 'conservação']);
            $table->enum('status', ['em_andamento', 'concluído', 'planejado']);
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->string('impacto_estimado')->nullable();
            $table->decimal('investimento', 15, 2)->nullable();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->json('imagens')->nullable();
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
        Schema::dropIfExists('iniciativas');
    }
};
