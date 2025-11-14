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
        Schema::create('ebook_pages', function (Blueprint $table) {
    $table->id();
    $table->foreignId('ebook_id')->constrained()->cascadeOnDelete();
    $table->unsignedInteger('page_number'); // 1,2,3...
    $table->text('content'); // HTML/Markdown do conteúdo da página
    $table->timestamps();
    $table->unique(['ebook_id','page_number']);
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebook_pages');
    }
};
