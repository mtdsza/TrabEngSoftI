@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Funcionários</h1>
        <a href="{{ route('funcionarios.create') }}" class="btn btn-success">Novo Funcionário</a>
    </div>

    @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if (session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Cargo</th>
                <th>CPF</th>
                <th>Salário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($funcionarios as $funcionario)
                <tr>
                    <td>{{ $funcionario->nome }}</td>
                    <td>{{ $funcionario->cargo }}</td>
                    <td>{{ $funcionario->cpf }}</td>
                    <td>R$ {{ number_format($funcionario->salario, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('funcionarios.edit', $funcionario->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        
                        <form action="{{ route('funcionarios.lancarSalario', $funcionario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Confirmar lançamento do pagamento de R$ {{ number_format($funcionario->salario, 2, ',', '.') }}?')">Pagar Salário</button>
                        </form>

                        <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhum funcionário cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection