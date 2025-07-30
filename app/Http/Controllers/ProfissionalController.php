<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use App\Models\Especialidade;
use App\Models\MovimentacaoFinanceira;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProfissionalController extends Controller
{
    public function index()
    {
        $profissionais = Profissional::with('especialidades')->get();
        return view('profissionais.index', ['profissionais' => $profissionais]);
    }

    public function create()
    {
        $especialidades = Especialidade::all();
        return view('profissionais.create', ['especialidades' => $especialidades]);
    }

    public function store(Request $request)
    {
        $request->merge(['telefone' => preg_replace('/[^0-9]/', '', $request->telefone)]);
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:profissionais',
            'cro' => 'required|string|max:15',
            'telefone' => 'nullable|string|max:13',
            'salario_base' => 'nullable|numeric|min:0',
            'especialidades' => 'nullable|array',
        ]);

        $profissional = Profissional::create($request->except('especialidades'));
        if ($request->has('especialidades')) {
            $profissional->especialidades()->sync($request->especialidades);
        }

        return redirect()->route('profissionais.index')->with('success', 'Profissional cadastrado com sucesso!');
    }

    public function edit(string $id)
    {
        $profissional = Profissional::with('especialidades')->findOrFail($id);
        $especialidades = Especialidade::all();

        return view('profissionais.edit', [
            'profissional' => $profissional,
            'especialidades' => $especialidades
        ]);
    }

    public function update(Request $request, string $id)
    {
        $profissional = Profissional::findOrFail($id);
        $request->merge(['telefone' => preg_replace('/[^0-9]/', '', $request->telefone)]);
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:profissionais,email,' . $profissional->id_profissional . ',id_profissional',
            'cro' => 'required|string|max:15',
            'telefone' => 'nullable|string|max:13',
            'salario_base' => 'nullable|numeric|min:0',
            'especialidades' => 'nullable|array',
        ]);

        $profissional->update($request->except('especialidades'));
        $profissional->especialidades()->sync($request->especialidades ?? []);

        return redirect()->route('profissionais.index')->with('success', 'Profissional atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        try {
            $profissional = Profissional::findOrFail($id);
            $profissional->delete();
            return redirect()->route('profissionais.index')->with('success', 'Profissional excluído com sucesso!');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('profissionais.index')->with('error', 'Este profissional não pode ser excluído, pois possui um histórico no sistema.');
            }
            return redirect()->route('profissionais.index')->with('error', 'Ocorreu um erro ao excluir o profissional.');
        }
    }

    public function lancarSalario(Profissional $profissional)
    {
        if (!$profissional->salario_base || $profissional->salario_base <= 0) {
            return redirect()->route('profissionais.index')->with('error', 'Profissional não possui um salário base definido.');
        }

        MovimentacaoFinanceira::create([
            'descricao' => "Pagamento de salário para {$profissional->nome}",
            'valor' => $profissional->salario_base,
            'tipo' => 'Saida',
            'data_movimentacao' => now(),
        ]);

        return redirect()->route('profissionais.index')->with('success', "Pagamento de R$ " . number_format($profissional->salario_base, 2, ',', '.') . " lançado com sucesso!");
    }
}