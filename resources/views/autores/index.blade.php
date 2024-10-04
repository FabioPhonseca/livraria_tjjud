@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Autores</h1>

		@include('includes.messages')

        <a href="{{ route('autores.create') }}" class="btn btn-primary mb-3">Adicionar Autor</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($autores as $autor)
                    <tr>
                        <td>{{ $autor->nome }}</td>
                        <td>
                            <a href="{{ route('autores.show', $autor) }}" class="btn btn-info btn-sm">Visualizar</a>
                            <a href="{{ route('autores.edit', $autor) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('autores.destroy', $autor) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <!-- Paginação -->
    <div class="d-flex justify-content-center">
        {{ $autores->links() }}
    </div>			
    </div>
@endsection

