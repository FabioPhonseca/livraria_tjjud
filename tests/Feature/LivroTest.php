<?php
use App\Models\Livro;
use function Pest\Laravel\{get, post, put, delete};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

it('pode criar um livro', function () {
    //dd(DB::connection()->getDatabaseName());
	$livroData = [
        'titulo' => 'Livro de Teste',
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'ano_publicacao' => '2024',
        'valor' => 'R$ 59,90',
        'isbn' => '9781234567110',
    ];

    $response = $this->post(route('livros.store'), $livroData);

    $response->assertRedirect(route('livros.index'));
    $this->assertDatabaseHas('livros', [
        'titulo' => 'Livro de Teste',
        'editora' => 'Editora Teste',
		]);
});

it('pode apagar o livro criado', function(){
    $livroData = [
        'titulo' => 'Livro de Teste 2',
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'ano_publicacao' => '2024',
        'valor' => 'R$ 59,90',
        'isbn' => '9781234567890',
    ];

    $this->post(route('livros.store'), $livroData)
         ->assertRedirect(route('livros.index'));

    $this->assertDatabaseHas('livros', ['titulo' => 'Livro de Teste 2']);

    $this->delete(route('livros.destroy', Livro::where('titulo', 'Livro de Teste 2')->first()->codl))
         ->assertRedirect(route('livros.index'));

    $this->assertDatabaseMissing('livros', $livroData);
});

it('pode aceitar valor com prefixo R$ ', function () {
    $livro = Livro::create([
        'titulo' => 'Livro de Teste Formatação',
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'ano_publicacao' => '2024',
        'valor' => 'R$ 59,90',
        'isbn' => '9781234567890',
    ]);

    // Verifica se o valor foi formatado corretamente
    expect($livro->valor)->toBe('R$ 59,90');
});

it('consegue salvar valor no banco sem prefixo R$', function () {
    $livro = new Livro();
	$livro->titulo = 'Livro de Teste Formatação';
    $livro->valor = 'R$ 59,90';
    $livro->save();

    $this->assertDatabaseHas('livros', [
        'titulo' => 'Livro de Teste Formatação',
        'valor' => '59.90'
    ]);
});


it('o título é obrigatório', function () {
    $livroData = [
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'ano_publicacao' => '2024',
        'isbn' => '9781234567890',
    ];

    $this->post(route('livros.store'), $livroData)
         ->assertSessionHasErrors('titulo');
});

it('a editora é obrigatória', function () {
    $livroData = [
        'titulo' => 'Livro de Teste',
        'edicao' => 1,
        'ano_publicacao' => '2024',
        'isbn' => '9781234567890',
    ];

    $this->post(route('livros.store'), $livroData)
         ->assertSessionHasErrors('editora');
});

it('a edição é obrigatória e deve ser um inteiro', function () {
    $livroData = [
        'titulo' => 'Livro de Teste',
        'editora' => 'Editora Teste',
        'ano_publicacao' => '2024',
        'isbn' => '9781234567890',
        'edicao' => 'string', // não é um inteiro
    ];

    $this->post(route('livros.store'), $livroData)
         ->assertSessionHasErrors('edicao');
});

it('o ano de publicação é obrigatório e deve ter no máximo 4 caracteres', function () {
    $livroData = [
        'titulo' => 'Livro de Teste',
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'isbn' => '9781234567890',
        'ano_publicacao' => '20245', // mais de 4 caracteres
    ];

    $this->post(route('livros.store'), $livroData)
         ->assertSessionHasErrors('ano_publicacao');
});

it('o ISBN é opcional, deve ser uma string e única se fornecido', function () {
    $livroData1 = [
        'titulo' => 'Livro de Teste',
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'ano_publicacao' => '2024',
        'isbn' => '9781234567890',
    ];

    // Cria o primeiro livro
    $this->post(route('livros.store'), $livroData1)
         ->assertRedirect(route('livros.index'));

    // Tenta criar um segundo livro com o mesmo ISBN
    $livroData2 = [
        'titulo' => 'Outro Livro',
        'editora' => 'Outra Editora',
        'edicao' => 2,
        'ano_publicacao' => '2025',
        'isbn' => '9781234567890', // mesmo ISBN
    ];

    $this->post(route('livros.store'), $livroData2)
         ->assertSessionHasErrors('isbn');
});

it('a imagem da capa deve ser uma imagem válida', function () {
    $livroData = [
        'titulo' => 'Livro de Teste',
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'ano_publicacao' => '2024',
        'isbn' => '9781234567890',
        'imagem_capa' => 'not-an-image.txt', // arquivo inválido
    ];

    $this->post(route('livros.store'), $livroData)
         ->assertSessionHasErrors('imagem_capa');
});

it('consegue editar um livro', function () {
    $livro = Livro::create([
        'titulo' => 'Livro Original',
        'editora' => 'Editora Original',
    ]);

    $livroData = [
        'titulo' => 'Livro Editado',
        'editora' => 'Editora Editada',
        'edicao' => 2,
        'ano_publicacao' => '2025',
        'valor' => 'R$ 79,90',
    ];

    $response = put(route('livros.update', $livro->codl), $livroData);

    $response->assertRedirect(route('livros.index'));

    $this->assertDatabaseHas('livros', [
        'codl' => $livro->codl,
        'titulo' => 'Livro Editado',
        'editora' => 'Editora Editada',
        'edicao' => 2,
        'ano_publicacao' => '2025',
        'valor' => 79.90,
    ]);
});
