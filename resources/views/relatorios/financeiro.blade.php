@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Relatório Financeiro</h1>
        <a href="{{ route('financeiro.createDespesa') }}" class="btn btn-danger">Lançar Nova Despesa</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            Filtrar por Período
        </div>
        <div class="card-body">
            <form action="{{ route('relatorios.financeiro') }}" method="GET">
                <div class="row">
                    <div class="col-md-5">
                        <label for="data_inicio" class="form-label">Data de Início</label>
                        <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="{{ $dataInicio }}">
                    </div>
                    <div class="col-md-5">
                        <label for="data_fim" class="form-label">Data de Fim</label>
                        <input type="date" class="form-control" id="data_fim" name="data_fim" value="{{ $dataFim }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total de Entradas</h5>
                    <p class="card-text fs-4">R$ {{ number_format($totalEntradas, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Total de Saídas</h5>
                    <p class="card-text fs-4">R$ {{ number_format($totalSaidas, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Saldo do Período</h5>
                    <p class="card-text fs-4">R$ {{ number_format($saldo, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Tipo</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($movimentacoes as $mov)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($mov->data_movimentacao)->format('d/m/Y') }}</td>
                    <td>{{ $mov->descricao }}</td>
                    <td>
                        @if ($mov->tipo == 'Entrada')
                            <span class="badge bg-success">Entrada</span>
                        @else
                            <span class="badge bg-danger">Saída</span>
                        @endif
                    </td>
                    <td class="{{ $mov->tipo == 'Entrada' ? 'text-success' : 'text-danger' }}">
                        {{ $mov->tipo == 'Entrada' ? '+' : '-' }} R$ {{ number_format($mov->valor, 2, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhuma movimentação encontrada para este período.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection