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
                                <h5 class="card-title m-0">Lojistas</h5>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novoLojista">Novo Lojista</button>
                                    </div>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Lojista</th>
                                                <th>Dono</th>
                                                <th>Endereço</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#00001</td>
                                                <td>Carrão Sul</td>
                                                <td>Amarildo</td>
                                                <td>Rua Jerico, 212 - Emiliano - Cutiba/PR</td>
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
    <div class="modal fade" id="novoLojista" tabindex="-1" aria-labelledby="novoLojistaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="novoLojistaLabel">Novo Lojista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12"><h2>Dados do Usuario</h2></div>
                        <div class="form-group col-12 col-sm-8">
                            <label for="">Nome Completo</label>
                            <input type="text" class="form-control form-control-sm" name="name">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">CPF</label>
                            <input type="text" class="form-control form-control-sm documento" name="cpf">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Email</label>
                            <input type="email" class="form-control form-control-sm" name="email">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Senha</label>
                            <input type="password" class="form-control form-control-sm" name="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12"><h2>Dados da Loja</h2></div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Razao Social</label>
                            <input type="text" class="form-control form-control-sm" name="razao_social">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">Nome Fantasi</label>
                            <input type="text" class="form-control form-control-sm" name="nome_fantasia">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="">CNPJ</label>
                            <input type="text" class="form-control form-control-sm documento" name="cnpj">
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label for="phone1">Telefone/Celular - 1</label>
                            <input type="text" class="form-control form-control-sm phone" name="phone1">
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label for="phone2">Telefone/Celular - 2</label>
                            <input type="text" class="form-control form-control-sm phone" name="phone2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-sm-3">
                            <label for="postal_code">CEP</label>
                            <input type="text" class="form-control form-control-sm" name="postal_code">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <label for="address">Rua/Endereço</label>
                            <input type="text" class="form-control form-control-sm" name="address">
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label for="home_number">Numero da Casa</label>
                            <input type="text" class="form-control form-control-sm" name="home_number">
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label for="address2">Bairro</label>
                            <input type="text" class="form-control form-control-sm" name="address2">
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label for="city">Cidade</label>
                            <input type="text" class="form-control form-control-sm" name="city">
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label for="state">Estado</label>
                            <input type="text" class="form-control form-control-sm" name="state">
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label for="complement">Complemento</label>
                            <input type="text" class="form-control form-control-sm" name="complement">
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