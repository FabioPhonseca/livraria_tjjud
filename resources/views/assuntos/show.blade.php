@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">{{ $assunto->descricao }}</h1>
        <a href="{{ route('assuntos.edit', $assunto) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
