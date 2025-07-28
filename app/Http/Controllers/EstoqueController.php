<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MovimentacaoGeralEstoque;

class EstoqueController extends Controller
{
    public function index()
    {
        return view('estoque.index', ['itens' => Estoque::all()]);
    }

    public function create()
    {
        return view('estoque.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'quantidade' => 'required|numeric|min:0',
            'estoque_min' => 'required|numeric|min:0',
        ]);

        Estoque::create($request->all());
        return redirect()->route('estoque.index')->with('success', 'Item de estoque cadastrado com sucesso!');
    }

    public function edit(string $id)
    {
        return view('estoque.edit', ['item' => Estoque::findOrFail($id)]);
    }

    public function update(Request $request, string $id)
    {
        $item = Estoque::findOrFail($id);
        $request->validate([
            'descricao' => 'required|string|max:255',
            'quantidade' => 'required|numeric|min:0',
            'estoque_min' => 'required|numeric|min:0',
        ]);
        $item->update($request->all());
        return redirect()->route('estoque.index')->with('success', 'Item de estoque atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $item = Estoque::findOrFail($id);
        $item->delete();
        return redirect()->route('estoque.index')->with('success', 'Item de estoque excluído com sucesso!');
    }
    public function createEntrada()
    {
        $itens = Estoque::all();
        return view('estoque.create-entrada', ['itens' => $itens]);
    }

    public function storeEntrada(Request $request)
    {
        $request->validate([
            'id_item_estoque' => 'required|exists:estoque,id_item_estoque',
            'quantidade' => 'required|numeric|min:0.001',
            'justificativa' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();
            $item = Estoque::findOrFail($request->id_item_estoque);
            $item->increment('quantidade', $request->quantidade);

            MovimentacaoGeralEstoque::create([
                'id_item_estoque' => $request->id_item_estoque,
                'quantidade' => $request->quantidade,
                'tipo' => 'Entrada',
                'justificativa' => $request->justificativa ?? 'Entrada manual no sistema',
            ]);

            DB::commit();
            return redirect()->route('estoque.index')->with('success', 'Entrada de estoque registrada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao registrar entrada: ' . $e->getMessage());
        }
    }
}