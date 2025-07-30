@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-7 mb-4">
            <div class="card shadow-sm">
                <div class="card-header fs-5">
                    Consultas Agendadas para Hoje
                </div>
                <div class="card-body text-center">
                    <p class="card-text fs-1 fw-bold">{{ $totalConsultasHoje }}</p>
                </div>
            </div>
            <div class="card shadow-sm mt-4">
                <div class="card-header fs-5">
                    Consultas do Dia
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($consultasHoje as $consulta)
                        <li class="list-group-item">
                            <strong>{{ \Carbon\Carbon::parse($consulta->data_inicio)->format('H:i') }}</strong> -
                            {{ $consulta->paciente->nome }}
                            <small class="text-muted"> (Dr(a). {{ explode(' ', $consulta->profissional->nome)[0] }})</small>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">Nenhuma consulta agendada para hoje.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-md-5 mb-4">
            <div class="card bg-warning text-dark shadow-sm">
                <div class="card-header fs-5">
                    Alerta de Estoque Baixo
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($itensEstoqueBaixo as $item)
                        <li class="list-group-item list-group-item-warning">
                            {{ $item->descricao }}
                            <strong class="d-block">Atual: {{ $item->quantidade }} | Mínimo: {{ $item->estoque_min }}</strong>
                        </li>
                    @empty
                        <li class="list-group-item text-center">Nenhum item com estoque baixo.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection