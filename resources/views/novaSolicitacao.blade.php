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
                                <h5 class="card-title m-0">Nova Solicitação</h5>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <form action="#" method="post">
                                        <div class="row">
                                            <div class="form-group col-12"><h2>Dados do Cliente</h2></div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="type_document">Tipo Documento</label>
                                                <select name="type_document" class="form-control form-control-sm">
                                                    <option value="cpf">CPF</option>
                                                    <option value="cnpj">CNPJ</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="document_number">Numero Documento</label>
                                                <input type="text" class="form-control form-control-sm" name="document_number">
                                            </div>
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="full_name">Nome Completo</label>
                                                <input type="text" class="form-control form-control-sm" name="full_name">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="document_number_rg">RG</label>
                                                <input type="text" class="form-control form-control-sm" name="document_number_rg">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="phone1">Telefone/Celular - 1</label>
                                                <input type="text" class="form-control form-control-sm phone" name="phone1">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="phone2">Telefone/Celular - 2</label>
                                                <input type="text" class="form-control form-control-sm phone" name="phone2">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="phone3">Telefone/Celular - 3</label>
                                                <input type="text" class="form-control form-control-sm phone" name="phone3">
                                            </div>
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
                                        <div class="row">
                                            <div class="form-group col-12"><h2>Dados do Veiculo</h2></div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="renavam">Renavam</label>
                                                <input type="text" class="form-control form-control-sm" name="renavam">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="plate_car">Placa</label>
                                                <input type="text" class="form-control form-control-sm" name="plate_car">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="color_car">Cor do Veiculo</label>
                                                <input type="text" class="form-control form-control-sm" name="color_car">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="year_fab_mod">Ano Fab./Ano Mod.</label>
                                                <input type="text" class="form-control form-control-sm" name="year_fab_mod">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="brand_model">Marca/Modelo</label>
                                                <input type="text" class="form-control form-control-sm" name="brand_model">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="gravame">Aquisição de Veiculos com Gravame</label>
                                                <select name="gravame" class="form-control form-control-sm">
                                                    <option value="simples">Simples</option>
                                                    <option value="inclusao">Inclusão</option>
                                                    <option value="exclusao">Exclusão</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="purchase_change_address2">Compra com Troca de Município</label>
                                                <select name="purchase_change_address2" class="form-control form-control-sm">
                                                    <option value="simples">Simples</option>
                                                    <option value="inclusao">Inclusão</option>
                                                    <option value="exclusao">Exclusão</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
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
@endsection