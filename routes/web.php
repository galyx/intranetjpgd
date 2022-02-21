<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeralController;

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

Route::get('/',[GeralController::class, 'solicitacoes'])->name('home');
Route::get('/solicitacoes',[GeralController::class, 'solicitacoes'])->name('solicitacoes');
Route::post('/solicitacoes-update',[GeralController::class, 'solicitacoesUpdate'])->name('solicitacoes.update');

Route::get('/nova-solicitacao',[GeralController::class, 'novaSolicitacao'])->name('nova-solicitacao');
Route::post('/nova-solicitacao-post',[GeralController::class, 'novaSolicitacaoPost'])->name('nova-solicitacao.post');

Route::get('/editar-solicitacao',[GeralController::class, 'editarSolicitacao'])->name('editar-solicitacao');
Route::post('/editar-solicitacao-post',[GeralController::class, 'editarSolicitacaoPost'])->name('editar-solicitacao.post');

Route::get('/lojistas',[GeralController::class, 'lojista'])->name('lojistas');
Route::post('/lojistas-post',[GeralController::class, 'lojistaPost'])->name('lojistas.post');

Route::get('/clientes',[GeralController::class, 'cliente'])->name('clientes');
Route::post('/clientes-post',[GeralController::class, 'clientePost'])->name('clientes.post');

Route::get('/veiculos',[GeralController::class, 'veiculo'])->name('veiculos');
Route::post('/veiculos-post',[GeralController::class, 'veiculoPost'])->name('veiculos.post');