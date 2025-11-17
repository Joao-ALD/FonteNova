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
    Schema::create('ebooks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('summary')->nullable();  // descrição curta
        $table->boolean('is_paid')->default(false); // ebook pago?
        $table->unsignedInteger('free_preview_pages')->default(2); // libera 2 páginas grátis
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('ebooks');
}

};
