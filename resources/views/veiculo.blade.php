@extends('layouts.main')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    {{-- --------- --}}
                    <div class="col-12 mt-5">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Veiculos</h5>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novoVeiculo">Novo Veiculo</button>
                                    </div>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Renavam</th>
                                                <th>Ano Fab./Ano Mod.</th>
                                                <th>Marca Modelo</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#00001</td>
                                                <td>00000000000</td>
                                                <td>2011/2012</td>
                                                <td>Fiat / Uno Way 1.0</td>
                                                <td>Ativo</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info">Alterar</button>
                                                        <button type="button" class="btn btn-warning">Desativar</button>
                                                        <button type="button" class="btn btn-danger">Excluir</button>
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
    <div class="modal fade" id="novoVeiculo" tabindex="-1" aria-labelledby="novoVeiculoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="novoVeiculoLabel">Novo Veiculo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12"><h2>Dados do Veiculo</h2></div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="renavam">Renavam</label>
                            <input type="text" class="form-control form-control-sm" name="renavam">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="plate_car">Placa</label>
                            <input type="text" class="form-control form-control-sm" name="plate_car">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="color_car">Cor do Veiculo</label>
                            <input type="text" class="form-control form-control-sm" name="color_car">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="year_fab_mod">Ano Fab./Ano Mod.</label>
                            <input type="text" class="form-control form-control-sm" name="year_fab_mod">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="brand_model">Marca/Modelo</label>
                            <input type="text" class="form-control form-control-sm" name="brand_model">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>
@endsection