@extends('layouts.app')

@section('content')
    <h1>Extrato de Movimentação de Estoque</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $item->descricao }}</h5>
            <p class="card-text mb-0">
                <strong>Quantidade Atual:</strong> 
                <span class="fs-5">{{ $item->quantidade }}</span>
            </p>
            <p class="card-text">
                <strong>Estoque Mínimo:</strong> {{ $item->estoque_min }}
            </p>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Data</th>
                <th>Tipo</th>
                <th>Quantidade</th>
                <th>Detalhes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movimentacoes as $mov)
            <tr class="{{ $mov->tipo == 'Entrada' ? 'table-success' : ($mov->tipo == 'Uso em Consulta' ? 'table-danger' : '') }}">
                <td>{{ \Carbon\Carbon::parse($mov->data_mov)->format('d/m/Y H:i') }}</td>
                <td>
                    <span class="badge bg-{{ $mov->tipo == 'Entrada' ? 'success' : ($mov->tipo == 'Uso em Consulta' ? 'danger' : 'warning') }}">
                        {{ $mov->tipo }}
                    </span>
                </td>
                <td>{{ ($mov->tipo == 'Entrada' ? '+' : '-') . $mov->quantidade }}</td>
                <td>
                    @if($mov->tipo == 'Uso em Consulta')
                        Consulta de <a href="{{ route('consultas.show', $mov->consulta->id_consulta) }}">{{ $mov->consulta->paciente->nome }}</a>
                    @else
                        {{ $mov->justificativa }}
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Nenhuma movimentação encontrada para este item.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('estoque.index') }}" class="btn btn-secondary mt-3">Voltar para a Lista de Estoque</a>
@endsection