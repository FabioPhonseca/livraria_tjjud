@extends('layouts.app')

@section('content')
    <div class="container">
	@include('includes.messages')
		<table>
			<tr>
				<td>

					@if ($livro->imagem_capa)
						<img src="{{ asset('storage/' . $livro->imagem_capa) }}" class="img-small_vw" alt="Capa do Livro">
					@else
						<img src="{{ asset('images/capa_default.jpg') }}" class="img-small_vw" alt="Capa do Livro">
					@endif

				</td>
				<td>
					<h1 class="mt-4">{{ $livro->titulo }}</h1>
					<p><strong>Editora:</strong> {{ $livro->editora }}</p>
					<p><strong>Edição:</strong> {{ $livro->edicao }}</p>
					<p><strong>Ano de Publicação:</strong> {{ $livro->ano_publicacao }}</p>
					<p><strong>ISBN:</strong> {{ $livro->isbn }}</p>

					<p><strong>Autores:</strong></p>
					<ul>
						@foreach ($livro->autores as $autor)
							<li>{{ $autor->nome }}</li>
						@endforeach
					</ul>
					
					<p><strong>Assuntos:</strong></p>
					<ul>
						@foreach ($livro->assuntos as $assunto)
							<li>{{ $assunto->descricao }}</li>
						@endforeach
					</ul>
					
					<a href="{{ route('livros.edit', $livro) }}" class="btn btn-warning">Editar</a>
					<a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
				</td>
			</tr>
		</table>
    </div>
@endsection
