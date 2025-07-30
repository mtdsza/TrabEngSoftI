@extends('layouts.app')

@section('content')
    <h1>Editar Profissional: {{ $profissional->nome }}</h1>

    <form action="{{ route('profissionais.update', $profissional->id_profissional) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome', $profissional->nome) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $profissional->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="cro" class="form-label">CRO:</label>
            <input type="text" id="cro" name="cro" class="form-control" value="{{ old('cro', $profissional->cro) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" id="telefone" name="telefone" class="form-control" value="{{ old('telefone', $profissional->telefone) }}">
        </div>

        <div class="mb-3">
            <label for="salario_base" class="form-label">Salário Base (R$):</label>
            <input type="number" step="0.01" id="salario_base" name="salario_base" class="form-control" value="{{ old('salario_base', $profissional->salario_base) }}">
        </div>

        <div class="mb-3">
            <label for="especialidades" class="form-label">Especialidades (segure Ctrl para selecionar várias):</label>
            <select name="especialidades[]" id="especialidades" class="form-select" multiple>
                @foreach($especialidades as $especialidade)
                    <option value="{{ $especialidade->id_especialidade }}" 
                        @if($profissional->especialidades->contains($especialidade->id_especialidade)) selected @endif>
                        {{ $especialidade->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Profissional</button>
        <a href="{{ route('profissionais.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection

@push('scripts')
<script>
    const telefoneElement = document.getElementById('telefone');
    const telefoneMaskOptions = {
        mask: '(00) 00000-0000',
        lazy: false
    };
    const telefoneMask = IMask(telefoneElement, telefoneMaskOptions);
</script>
@endpush