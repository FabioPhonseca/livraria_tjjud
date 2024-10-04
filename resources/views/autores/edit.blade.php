@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Editar Autor</h1>
        <form action="{{ route('autores.update', $autor) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ $autor->nome }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
@endsection
