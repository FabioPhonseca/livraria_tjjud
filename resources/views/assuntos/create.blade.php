@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Criar Assunto</h1>
        <form action="{{ route('assuntos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" name="descricao" placeholder="Descrição" required>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
@endsection
