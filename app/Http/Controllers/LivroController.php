<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index()
    {
		$livros = Livro::orderBy('created_at', 'desc')->simplePaginate(8);
		return view('livros.index', compact('livros'));
    }

    public function showroom(Request $request)
    {
        $query = Livro::query();
		
        if ($request->has('search')) {
            $search = $request->input('search');

            // pesquisa nas tabelas relacionadas (título do livro, autor e assunto)
            $query->where('titulo', 'like', "%{$search}%")
                  ->orWhereHas('autores', function ($q) use ($search) {
                      $q->where('nome', 'like', "%{$search}%");
                  })
                  ->orWhereHas('assuntos', function ($q) use ($search) {
                      $q->where('descricao', 'like', "%{$search}%");
                  });
        }

        $livros = $query->inRandomOrder()->simplePaginate(8);

        return view('livros.showroom', compact('livros'));
    }


    public function create()
    {
		$autores = Autor::all();
		$assuntos = Assunto::all();
		return view('livros.create', compact('autores', 'assuntos'));
    }

    public function store(Request $request)
    {
		$request->validate([
            'titulo' => 'required|string|no_quotes',
            'editora' => 'required|string|no_quotes',
            'edicao' => 'integer',
            'ano_publicacao' => 'nullable|max:4',
            'isbn' => 'nullable|string|no_quotes|unique:livros,isbn',
			'imagem_capa' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
			'autores' => 'array',
			'assuntos' => 'array',			
        ]);
		
		$livro = Livro::create($request->except('imagem_capa')); 
		
		if ($request->hasFile('imagem_capa')) {
			$path = $request->file('imagem_capa')->store('imagens_livros', 'public');
			$livro->imagem_capa = $path;
			$livro->save();
		}
		
		$livro->autores()->sync($request->autores ?? []);
		$livro->assuntos()->sync($request->assuntos ?? []);

        return redirect()->route('livros.index')->with('success', 'Livro adicionado com sucesso.');
    }

    public function show(Livro $livro)
    {
        return view('livros.show', compact('livro'));
    }

    public function edit(Livro $livro)
    {
		$autores = Autor::all();
		$assuntos = Assunto::all();
		return view('livros.edit', compact('livro', 'autores', 'assuntos'));
	}

	public function update(Request $request, Livro $livro)
	{
		$request->validate([
			'titulo' => 'required|string|no_quotes',
			'editora' => 'required|string|no_quotes|',
			'edicao' => 'nullable|integer',
			'ano_publicacao' => 'nullable|integer',
			'isbn' => 'nullable|string|no_quotes|',
			'imagem_capa' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
			'autores' => 'array',
			'assuntos' => 'array',
		]);

		$livro->update($request->except('imagem_capa'));
		
		if ($request->hasFile('imagem_capa')) {
			$path = $request->file('imagem_capa')->store('imagens_livros', 'public');
			$livro->imagem_capa = $path;
			$livro->save();
		}
		
		$livro->autores()->sync($request->autores ?? []);
		$livro->assuntos()->sync($request->assuntos ?? []);

		return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso.');
	}


    public function destroy(Livro $livro)
    {
        $livro->delete();
        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso.');
    }
}
