@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Editar Livro</h1>
        @include('includes.messages')
        <form action="{{ route('livros.update', $livro) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" value="{{ $livro->titulo }}" required maxlength="40">
            </div>
            <div class="form-group">
                <label for="editora">Editora</label>
                <input type="text" class="form-control" name="editora" value="{{ $livro->editora }}" required maxlength="40">
            </div>
            <div class="form-group">
                <label for="edicao">Edição</label>
                <input type="number" class="form-control" name="edicao" value="{{ $livro->edicao }}" min="0">
            </div>
            <div class="form-group">
                <label for="ano_publicacao">Ano de Publicação</label>
                <input type="text" class="form-control" name="ano_publicacao" value="{{ $livro->ano_publicacao }}" required maxlength="4" pattern="\d{4}">
		 <small class="form-text text-muted">Insira um ano válido (ex: 2023).</small>
            </div>
            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="text" class="form-control" name="valor" placeholder="Valor" value="{{ $livro->valor }}" required pattern="^\d+(\.\d{1,2})?$">
                <small class="form-text text-muted">Formato: 0.00 (ex: 19.99).</small>
            </div>
			<div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" name="isbn" value="{{ $livro->isbn }}">
		<small class="form-text text-muted">Máximo de 13 caracteres.</small>
            </div>
            <div class="form-group">
                <label for="imagem_capa">Capa do Livro</label>
                <input type="file" class="form-control" name="imagem_capa" accept="image/*">
                @if ($livro->imagem_capa)
                    <img src="{{ asset('storage/' . $livro->imagem_capa) }}" alt="Capa do Livro" class="mt-2" style="max-width: 200px;">
                @endif
                <small class="form-text text-muted">Selecione uma imagem para a capa do livro.</small>
            </div>
            <div class="form-group">
                <label for="autores">Autores</label>
                <select name="autores[]" id="autores" class="form-control" multiple>
                    @foreach($autores as $autor)
                        <option value="{{ $autor->codau }}" 
                            {{ $livro->autores->contains($autor->codau) ? 'selected' : '' }}>
                            {{ $autor->nome }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Segure o Ctrl para selecionar múltiplos autores.</small>
            </div>
            <div class="form-group">
                <label for="assuntos">Assuntos</label>
                <select name="assuntos[]" id="assuntos" class="form-control" multiple>
                    @foreach($assuntos as $assunto)
                        <option value="{{ $assunto->codas }}" 
                            {{ $livro->assuntos->contains($assunto->codas) ? 'selected' : '' }}>
                            {{ $assunto->descricao }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Segure o Ctrl para selecionar múltiplos assuntos.</small>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
@endsection
