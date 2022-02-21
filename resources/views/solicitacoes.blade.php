@extends('layouts.main')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Solicitações</h5>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Lojista</th>
                                                <th>Cliente</th>
                                                <th>Veiculo</th>
                                                <th>Data</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#00001</td>
                                                <td>Carrão Sul</td>
                                                <td>João da Silva</td>
                                                <td>Fiat Uno Way</td>
                                                <td>16/02/2022</td>
                                                <td>Analise</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#conferirSolicitacao">Conferir</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="conferirSolicitacao" tabindex="-1" aria-labelledby="conferirSolicitacaoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="conferirSolicitacaoLabel">Solicitação do Lojista <b><span class="_lojista"></span></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2"><h2>Lojista</h2></div>
                        <div class="col-12 col-sm-6 py-2 px-1">
                            <span>Loja:</span>
                            <div class="border-bottom">Carrão sul - #00001</div>
                        </div>
                        <div class="col-12 col-sm-6 py-2 px-1">
                            <span>Encarregado da Loja:</span>
                            <div class="border-bottom">Amarildo</div>
                        </div>
                        <div class="col-12 col-sm-12 py-2 px-1">
                            <span>Endereço:</span>
                            <div class="border-bottom">Rua Jerico, 212 - Emiliano - Cutiba/PR</div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12"><h2>Cliente</h2></div>
                        <div class="col-12 col-sm-3 py-2 px-1">
                            <span>Documento CPF:</span>
                            <div class="border-bottom">000.000.000-00</div>
                        </div>
                        <div class="col-12 col-sm-6 py-2 px-1">
                            <span>Nome:</span>
                            <div class="border-bottom">João da Silva</div>
                        </div>
                        <div class="col-12 col-sm-3 py-2 px-1">
                            <span>Document RG:</span>
                            <div class="border-bottom">00000000</div>
                        </div>
                        <div class="col-12 col-sm-6 py-2 px-1">
                            <span>Telefone/Celular:</span>
                            <div class="border-bottom">(00) 99999-9999/(00) 99999-9999/(00) 3333-3333</div>
                        </div>
                        <div class="col-12 col-sm-6 py-2 px-1">
                            <span>Endereço:</span>
                            <div class="border-bottom">Rua Jerico, 212 - Emiliano - Cutiba/PR - 80000-000</div>
                        </div>
                        <div class="col-12 col-sm-3 py-2 px-1">
                            <span>Complemento:</span>
                            <div class="border-bottom">Casa 002</div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12"><h2>Veiculo</h2></div>
                        <div class="col-12 col-sm-4 py-2 px-1">
                            <span>Renavam:</span>
                            <div class="border-bottom">00000000000</div>
                        </div>
                        <div class="col-12 col-sm-4 py-2 px-1">
                            <span>Placa:</span>
                            <div class="border-bottom">AAA-0A00</div>
                        </div>
                        <div class="col-12 col-sm-4 py-2 px-1">
                            <span>Cor do Veiculo:</span>
                            <div class="border-bottom">Verde Claro</div>
                        </div>
                        <div class="col-12 col-sm-4 py-2 px-1">
                            <span>Ano Fab./Ano Mod.:</span>
                            <div class="border-bottom">2011/2012</div>
                        </div>
                        <div class="col-12 col-sm-4 py-2 px-1">
                            <span>Marca/Modelo:</span>
                            <div class="border-bottom">Fiat / Uno Way 1.0</div>
                        </div>
                        <div class="col-12 col-sm-6 py-2 px-1">
                            <span>Aquisição de Veiculos com Gravame:</span>
                            <div class="border-bottom">Simples</div>
                        </div>
                        <div class="col-12 col-sm-6 py-2 px-1">
                            <span>Compra com Troca de Município:</span>
                            <div class="border-bottom">Simples</div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12"><h2>Orçamento</h2></div>
                        <div class="form-group col-6">Item</div>
                        <div class="form-group col-4">Valor</div>
                        <div class="form-group col-2">Ação</div>
                    </div>
                    <div id="itens">
                        <div class="row item">
                            <div class="form-group col-6">
                                <input type="text" class="form-control form-control-sm" name="itens[]">
                            </div>
                            <div class="form-group col-4">
                                <input type="text" class="form-control form-control-sm real valor-item" name="itens[]">
                            </div>
                            <div class="form-group col-2">
                                <button type="button" class="btn btn-sm btn-block btn-danger btn-remove-itens"><i class="fa-solid fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-8">Total:</div>
                        <div class="form-group col-4">
                            <input type="hidden" name="total_value">
                            <span class="valor-total">R$ 0,00</span>
                        </div>
                    </div>
                    <div><button type="button" class="btn btn-sm btn-primary btn-add-itens">Adicionar Item</button></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success">Finalizar Solicitação</button>
                    <button type="button" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>
@endsection