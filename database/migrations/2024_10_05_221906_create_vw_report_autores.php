<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW vw_report_autores AS
			SELECT
				DISTINCT
				aut.nome
				, liv.titulo
				, liv.editora
				, liv.edicao
				, liv.ano_publicacao
				, CONCAT('R$ ', FORMAT(liv.valor, 2, 'de_DE')) AS valor
				, liv.isbn
				, coalesce(ass.descricao, ' ') AS assunto
			FROM 
				autores AS aut
				LEFT JOIN livro_autores AS liv_aut ON
					aut.codau = liv_aut.autor_codau
				LEFT JOIN livros AS liv ON
					liv_aut.livro_codl = liv.codl
				LEFT JOIN livro_assuntos AS liv_ass ON
					liv.codl = liv_ass.livro_codl
				LEFT JOIN assuntos ass ON
					liv_ass.livro_codl = ass.codas
			ORDER BY
				aut.nome, liv.titulo, liv.valor;
        ");
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS livros_view;");
    }
};
