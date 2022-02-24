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
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>#{{\Str::padLeft($user->id, 6, '0')}}</td>
                                                    <td>{{$user->userData->razao_social}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->userData->address}}, {{$user->userData->home_number}} - {{$user->userData->address2}} - {{$user->userData->city}}/{{$user->userData->state}}</td>
                                                    <td class="status">
                                                        @if ($user->status == 1)
                                                            <span class="text-success">ATIVO</span>
                                                        @else
                                                            <span class="text-danger">INATIVO</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info btn-editar" data-href="{{route('buscaDadosGerais')}}" data-id="{{$user->id}}" data-table="user" data-target="#alteraDatas">Alterar</button>
                                                            <button type="button" class="btn @if($user->status == 1) btn-warning @else btn-success @endif btn-altera-status" data-status="{{$user->status}}" data-href="{{route('alteraStatus.post')}}" data-table="user" data-id="{{$user->id}}">@if($user->status == 1) Desativar @else Ativar @endif</button>
                                                            <button type="button" class="btn btn-danger btn-delete" data-href="{{route('destroyData.post')}}" data-table="user" data-id="{{$user->id}}">Excluir</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">{{$users->links()}}</div>
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
                    <form action="{{route('lojistas.post')}}" method="post">
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
                                <label for="">Nome Fantasia</label>
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
                    <h5 class="modal-title" id="alteraDatasLabel">Alterar Lojista</h5>
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