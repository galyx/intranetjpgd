<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeralController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/cep-busca',[GeralController::class, 'cepBusca']);

Route::get('/artisan-fun', function(){
    $artisan = \Artisan::call('migrate');
    dd($artisan);
});

Route::middleware(['auth:web'])->group(function(){
    Route::get('/',[GeralController::class, 'solicitacoes'])->name('home');
    Route::get('/solicitacoes',[GeralController::class, 'solicitacoes'])->name('solicitacoes');
    Route::post('/solicitacoes-update',[GeralController::class, 'solicitacoesUpdate'])->name('solicitacoes.update');

    Route::get('/nova-solicitacao',[GeralController::class, 'novaSolicitacao'])->name('nova-solicitacao');
    Route::post('/nova-solicitacao-post',[GeralController::class, 'novaSolicitacaoPost'])->name('nova-solicitacao.post');

    Route::get('/editar-solicitacao/{id}',[GeralController::class, 'editarSolicitacao'])->name('editar-solicitacao');
    Route::post('/editar-solicitacao-post',[GeralController::class, 'editarSolicitacaoPost'])->name('editar-solicitacao.post');

    Route::get('/lojistas',[GeralController::class, 'lojista'])->name('lojistas');
    Route::post('/lojistas-post',[GeralController::class, 'lojistaPost'])->name('lojistas.post');

    Route::get('/clientes',[GeralController::class, 'cliente'])->name('clientes');
    Route::post('/clientes-post',[GeralController::class, 'clientePost'])->name('clientes.post');

    Route::get('/veiculos',[GeralController::class, 'veiculo'])->name('veiculos');
    Route::post('/veiculos-post',[GeralController::class, 'veiculoPost'])->name('veiculos.post');

    Route::post('/altera-status-post',[GeralController::class, 'alteraStatusPost'])->name('alteraStatus.post');
    Route::post('/delete-data-post',[GeralController::class, 'destroyDataPost'])->name('destroyData.post');
    Route::post('/busca-dados-gerais',[GeralController::class, 'buscaDadosGerais'])->name('buscaDadosGerais');

    Route::post('/busca-tabela-ui',[GeralController::class, 'buscaTabelaUi'])->name('buscaTabelaUi');
    Route::post('/busca-tabela-preechimento',[GeralController::class, 'buscaTabelaPreenchimento'])->name('buscaTabelaPreenchimento');
});

Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');
Route::get('/login',  [LoginController::class, 'index'])->name('login');
Route::post('/login',  [LoginController::class, 'login'])->name('login');