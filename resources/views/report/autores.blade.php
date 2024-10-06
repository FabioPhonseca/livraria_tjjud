<?php
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\google\ColumnChart;
?>
@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>Relatório de Autores</title>
        <!-- Incluindo Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container mt-5">
        <h2>Quantidade de livros por autor</h2>
        <?php 
			 ColumnChart::create(array(
					"dataSource" => $chart,
					"title" => "Os 6 autores com mais livros cadastrados",
					"columns" => [
						"autor",
						"livros"
					],
					"options" => [
						"hAxis" => [
							"title" => "Autores"
						],
						"vAxis" => [
							"title" => "Qtd livros",
							"textPosition" => "out",
							"textStyle" => [
								"fontSize" => 14,
								"color" => "#000"
							],
							 "format" => "0"
						],
						
						"height" => 400
					]
				));
        ?>

        <h2 class="mt-5">Resumo de livros por autor</h2>
		<table class="table table table-striped table-bordered">
			<thead>
				<tr>
					<th>Autor</th>
					<th>Título</th>
					<th>Editora</th>
					<th>Edição</th>
					<th>Ano Publicação</th>
					<th>Valor</th>
					<th>ISBN</th>
					<th>Assunto</th>
				</tr>
			</thead>
			<tbody>
				@php
					$currentAuthor = null;
					$totalValue = 0;
					$totalCount = 0;
				@endphp

				@foreach ($data as $row)
					@if ($currentAuthor !== $row->nome)
						@if ($currentAuthor !== null)
							<tr>
								<td colspan="5"><strong>Total para {{ $currentAuthor }}:</strong></td>
								<td><strong>R$ {{ number_format($totalValue, 2, ',', '.') }}</strong></td>
								<td colspan="2"><strong>Total de Livros: {{ $totalCount }}</strong></td>
							</tr>
						@endif

						@php
							$currentAuthor = $row->nome;
							$totalValue = 0;
							$totalCount = 0;
						@endphp

						<tr>
							<td>{{ $currentAuthor }}</td>
							<td>{{ $row->titulo }}</td>
							<td>{{ $row->editora }}</td>
							<td>{{ $row->edicao }}</td>
							<td>{{ $row->ano_publicacao }}</td>
							<td>{{ $row->valor }}</td>
							<td>{{ $row->isbn }}</td>
							<td>{{ $row->assunto }}</td>
						</tr>
					@else
						<tr>
							<td></td>
							<td>{{ $row->titulo }}</td>
							<td>{{ $row->editora }}</td>
							<td>{{ $row->edicao }}</td>
							<td>{{ $row->ano_publicacao }}</td>
							<td>{{ $row->valor }}</td>
							<td>{{ $row->isbn }}</td>
							<td>{{ $row->assunto }}</td>
						</tr>
					@endif

					@php
						$totalValue += (float)str_replace(['R$', '.', ','], ['', '', '.'], $row->valor);
						$totalCount++;
						if ($row->titulo == null) {
								$totalCount = 0;
						}
					@endphp
				@endforeach

				@if ($currentAuthor !== null)
					<tr>
						<td colspan="5"><strong>Total para {{ $currentAuthor }}:</strong></td>
						<td><strong>R$ {{ number_format($totalValue, 2, ',', '.') }}</strong></td>
						<td colspan="2"><strong>Total de Livros: {{ $totalCount }}</strong></td>
					</tr>
				@endif
			</tbody>
		</table>
    </body>
</html>
@endsection
