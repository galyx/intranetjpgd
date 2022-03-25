@extends('layouts.main')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($veiculos as $veiculo)
                                                <tr>
                                                    <td>#{{\Str::padLeft($veiculo->id, 6, '0')}}</td>
                                                    <td>{{$veiculo->renavam}}</td>
                                                    <td>{{$veiculo->year_fab_mod}}</td>
                                                    <td>{{$veiculo->brand_model}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info btn-editar" data-href="{{route('buscaDadosGerais')}}" data-id="{{$veiculo->id}}" data-table="veiculo" data-target="#alteraDatas">Alterar</button>
                                                            <button type="button" class="btn btn-danger btn-delete" data-href="{{route('destroyData.post')}}" data-table="veiculo" data-id="{{$veiculo->id}}">Excluir</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">{{$veiculos->links()}}</div>
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
                    <form action="{{route('veiculos.post')}}" method="post">
                        <div class="row">
                            @if (auth()->user()->permission == 10)
                                <div class="form-group col-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="particular_new" name="particular" value="true">
                                        <label for="particular_new" class="form-check-label">Particular</label>
                                    </div>
                                </div>
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
                            <div class="form-group col-12 col-sm-4">
                                <label for="chassi_car">Chassi</label>
                                <input type="text" class="form-control form-control-sm text-uppercase" name="chassi_car">
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