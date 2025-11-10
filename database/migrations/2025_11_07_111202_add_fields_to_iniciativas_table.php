<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('iniciativas', function (Blueprint $table) {
            if (!Schema::hasColumn('iniciativas', 'tipo')) {
                $table->enum('tipo', ['água', 'ecologia', 'saneamento', 'energia', 'conservação'])->nullable()->after('descricao');
            }
            if (!Schema::hasColumn('iniciativas', 'status')) {
                $table->enum('status', ['em_andamento', 'concluído', 'planejado'])->nullable()->after('tipo');
            }
            if (!Schema::hasColumn('iniciativas', 'data_inicio')) {
                $table->date('data_inicio')->nullable();
            }
            if (!Schema::hasColumn('iniciativas', 'data_fim')) {
                $table->date('data_fim')->nullable();
            }
            if (!Schema::hasColumn('iniciativas', 'impacto_estimado')) {
                $table->string('impacto_estimado')->nullable();
            }
            if (!Schema::hasColumn('iniciativas', 'investimento')) {
                $table->decimal('investimento', 15, 2)->nullable();
            }
            if (!Schema::hasColumn('iniciativas', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable();
            }
            if (!Schema::hasColumn('iniciativas', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable();
            }
            if (!Schema::hasColumn('iniciativas', 'imagens')) {
                $table->json('imagens')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('iniciativas', function (Blueprint $table) {
            $table->dropColumn([
                'tipo',
                'status',
                'data_inicio',
                'data_fim',
                'impacto_estimado',
                'investimento',
                'latitude',
                'longitude',
                'imagens'
            ]);
        });
    }
};