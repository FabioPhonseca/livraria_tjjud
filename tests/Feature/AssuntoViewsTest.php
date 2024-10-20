<?php
use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('a página de listagem de assuntos está acessível e exibe os assuntos', function () {
    $assunto1 = Assunto::factory()->create(['descricao' => 'Assunto 1']);
    $assunto2 = Assunto::factory()->create(['descricao' => 'Assunto 2']);

    $response = $this->get(route('assuntos.index'));

    $response->assertStatus(200);

    $response->assertSee('Assunto 1');
    $response->assertSee('Assunto 2');

    $response->assertSee('Assuntos');
    $response->assertSee('Adicionar Assunto');
});

it('a página de edição de assunto está acessível e exibe os dados corretos', function () {
    $assunto = Assunto::factory()->create(['descricao' => 'Assunto de Teste']);

    $response = $this->get(route('assuntos.edit', $assunto));

    $response->assertStatus(200);

    $response->assertSee('Assunto de Teste');
    $response->assertSee('Atualizar');
});