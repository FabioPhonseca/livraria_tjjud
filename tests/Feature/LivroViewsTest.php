<?php
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a página de listagem de livros está acessível e exibe livros corretamente', function () {
    Livro::factory()->create(['titulo' => 'Livro Teste 1', 'editora' => 'Editora 1']);
    Livro::factory()->create(['titulo' => 'Livro Teste 2', 'editora' => 'Editora 2']);

    $response = $this->get(route('livros.index'));

    $response->assertStatus(200);

    $response->assertSee('Livros');

    $response->assertSee('Livro Teste 1');
    $response->assertSee('Livro Teste 2');

     $response->assertSee('Editora 1');
    $response->assertSee('Editora 2');

    $response->assertSee('Adicionar Livro');

    $response->assertSee('Visualizar');
    $response->assertSee('Editar');
    $response->assertSee('Excluir');
});

test('a página de edição de livro está acessível e exibe os dados corretos', function () {
    $livro = Livro::factory()->create([
        'titulo' => 'Livro de Teste',
        'editora' => 'Editora de Teste',
        'edicao' => 2,
        'ano_publicacao' => 2023,
        'valor' => 'R$ 29,90',
        'isbn' => '1234567890123',
    ]);

    $autor1 = Autor::factory()->create(['nome' => 'Autor 1']);
    $autor2 = Autor::factory()->create(['nome' => 'Autor 2']);
    $livro->autores()->attach([$autor1->codau, $autor2->codau]);

    $assunto1 = Assunto::factory()->create(['descricao' => 'Assunto 1']);
    $assunto2 = Assunto::factory()->create(['descricao' => 'Assunto 2']);
    $livro->assuntos()->attach([$assunto1->codas, $assunto2->codas]);

    $response = $this->get(route('livros.edit', $livro));

    $response->assertStatus(200);

    $response->assertSee('Livro de Teste');
    $response->assertSee('Editora de Teste');
    $response->assertSee('2');
    $response->assertSee('2023');
    $response->assertSee('R$ 29,90');
    $response->assertSee('1234567890123');

    $response->assertSee('Autor 1');
    $response->assertSee('Autor 2');
    $response->assertSee('Assunto 1');
    $response->assertSee('Assunto 2');

    $response->assertSee('Atualizar');
});
