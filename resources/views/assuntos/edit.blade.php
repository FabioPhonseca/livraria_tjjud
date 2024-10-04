@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Editar Assunto</h1>
		
		@include('includes.messages')
		
        <form action="{{ route('assuntos.update', $assunto) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" name="descricao" value="{{ $assunto->descricao }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
@endsection
