@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Assuntos</h1>
		
		@include('includes.messages')
		
        <a href="{{ route('assuntos.create') }}" class="btn btn-primary mb-3">Adicionar Assunto</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assuntos as $assunto)
                    <tr>
                        <td>{{ $assunto->descricao }}</td>
                        <td>
                            <a href="{{ route('assuntos.show', $assunto) }}" class="btn btn-info btn-sm">Visualizar</a>
                            <a href="{{ route('assuntos.edit', $assunto) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('assuntos.destroy', $assunto) }}" method="POST" style="display:inline;">
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
        {{ $assuntos->links() }}
    </div>			
    </div>
@endsection
