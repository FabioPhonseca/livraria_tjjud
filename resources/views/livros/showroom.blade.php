@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Livraria - TJJUD</h1>

    <!-- Formulário de Pesquisa -->
    <form method="GET" action="{{ route('livros.showroom') }}" class="mb-4">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por título, autor ou assunto" value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
    </form>

    <!-- Listagem dos Livros -->
    <div class="row">
        @forelse ($livros as $livro)
            <div class="col-md-3 mb-4">
                <a href="{{ route('livros.show', $livro) }}">
				<div class="card">
					@if ($livro->imagem_capa)
						<img src="{{ asset('storage/' . $livro->imagem_capa) }}" class="card-img-top img-small_sh" alt="Capa do Livro">
					@else
						<img src="{{ asset('images/capa_default.jpg') }}" class="card-img-top img-small_sh" alt="Capa do Livro">
					@endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $livro->titulo }}</h5>
                        <p class="card-text">
                            Autor: {{ $livro->autores->first()->nome ?? 'Desconhecido' }}
                        </p>
                    </div>
                </div>
				</a>
            </div>
        @empty
            <p>Nenhum livro encontrado.</p>
        @endforelse
    </div>

    <!-- Paginação -->
    <div class="d-flex justify-content-center">
        {{ $livros->links() }}
    </div>
</div>
@endsection
