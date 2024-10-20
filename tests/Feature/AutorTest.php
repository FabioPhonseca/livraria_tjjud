<?php
use App\Models\Livro;
use App\Models\Autor;
use function Pest\Laravel\{get, post, put, delete};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

it('pode criar um autor', function () {
    $autorData = [
        'nome' => 'Autor Teste'
    ];

    $response = post(route('autores.store'), $autorData);

    $response->assertRedirect(route('autores.index'));
    $this->assertDatabaseHas('autores', $autorData);
});

it('pode apagar um autor', function () {
    $autor = Autor::create(['nome' => 'Autor Teste']);

    $response = delete(route('autores.destroy', $autor->codau));

    $response->assertRedirect(route('autores.index'));
    $this->assertDatabaseMissing('autores', ['nome' => 'Autor Teste']);
});

it('consegue impedir duplicidade de autores', function () {
    Autor::create(['nome' => 'Autor Duplicado']);

    $response = post(route('autores.store'), ['nome' => 'Autor Duplicado']);

    //$response->assertStatus(422);
	// 302 por causa do redirecionamento para o formulário
	$response->assertStatus(302);
	
    $response->assertSessionHasErrors([
        'nome' => 'A nome já está em uso.'
    ]);

    $this->assertDatabaseCount('autores', 1);
});

it('não pode excluir um autor que possui livros associados', function () {
    $autor = Autor::create(['nome' => 'Autor Teste']);
    $livro = Livro::create([
        'titulo' => 'Livro de Teste',
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'ano_publicacao' => '2024',
        'valor' => 'R$ 59,90',
        'isbn' => '9781234567890',
    ]);
    
    $livro->autores()->attach($autor->codau);

    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('Não é possível excluir um autor que possui livros associados.');

    $autor->delete();
});

it('consegue editar um autor', function () {
    $autor = Autor::create([
        'nome' => 'Autor Original',
    ]);

    $autorData = [
        'nome' => 'Autor Editado',
    ];

    $response = put(route('autores.update', $autor->codau), $autorData);

    $response->assertRedirect(route('autores.index'));

    $this->assertDatabaseHas('autores', [
        'codau' => $autor->codau,
        'nome' => 'Autor Editado',
    ]);
});
