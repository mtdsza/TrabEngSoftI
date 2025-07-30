<?php

use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ProcedimentoController;
use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RelatorioFinanceiroController;
use App\Http\Controllers\ProcedimentoRealizadoController;
use App\Http\Controllers\FuncionarioController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('usuarios', UserController::class)->middleware('can:manage-users');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('pacientes', PacienteController::class);
    Route::resource('profissionais', ProfissionalController::class);
    Route::resource('procedimentos', ProcedimentoController::class);
    Route::resource('especialidades', EspecialidadeController::class);
    Route::resource('estoque', EstoqueController::class)->except(['show']);
    Route::resource('consultas', ConsultaController::class);
    Route::resource('orcamentos', OrcamentoController::class);

    Route::post('/consultas/{consulta}/salvar-prontuario', [ConsultaController::class, 'salvarProntuario'])->name('consultas.salvarProntuario');
    Route::post('/consultas/{consulta}/adicionar-material', [ConsultaController::class, 'adicionarMaterial'])->name('consultas.adicionarMaterial');
    Route::post('/orcamentos/{orcamento}/gerar-parcelas', [OrcamentoController::class, 'gerarParcelas'])->name('orcamentos.gerarParcelas');
    Route::post('/parcelas/{parcela}/pagar', [ParcelaController::class, 'pagar'])->name('parcelas.pagar');
    Route::get('/relatorio-financeiro', [RelatorioFinanceiroController::class, 'index'])->name('relatorios.financeiro');
    Route::get('/relatorio-financeiro/lancar-despesa', [RelatorioFinanceiroController::class, 'createDespesa'])->name('financeiro.createDespesa');
    Route::post('/relatorio-financeiro/lancar-despesa', [RelatorioFinanceiroController::class, 'storeDespesa'])->name('financeiro.storeDespesa');
    Route::get('/estoque/entrada', [\App\Http\Controllers\EstoqueController::class, 'createEntrada'])->name('estoque.createEntrada');
    Route::post('/estoque/entrada', [\App\Http\Controllers\EstoqueController::class, 'storeEntrada'])->name('estoque.storeEntrada');
    Route::post('/pacientes/{paciente}/salvar-historico', [PacienteController::class, 'salvarHistorico'])->name('pacientes.salvarHistorico');
    Route::post('/consultas/{consulta}/finalizar', [ConsultaController::class, 'finalizar'])->name('consultas.finalizar');
    Route::post('/consultas/{consulta}/realizar-procedimento', [ProcedimentoRealizadoController::class, 'store'])->name('procedimentos-realizados.store');
    Route::post('/procedimentos-realizados/{procedimentoRealizado}/anexar', [ProcedimentoRealizadoController::class, 'anexar'])->name('procedimentos-realizados.anexar');
    Route::get('/estoque/{estoque}/movimentacoes', [EstoqueController::class, 'movimentacoes'])->name('estoque.movimentacoes');
    Route::post('/profissionais/{profissional}/lancar-salario', [ProfissionalController::class, 'lancarSalario'])->name('profissionais.lancarSalario');
    Route::resource('funcionarios', FuncionarioController::class);
    Route::post('/funcionarios/{funcionario}/lancar-salario', [FuncionarioController::class, 'lancarSalario'])->name('funcionarios.lancarSalario');

});

require __DIR__.'/auth.php';