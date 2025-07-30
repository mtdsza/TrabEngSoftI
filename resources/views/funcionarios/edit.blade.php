@extends('layouts.app')
@section('content')
<h1>Editar Funcionário</h1>
<form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome Completo</label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{ $funcionario->nome }}" required>
    </div>
    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" name="cpf" id="cpf" class="form-control" value="{{ $funcionario->cpf }}">
    </div>
    <div class="mb-3">
        <label for="cargo" class="form-label">Cargo</label>
        <input type="text" name="cargo" id="cargo" class="form-control" value="{{ $funcionario->cargo }}" required>
    </div>
    <div class="mb-3">
        <label for="data_contratacao" class="form-label">Data de Contratação</label>
        <input type="date" name="data_contratacao" id="data_contratacao" class="form-control" value="{{ $funcionario->data_contratacao }}" required>
    </div>
    <div class="mb-3">
        <label for="salario" class="form-label">Salário (R$)</label>
        <input type="number" step="0.01" name="salario" id="salario" class="form-control" value="{{ $funcionario->salario }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection

@push('scripts')
<script>
    const cpfElement = document.getElementById('cpf');
    const cpfMask = IMask(cpfElement, { mask: '000.000.000-00', lazy: false });
</script>
@endpush