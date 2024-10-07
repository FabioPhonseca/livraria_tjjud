@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="mt-4">Criar Livro</h1>		

		@include('includes.messages')

        <form action="{{ route('livros.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">

                <label for="titulo">Título</label>

                <input type="text" class="form-control" name="titulo" placeholder="Título" value="{{ old('titulo') }}" required maxlength="40">

            </div>

            <div class="form-group">

                <label for="editora">Editora</label>

                <input type="text" class="form-control" name="editora" placeholder="Editora" value="{{ old('editora') }}" required maxlength="40">

            </div>

            <div class="form-group">

                <label for="edicao">Edição</label>

                <input type="number" class="form-control" name="edicao" placeholder="Edição" value="{{ old('edicao') }}" min="0">

            </div>

            <div class="form-group">

                <label for="ano_publicacao">Ano de Publicação</label>

                <input type="number" class="form-control" name="ano_publicacao" placeholder="Ano de Publicação" value="{{ old('ano_publicacao') }}" required min="1800" max="2024">

                <small class="form-text text-muted">Insira um ano válido (ex: 2023).</small>

            </div>

            <div class="form-group">

                <label for="valor">Valor</label>

                <input type="text" class="form-control" name="valor" placeholder="Valor" value="{{ old('valor') }}" required pattern="^R\$ \d+,\d{1,2}?$">

                <small class="form-text text-muted">Formato: R$ 0.00 (ex:R$ 19.99).</small>

            </div>

			<div class="form-group">

				<label for="isbn">ISBN</label>

				<input type="text" class="form-control" name="isbn" placeholder="ISBN" value="{{ old('isbn') }}" maxlength="13" minlength="13">

				<small class="form-text text-muted">Máximo de 13 caracteres.</small>

			</div>

			<div class="form-group">

				<label for="imagem_capa">Capa do Livro</label>

				<input type="file" class="form-control" name="imagem_capa" accept="image/*">

				<small class="form-text text-muted">Selecione uma imagem para a capa do livro.</small>

			</div>

			<div class="form-group">

				<label for="autores">Autores</label>

				<select name="autores[]" id="autores" class="form-control" multiple>

					@foreach($autores as $autor)

						<option value="{{ $autor->codau }}" {{ in_array($autor->codau, old('autores', [])) ? 'selected' : '' }}>

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

						<option value="{{ $assunto->codas }}" {{ in_array($assunto->codas, old('assuntos', [])) ? 'selected' : '' }}>

							{{ $assunto->descricao }}

						</option>

					@endforeach

				</select>

				<small class="form-text text-muted">Segure o Ctrl para selecionar múltiplos assuntos.</small>

			</div>			

            <button type="submit" class="btn btn-success">Salvar</button>

        </form>

    </div>

@endsection

