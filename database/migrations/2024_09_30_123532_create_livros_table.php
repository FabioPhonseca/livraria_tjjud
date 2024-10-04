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
        Schema::create('livros', function (Blueprint $table) {
            $table->integer('codl')->autoIncrement();
            $table->string('titulo', 40)->default('');
            $table->string('editora', 40)->default('');
            $table->integer('edicao')->default(0);
            $table->string('ano_publicacao', 4)->default('0');
            $table->decimal('valor', 10, 2)->default(0.00);
            $table->string('isbn', 13)->nullable()->unique();
			$table->string('imagem_capa')->nullable()->after('isbn');			
            $table->timestamps();
            $table->unique(['titulo', 'editora', 'edicao', 'ano_publicacao'], 'titulo_editora_edicao_ano_publicacao');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
