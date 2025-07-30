<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\MovimentacaoFinanceira;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FuncionarioController extends Controller
{
    public function index()
    {
        return view('funcionarios.index', ['funcionarios' => Funcionario::all()]);
    }

    public function create()
    {
        return view('funcionarios.create');
    }

    public function store(Request $request)
    {
        $request->merge(['cpf' => preg_replace('/[^0-9]/', '', $request->cpf)]);

        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'nullable|string|digits:11|unique:funcionarios',
            'cargo' => 'required|string|max:255',
            'data_contratacao' => 'required|date',
            'salario' => 'required|numeric|min:0',
        ]);

        Funcionario::create($request->all());
        return redirect()->route('funcionarios.index')->with('success', 'Funcionário cadastrado com sucesso.');
    }

    public function show(Funcionario $funcionario)
    {
        return redirect()->route('funcionarios.edit', $funcionario);
    }

    public function edit(Funcionario $funcionario)
    {
        return view('funcionarios.edit', ['funcionario' => $funcionario]);
    }
    public function update(Request $request, Funcionario $funcionario)
    {
        $request->merge(['cpf' => preg_replace('/[^0-9]/', '', $request->cpf)]);
        
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => ['nullable', 'string', 'digits:11', Rule::unique('funcionarios')->ignore($funcionario->id)],
            'cargo' => 'required|string|max:255',
            'data_contratacao' => 'required|date',
            'salario' => 'required|numeric|min:0',
        ]);

        $funcionario->update($request->all());
        return redirect()->route('funcionarios.index')->with('success', 'Funcionário atualizado com sucesso.');
    }

    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();
        return redirect()->route('funcionarios.index')->with('success', 'Funcionário excluído com sucesso.');
    }

    public function lancarSalario(Funcionario $funcionario)
    {
        if (!$funcionario->salario || $funcionario->salario <= 0) {
            return redirect()->route('funcionarios.index')->with('error', 'Funcionário não possui um salário definido.');
        }

        MovimentacaoFinanceira::create([
            'descricao' => "Pagamento de salário para funcionário(a) {$funcionario->nome}",
            'valor' => $funcionario->salario,
            'tipo' => 'Saida',
            'data_movimentacao' => now(),
        ]);

        return redirect()->route('funcionarios.index')->with('success', "Pagamento de R$ " . number_format($funcionario->salario, 2, ',', '.') . " lançado com sucesso!");
    }
}