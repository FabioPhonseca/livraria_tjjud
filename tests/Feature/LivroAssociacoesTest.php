<?php

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('pode associar um livro a um autor', function () {
    $autor = Autor::create(['nome' => 'Autor Teste']);
    $livroData = [
        'titulo' => 'Livro de Teste',
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'ano_publicacao' => '2024',
        'valor' => 'R$ 59,90',
        'isbn' => '9781234567890',
    ];

    $livro = Livro::create($livroData);
    $livro->autores()->attach($autor->codau);

    $this->assertCount(1, $livro->autores);
    $this->assertEquals('Autor Teste', $livro->autores->first()->nome);
});

it('pode associar um livro a um assunto', function () {
    $assunto = Assunto::create(['descricao' => 'Assunto Teste']);
    $livroData = [
        'titulo' => 'Livro de Teste',
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'ano_publicacao' => '2024',
        'valor' => 'R$ 59,90',
        'isbn' => '9781234567890',
    ];

    $livro = Livro::create($livroData);
    $livro->assuntos()->attach($assunto->codas);

    $this->assertCount(1, $livro->assuntos);
    $this->assertEquals('Assunto Teste', $livro->assuntos->first()->descricao);
});
