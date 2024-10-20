<?php
use App\Models\Autor;
use App\Models\Livro;
use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('a página de relatório de autores está acessível', function () {
    $response = $this->get(route('relatorio.autores'));

    $response->assertStatus(200);

    $response->assertSee('Relatório de Autores');
    $response->assertSee('Quantidade de livros por autor');
    $response->assertSee('Resumo de livros por autor');
    $response->assertSee('Autor');
    $response->assertSee('Título');
    $response->assertSee('Editora');
    $response->assertSee('Edição');
    $response->assertSee('Ano Publicação');
    $response->assertSee('Valor');
    $response->assertSee('ISBN');
    $response->assertSee('Assunto');
});

it('a página de relatório de autores exibe dados', function () {
    $autor = Autor::factory()->create();
    $assunto = Assunto::factory()->create();
    
    $livro = Livro::factory()->create([
        'titulo' => 'Livro Exemplo',
        'editora' => 'Editora Exemplo',
        'edicao' => 1,
        'ano_publicacao' => 2023,
        'valor' => 50.00,
        'isbn' => '123-456789124',
    ]);

    $livro->autores()->attach($autor);
    $livro->assuntos()->attach($assunto);

    $response = $this->get(route('relatorio.autores'));

    $response->assertStatus(200);

    $response->assertSee($autor->nome);
    $response->assertSee($livro->titulo);
    $response->assertSee($livro->editora);
    $response->assertSee($livro->edicao);
    $response->assertSee($livro->valor);
    $response->assertSee($livro->isbn);
	#$response->assertSee($assunto->descricao);
    
	
});
