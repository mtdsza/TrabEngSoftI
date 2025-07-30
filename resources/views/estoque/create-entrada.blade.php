@extends('layouts.app')

@section('content')
    <h1>Registrar Entrada de Estoque</h1>

    <form action="{{ route('estoque.storeEntrada') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_item_estoque" class="form-label">Item:</label>
            <select name="id_item_estoque" id="id_item_estoque" class="form-select" required>
                @foreach($itens as $item)
                    <option value="{{ $item->id_item_estoque }}">{{ $item->descricao }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade Adicionada:</label>
            <input type="number" step="0.001" id="quantidade" name="quantidade" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="justificativa" class="form-label">Justificativa (Ex: Nota Fiscal 123):</label>
            <input type="text" id="justificativa" name="justificativa" class="form-control">
        </div>
        <div class="mb-3">
            <label for="valor_compra" class="form-label">Valor Total da Compra (R$):</label>
            <input type="number" step="0.01" id="valor_compra" name="valor_compra" class="form-control">
            <small class="form-text text-muted">Opcional: preencha para registrar esta compra como uma despesa no financeiro.</small>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Entrada</button>
        <a href="{{ route('estoque.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection