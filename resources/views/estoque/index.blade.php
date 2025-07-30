@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Itens de Estoque</h1>
        <div>
            <a href="{{ route('estoque.createEntrada') }}" class="btn btn-info">Registrar Entrada</a>
            <a href="{{ route('estoque.create') }}" class="btn btn-success">Cadastrar Novo Item</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Quantidade Atual</th>
                <th>Estoque Mínimo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($itens as $item)
            <tr>
                <td>{{ $item->id_item_estoque }}</td>
                <td>{{ $item->descricao }}</td>
                <td>{{ $item->quantidade }}</td>
                <td>{{ $item->estoque_min }}</td>
                <td>
                    <a href="{{ route('estoque.movimentacoes', $item->id_item_estoque) }}" class="btn btn-info btn-sm">Mov.</a>
                    <a href="{{ route('estoque.edit', $item->id_item_estoque) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('estoque.destroy', $item->id_item_estoque) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                </td>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Nenhum item encontrado no estoque.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection