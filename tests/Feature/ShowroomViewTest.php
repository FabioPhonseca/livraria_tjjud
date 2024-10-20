<?php
use App\Models\Livro;
use App\Models\Autor;
use function Pest\Laravel\get;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('consegue acessar a página showroom', function () {
    $response = get(route('livros.showroom'));
    $response->assertStatus(200);
});

it('exibe os livros na página showroom', function () {
    $autor = Autor::factory()->create();

    $livros = Livro::factory()->count(3)->create()->each(function ($livro) use ($autor) {
        $livro->autores()->attach($autor->codau);  // Associar autor aos livros
    });

    $response = get(route('livros.showroom'));

    $response->assertStatus(200);

    foreach ($livros as $livro) {
        $response->assertSee($livro->titulo);
    }

    $response->assertSee($autor->nome);
});
