<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::orderBy('created_at', 'desc')->simplePaginate(8);
        return view('autores.index', compact('autores'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|no_quotes|unique:autores,nome',
        ]);

        Autor::create($request->all());
        return redirect()->route('autores.index')->with('success', 'Autor adicionado com sucesso.');
    }

    public function show(Autor $autor)
    {
        return view('autores.show', compact('autor'));
    }

    public function edit(Autor $autor)
    {
        return view('autores.edit', compact('autor'));
    }

    public function update(Request $request, Autor $autor)
    {
        $request->validate([
            'nome' => 'required|string|no_quotes|unique:autores,nome,' . $autor->codau . ',codau',
        ]);

        $autor->update($request->all());
        return redirect()->route('autores.index')->with('success', 'Autor atualizado com sucesso.');
    }

	public function destroy(Autor $autor)
	{
		try {
			//$autor = Autor::findOrFail($id); 
			$autor->delete();
			return redirect()->route('autores.index')->with('success', 'Autor excluído com sucesso.');
		} catch (\Exception $e) {
			return redirect()->route('autores.index')->with('error', $e->getMessage());
		}
	}

}


