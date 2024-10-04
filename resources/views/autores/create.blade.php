@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Criar Autor</h1>
        <form action="{{ route('autores.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="Nome" required>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
@endsection
