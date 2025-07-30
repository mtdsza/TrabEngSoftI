@extends('layouts.app')
@section('content')
<h1>Cadastrar Novo Funcionário</h1>
<form action="{{ route('funcionarios.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome Completo</label>
        <input type="text" name="nome" id="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" name="cpf" id="cpf" class="form-control">
    </div>
    <div class="mb-3">
        <label for="cargo" class="form-label">Cargo</label>
        <input type="text" name="cargo" id="cargo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="data_contratacao" class="form-label">Data de Contratação</label>
        <input type="date" name="data_contratacao" id="data_contratacao" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="salario" class="form-label">Salário (R$)</label>
        <input type="number" step="0.01" name="salario" id="salario" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection

@push('scripts')
<script>
    const cpfElement = document.getElementById('cpf');
    const cpfMask = IMask(cpfElement, { mask: '000.000.000-00', lazy: false });
</script>
@endpush