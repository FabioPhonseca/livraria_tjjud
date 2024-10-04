@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Livros</h1>
				
		@include('includes.messages')
		
    <a href="{{ route('livros.create') }}" class="btn btn-primary mb-3">Adicionar Livro</a>
    <table class="table table-bordered">
        <thead>
            <tr>
				<th></th>
                <th>Título</th>
                <th>Editora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($livros as $livro)
                <tr>
					<td>
						@if ($livro->imagem_capa)
							<img src="{{ asset('storage/' . $livro->imagem_capa) }}" class="card-img-top img-small_ix" alt="Capa do Livro">
						@else
							<img src="{{ asset('images/capa_default.jpg') }}" class="card-img-top img-small_ix" alt="Capa do Livro">
						@endif
					</td>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->editora }}</td>
                    <td>
                        <a href="{{ route('livros.show', $livro) }}" class="btn btn-info btn-sm">Visualizar</a>
                        <a href="{{ route('livros.edit', $livro) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('livros.destroy', $livro) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
	</h1>
    <!-- Paginação -->
    <div class="d-flex justify-content-center">
        {{ $livros->links() }}
    </div>	
	</div>
@endsection
