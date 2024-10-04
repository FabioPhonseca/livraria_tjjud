<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    public function index()
    {
        $assuntos = Assunto::simplePaginate(8);
        return view('assuntos.index', compact('assuntos'));
    }

    public function create()
    {
        return view('assuntos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|unique:assuntos,descricao',
        ]);

        Assunto::create($request->all());
        return redirect()->route('assuntos.index')->with('success', 'Assunto adicionado com sucesso.');
    }

    public function show(Assunto $assunto)
    {
        return view('assuntos.show', compact('assunto'));
    }

    public function edit(Assunto $assunto)
    {
        return view('assuntos.edit', compact('assunto'));
    }

    public function update(Request $request, Assunto $assunto)
    {
        $request->validate([
            'descricao' => 'required|unique:assuntos,descricao,' . $assunto->codas . ',codas',
        ]);

        $assunto->update($request->all());
        return redirect()->route('assuntos.index')->with('success', 'Assunto atualizado com sucesso.');
    }

    public function destroy(Assunto $assunto)
    {
		try {
			$assunto->delete();
			return redirect()->route('assuntos.index')->with('success', 'Assunto excluído com sucesso.');
		} catch (\Exception $e) {
			return redirect()->route('assuntos.index')->with('error', $e->getMessage());
		}
    }
}
