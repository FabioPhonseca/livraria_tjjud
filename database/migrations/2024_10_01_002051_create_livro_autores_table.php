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
        Schema::create('livro_autores', function (Blueprint $table) {
            $table->integer('livro_codl');
            $table->integer('autor_codau');

            $table->foreign('livro_codl')->references('codl')->on('livros')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('autor_codau')->references('codau')->on('autores')->onUpdate('cascade');

            $table->primary(['livro_codl', 'autor_codau']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livro_autores');
    }
};
