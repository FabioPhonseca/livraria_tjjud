<?php
use App\Models\Livro;
use App\Models\Assunto;
use function Pest\Laravel\{get, post, put, delete};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('pode criar um assunto', function () {
    $assuntoData = [
        'descricao' => 'Assunto Teste'
    ];

    $response = post(route('assuntos.store'), $assuntoData);

    $response->assertRedirect(route('assuntos.index'));
    $this->assertDatabaseHas('assuntos', $assuntoData);
});

it('pode apagar um assunto', function () {
    $assunto = Assunto::create(['descricao' => 'Assunto Teste']);

    $response = delete(route('assuntos.destroy', $assunto->codas));

    $response->assertRedirect(route('assuntos.index'));
    $this->assertDatabaseMissing('assuntos', ['descricao' => 'Assunto Teste']);
});

it('consegue impedir duplicidade de assuntos', function () {
    Assunto::create(['descricao' => 'Assunto Duplicado']);

    $response = post(route('assuntos.store'), ['descricao' => 'Assunto Duplicado']);

    //$response->assertStatus(422);
	// neste caso é 302 pq quando tem um erro é direcionado de volta para o formulário
	$response->assertStatus(302);

    $response->assertSessionHasErrors([
        'descricao' => 'A descrição já está em uso.'
    ]);
    $this->assertDatabaseCount('assuntos', 1);
});

it('não pode excluir um assunto que possui livros associados', function () {
    $assunto = Assunto::create(['descricao' => 'Assunto Teste']);
    $livro = Livro::create([
        'titulo' => 'Livro de Teste',
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'ano_publicacao' => '2024',
        'valor' => 'R$ 59,90',
        'isbn' => '9781234567890',
    ]);
    
    $livro->assuntos()->attach($assunto->codas);

    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('Não é possível excluir um assunto que possui livros associados.');

    $assunto->delete();
});

it('consegue editar um assunto', function () {
    $assunto = Assunto::create([
        'descricao' => 'Assunto Original',
    ]);

    $assuntoData = [
        'descricao' => 'Assunto Editado',
    ];

    $response = put(route('assuntos.update', $assunto->codas), $assuntoData);

    $response->assertRedirect(route('assuntos.index'));

    $this->assertDatabaseHas('assuntos', [
        'codas' => $assunto->codas,
        'descricao' => 'Assunto Editado',
    ]);
});
