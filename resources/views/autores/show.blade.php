@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">{{ $autor->nome }}</h1>
        <a href="{{ route('autores.edit', $autor) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('autores.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection