<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class EspecialidadeController extends Controller
{
    public function index()
    {
        return view('especialidades.index', ['especialidades' => Especialidade::all()]);
    }

    public function create()
    {
        return view('especialidades.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nome' => 'required|string|max:100|unique:especialidades']);
        Especialidade::create($request->all());
        return redirect()->route('especialidades.index')->with('success', 'Especialidade cadastrada com sucesso!');
    }

    public function edit(string $id)
    {
        return view('especialidades.edit', ['especialidade' => Especialidade::findOrFail($id)]);
    }

    public function update(Request $request, string $id)
    {
        $especialidade = Especialidade::findOrFail($id);
        $request->validate(['nome' => 'required|string|max:100|unique:especialidades,nome,' . $especialidade->id_especialidade . ',id_especialidade']);
        $especialidade->update($request->all());
        return redirect()->route('especialidades.index')->with('success', 'Especialidade atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        try {
            $especialidade = Especialidade::findOrFail($id);
            $especialidade->delete();

            return redirect()->route('especialidades.index')
                             ->with('success', 'Especialidade excluída com sucesso!');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('especialidades.index')
                                 ->with('error', 'Esta especialidade não pode ser excluída, pois está vinculada a um ou mais profissionais.');
            }
            return redirect()->route('especialidades.index')
                             ->with('error', 'Ocorreu um erro ao tentar excluir a especialidade.');
        }
    }
}