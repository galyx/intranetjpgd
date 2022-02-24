@extends('layouts.main')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Editar Solicitação</h5>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <form action="{{route('editar-solicitacao.post')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="solicitacao_id" value="{{$solicitacao->id}}">
                                            <input type="hidden" name="lojista_id" value="{{$solicitacao->lojista_id}}">
                                            <input type="hidden" name="client_id" value="{{$solicitacao->client_id}}">
                                            <input type="hidden" name="veiculo_id" value="{{$solicitacao->veiculo_id}}">

                                            <div class="form-group col-12"><h2>Dados do Cliente</h2></div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="type_document">Tipo Documento</label>
                                                <select name="type_document" class="form-control form-control-sm">
                                                    <option value="cpf" {{$solicitacao->client->type_document == 'cpf' ? 'selected' : ''}}>CPF</option>
                                                    <option value="cnpj" {{$solicitacao->client->type_document == 'cnpj' ? 'selected' : ''}}>CNPJ</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="document_number">Numero Documento</label>
                                                <input type="text" class="form-control form-control-sm" value="{{$solicitacao->client->document_number}}" data-autocomplete="true" data-auto_preenchimento="sim" data-tabela="client" name="document_number">
                                            </div>
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="full_name">Nome Completo</label>
                                                <input type="text" class="form-control form-control-sm" name="full_name" value="{{$solicitacao->client->full_name}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="document_number_rg">RG</label>
                                                <input type="text" class="form-control form-control-sm" name="document_number_rg" value="{{$solicitacao->client->document_number_rg}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="phone1">Telefone/Celular - 1</label>
                                                <input type="text" class="form-control form-control-sm phone" name="phone1" value="{{$solicitacao->client->phone1}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="phone2">Telefone/Celular - 2</label>
                                                <input type="text" class="form-control form-control-sm phone" name="phone2" value="{{$solicitacao->client->phone2}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="phone3">Telefone/Celular - 3</label>
                                                <input type="text" class="form-control form-control-sm phone" name="phone3" value="{{$solicitacao->client->phone3}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="postal_code">CEP</label>
                                                <input type="text" class="form-control form-control-sm" name="postal_code" value="{{$solicitacao->client->postal_code}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="address">Rua/Endereço</label>
                                                <input type="text" class="form-control form-control-sm" name="address" value="{{$solicitacao->client->address}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="home_number">Numero da Casa</label>
                                                <input type="text" class="form-control form-control-sm" name="home_number" value="{{$solicitacao->client->home_number}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="address2">Bairro</label>
                                                <input type="text" class="form-control form-control-sm" name="address2" value="{{$solicitacao->client->address2}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="city">Cidade</label>
                                                <input type="text" class="form-control form-control-sm" name="city" value="{{$solicitacao->client->city}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="state">Estado</label>
                                                <input type="text" class="form-control form-control-sm" name="state" value="{{$solicitacao->client->state}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="complement">Complemento</label>
                                                <input type="text" class="form-control form-control-sm" name="complement" value="{{$solicitacao->client->complement}}">
                                            </div>
                                        </div>
                                        <div class="mt-3"><h4>Anexos do Cliente</h4></div>
                                        <div class="row border-bottom mb-2">
                                            @isset($solicitacao->client->fotos)
                                                @foreach ($solicitacao->client->fotos as $foto)
                                                    <div class="col-6 col-md-3 mb-2">
                                                        <div class="checkbox justify-content-start mb-3">
                                                            <input class="me-2" type="checkbox" name="excluir_client_foto[]" value="{{$foto->id}}" />
                                                            <label for="">Excluir Foto?</label>
                                                        </div>
                                                        <div class="foto">
                                                            @php
                                                                $ext_icon = [
                                                                    'pdf' => '<i class="fa-solid fa-file-pdf"></i>',
                                                                    'doc' => '<i class="fa-solid fa-file-lines"></i>',
                                                                    'docx' => '<i class="fa-solid fa-file-lines"></i>',
                                                                    'csv' => '<i class="fa-solid fa-file-csv"></i>',
                                                                    'xlsx' => '<i class="fa-solid fa-file-excel"></i>',
                                                                    'xls' => '<i class="fa-solid fa-file-excel"></i>',
                                                                ];
                                                                $ext = explode('.', $foto->name);
                                                                $ext = $ext[count($ext) - 1];
                                                            @endphp
                                                            @if (array_key_exists($ext, $ext_icon))
                                                                <a href="{{$foto->link}}" target="_blank" title="{{$foto->name}}" style="width: 100px;height: 100px;margin-top: 10px">{!!$ext_icon[$ext]!!}</a>
                                                            @else
                                                                <a href="{{$foto->link}}" target="_blank" title="{{$foto->name}}"><div style="
                                                                    background-image: url({{$foto->link}});
                                                                    width: 100px;
                                                                    height: 100px;
                                                                    background-repeat: no-repeat;
                                                                    background-position: center;
                                                                    background-size: contain;
                                                                    margin-top: 10px;"></div></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endisset
                                            <div class="col-6 col-md-3 mb-2">
                                                <button type="button" class="btn btn-primary btn-add-foto">+</button>
                                                <input type="file" name="client_foto[]" class="d-none add-foto">
                                                <div class="foto"></div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12"><h2>Dados do Veiculo</h2></div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="renavam">Renavam</label>
                                                <input type="text" class="form-control form-control-sm" value="{{$solicitacao->veiculo->renavam}}" data-autocomplete="true" data-auto_preenchimento="sim" data-tabela="veiculo" name="renavam">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="plate_car">Placa</label>
                                                <input type="text" class="form-control form-control-sm" name="plate_car" value="{{$solicitacao->veiculo->plate_car}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="color_car">Cor do Veiculo</label>
                                                <input type="text" class="form-control form-control-sm" name="color_car" value="{{$solicitacao->veiculo->color_car}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="year_fab_mod">Ano Fab./Ano Mod.</label>
                                                <input type="text" class="form-control form-control-sm" name="year_fab_mod" value="{{$solicitacao->veiculo->year_fab_mod}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="brand_model">Marca/Modelo</label>
                                                <input type="text" class="form-control form-control-sm" name="brand_model" value="{{$solicitacao->veiculo->brand_model}}">
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="gravame">Aquisição de Veiculos com Gravame</label>
                                                <select name="gravame" class="form-control form-control-sm">
                                                    <option value="simples" @if($solicitacao->gravame == 'simples') selected @endif>Simples</option>
                                                    <option value="inclusao" @if($solicitacao->gravame == 'inclusao') selected @endif>Inclusão</option>
                                                    <option value="exclusao" @if($solicitacao->gravame == 'exclusao') selected @endif>Exclusão</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12 col-sm-3">
                                                <label for="purchase_change_address2">Compra com Troca de Município</label>
                                                <select name="purchase_change_address2" class="form-control form-control-sm">
                                                    <option value="simples" @if($solicitacao->purchase_change_address2 == 'simples') selected @endif>Simples</option>
                                                    <option value="inclusao" @if($solicitacao->purchase_change_address2 == 'inclusao') selected @endif>Inclusão</option>
                                                    <option value="exclusao" @if($solicitacao->purchase_change_address2 == 'exclusao') selected @endif>Exclusão</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="">Informações Adicionais (opcional)</label>
                                                <textarea name="observacao" class="form-control">{{$solicitacao->observacao}}</textarea>
                                            </div>
                                        </div>

                                        <div class="mt-3"><h4>Anexos do Veiculo</h4></div>
                                        <div class="row">
                                            @isset($solicitacao->veiculo->fotos)
                                                @foreach ($solicitacao->veiculo->fotos as $foto)
                                                    <div class="col-6 col-md-3 mb-2">
                                                        <div class="checkbox justify-content-start mb-3">
                                                            <input class="me-2" type="checkbox" name="excluir_veiculo_foto[]" value="{{$foto->id}}" />
                                                            <label for="">Excluir Foto?</label>
                                                        </div>
                                                        <div class="foto">
                                                            @php
                                                                $ext_icon = [
                                                                    'pdf' => '<i class="fa-solid fa-file-pdf"></i>',
                                                                    'doc' => '<i class="fa-solid fa-file-lines"></i>',
                                                                    'docx' => '<i class="fa-solid fa-file-lines"></i>',
                                                                    'csv' => '<i class="fa-solid fa-file-csv"></i>',
                                                                    'xlsx' => '<i class="fa-solid fa-file-excel"></i>',
                                                                    'xls' => '<i class="fa-solid fa-file-excel"></i>',
                                                                ];
                                                                $ext = explode('.', $foto->name);
                                                                $ext = $ext[count($ext) - 1];
                                                            @endphp
                                                            @if (array_key_exists($ext, $ext_icon))
                                                                <a href="{{$foto->link}}" target="_blank" title="{{$foto->name}}" style="width: 100px;height: 100px;margin-top: 10px">{!!$ext_icon[$ext]!!}</a>
                                                            @else
                                                                <a href="{{$foto->link}}" target="_blank" title="{{$foto->name}}"><div style="
                                                                    background-image: url({{$foto->link}});
                                                                    width: 100px;
                                                                    height: 100px;
                                                                    background-repeat: no-repeat;
                                                                    background-position: center;
                                                                    background-size: contain;
                                                                    margin-top: 10px;"></div></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endisset
                                            <div class="col-6 col-md-3 mb-2">
                                                <button type="button" class="btn btn-primary btn-add-foto">+</button>
                                                <input type="file" name="veiculo_foto[]" class="d-none add-foto">
                                                <div class="foto"></div>
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