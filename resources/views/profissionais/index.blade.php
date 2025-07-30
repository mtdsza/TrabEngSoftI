@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista de Profissionais</h1>
        <a href="{{ route('profissionais.create') }}" class="btn btn-success">Cadastrar Novo Profissional</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CRO</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($profissionais as $profissional)
                <tr>
                    <td>{{ $profissional->id_profissional }}</td>
                    <td>{{ $profissional->nome }}</td>
                    <td>{{ $profissional->cro }}</td>
                    <td>{{ $profissional->email }}</td>
                    <td>
                        <a href="{{ route('profissionais.edit', $profissional->id_profissional) }}" class="btn btn-primary btn-sm">Editar</a>
                        
                        @if($profissional->salario_base > 0)
                        <form action="{{ route('profissionais.lancarSalario', $profissional->id_profissional) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Confirmar lançamento do pagamento de R$ {{ number_format($profissional->salario_base, 2, ',', '.') }}?')">Pagar Salário</button>
                        </form>
                        @endif

                        <form action="{{ route('profissionais.destroy', $profissional->id_profissional) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhum profissional encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection