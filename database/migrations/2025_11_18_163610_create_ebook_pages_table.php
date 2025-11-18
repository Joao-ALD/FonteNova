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
    Schema::create('ebook_pages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('ebook_id')->constrained()->onDelete('cascade'); // Liga ao Ebook
        $table->integer('page_number'); // Número da página (1 a 6)
        $table->text('content'); // O texto/HTML da página
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
        Schema::dropIfExists('ebook_pages');
    }
};
