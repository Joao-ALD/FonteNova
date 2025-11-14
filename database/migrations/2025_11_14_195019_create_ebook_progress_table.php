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
        Schema::create('ebook_progress', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('ebook_id')->constrained()->cascadeOnDelete();
    $table->unsignedInteger('pages_read')->default(0);
    $table->boolean('purchased')->default(false); // marca compra
    $table->timestamps();

    $table->unique(['user_id','ebook_id']);
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebook_progress');
    }
};
