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
                                <h5 class="card-title m-0">Clientes</h5>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novoCliente">Novo Cliente</button>
                                    </div>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nome</th>
                                                <th>Endereço</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clients as $client)
                                                <tr>
                                                    <td>#{{\Str::padLeft($client->id, 6, '0')}}</td>
                                                    <td>{{$client->full_name}}</td>
                                                    <td>{{$client->address}}, {{$client->home_number}} - {{$client->address2}} - {{$client->city}}/{{$client->state}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info btn-editar" data-href="{{route('buscaDadosGerais')}}" data-id="{{$client->id}}" data-table="client" data-target="#alteraDatas">Alterar</button>
                                                            <button type="button" class="btn btn-danger btn-delete" data-href="{{route('destroyData.post')}}" data-table="client" data-id="{{$client->id}}">Excluir</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">{{$clients->links()}}</div>
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
    <div class="modal fade" id="novoCliente" tabindex="-1" aria-labelledby="novoClienteLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="novoClienteLabel">Novo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('clientes.post')}}" method="post">
                        <div class="row">
                            @if (auth()->user()->permission == 10)
                                <div class="form-group col-12">
                                    <label for="">Lojista Relacionado</label>
                                    <select name="lojista_id" class="form-control form-control-sm">
                                        <option value="">Selecione um Lojista</option>
                                        @foreach (\App\Models\User::where('permission', 0)->where('status', 1)->get() as $user)
                                            <option value="{{$user->id}}">{{$user->userData->razao_social}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="lojista_id" value="{{auth()->user()->id}}">
                            @endif

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

                        <div class="mt-3"><h4>Anexos</h4></div>
                        <div class="row">
                            <div class="col-6 col-md-3 mb-2">
                                <button type="button" class="btn btn-primary btn-add-foto">+</button>
                                <input type="file" name="foto[]" class="d-none add-foto">
                                <div class="foto"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary btn-save">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="alteraDatas" tabindex="-1" aria-labelledby="alteraDatasLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alteraDatasLabel">Alterar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Carregando...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary btn-save">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>
@endsection