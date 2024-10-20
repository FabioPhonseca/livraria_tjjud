<?php
use App\Models\Autor;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('a página de listagem de autores está acessível e exibe os autores', function () {
    $autor1 = Autor::factory()->create(['nome' => 'Autor 1']);
    $autor2 = Autor::factory()->create(['nome' => 'Autor 2']);

    $response = $this->get(route('autores.index'));

    $response->assertStatus(200);

    $response->assertSee('Autor 1');
    $response->assertSee('Autor 2');

    $response->assertSee('Autores');
    $response->assertSee('Adicionar Autor');
});

it('a página de edição de autor está acessível e exibe os dados corretos', function () {
    $autor = Autor::factory()->create(['nome' => 'Autor de Teste']);

    $response = $this->get(route('autores.edit', $autor));

    $response->assertStatus(200);

    $response->assertSee('Autor de Teste');
    $response->assertSee('Atualizar');
});