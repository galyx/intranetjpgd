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
                                    <form action="" method="GET">
                                        <div class="row mb-2">
                                            @if (auth()->user()->permission == 10)
                                                <div class="form-group col-12 col-sm-3">
                                                    <label for="">Filtrar por Lojista</label>
                                                    <select name="lojista_id" class="form-control form-control-sm">
                                                        <option value="todos" @isset($request->lojista_id) @if($request->lojista_id == 'todos') selected @endif @endisset>Todos</option>
                                                        <option value="0" @isset($request->lojista_id) @if($request->lojista_id == '0') selected @endif @endisset>Particular</option>
                                                        @foreach ($lojistas as $lojista)
                                                            <option value="{{$lojista->id}}" @isset($request->lojista_id) @if($request->lojista_id == $lojista->id) selected @endif @endisset>{{$lojista->userData->razao_social}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-12 col-sm-3 d-flex">
                                                    <div class="mt-auto">
                                                        <button type="submit" class="btn btn-sm btn-info">Filtrar</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                    <div class="row mb-2">
                                        <div class="form-group col-12 col-sm-3">
                                            <button type="button" class="btn btn-primary btn-block btn-soma-os" disabled>Somar OS</button>
                                        </div>
                                    </div>

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-link active" id="nav-analise-tab" data-toggle="tab" href="#nav-analise" role="tab" aria-controls="nav-analise" aria-selected="true">Em Analise ({{$solicitacoes_analise_count}})</a>
                                            <a class="nav-link" id="nav-finalizada-tab" data-toggle="tab" href="#nav-finalizada" role="tab" aria-controls="nav-finalizada" aria-selected="false">Finalizadas ({{$solicitacoes_finalizada_count}})</a>
                                            @if (auth()->user()->permission == 10)
                                                <a class="nav-link" id="nav-arquivada-tab" data-toggle="tab" href="#nav-arquivada" role="tab" aria-controls="nav-arquivada" aria-selected="false">Arquivadas ({{$solicitacoes_arquivada_count}})</a>
                                            @endif
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-analise" role="tabpanel" aria-labelledby="nav-analise-tab">
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
                                                    @foreach ($solicitacoes_analise as $solicitacao)
                                                        <tr>
                                                            <td>
                                                                @if ($solicitacao->lojista_id == 0)
                                                                    #{{\Str::padLeft($solicitacao->id, 6, '0')}}
                                                                @else
                                                                    <div class="form-check">
                                                                        <input type="checkbox" id="os-{{$solicitacao->id}}" class="form-check-input check-os" data-os_id="{{$solicitacao->id}}" data-os_lojista_id="{{$solicitacao->lojista_id}}">
                                                                        <label for="os-{{$solicitacao->id}}" class="form-check-label">#{{\Str::padLeft($solicitacao->id, 6, '0')}}</label>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>{{$solicitacao->lojista->userData->razao_social ?? 'Particular'}}</td>
                                                            <td>{{$solicitacao->client->full_name ?? ''}}</td>
                                                            <td>{{$solicitacao->veiculo->brand_model}}</td>
                                                            <td>{{date('d/m/Y', strtotime($solicitacao->created_at))}}</td>
                                                            <td>
                                                                <span class="text-warning">Analise</span>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-info btn-editar" data-href="{{route('buscaDadosGerais')}}" data-id="{{$solicitacao->id}}" data-table="solicitacao" data-target="#conferirSolicitacao">Conferir</button>
                                                                    @if (auth()->user()->permission == 10)
                                                                        <a href="{{route('editar-solicitacao', $solicitacao->id)}}" class="btn btn-primary">Editar</a>
                                                                        <button type="button" class="btn btn-warning btn-arquivar" data-table="solicitacao_arquivar" data-href="{{route('alteraStatus.post')}}" data-id="{{$solicitacao->id}}">Arquivar</button>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="mt-3">{{$solicitacoes_analise->links()}}</div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-finalizada" role="tabpanel" aria-labelledby="nav-finalizada-tab">
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
                                                    @foreach ($solicitacoes_finalizada as $solicitacao)
                                                        <tr>
                                                            <td>
                                                                @if ($solicitacao->lojista_id == 0)
                                                                    #{{\Str::padLeft($solicitacao->id, 6, '0')}}
                                                                @else
                                                                    <div class="form-check">
                                                                        <input type="checkbox" id="os-{{$solicitacao->id}}" class="form-check-input check-os" data-os_id="{{$solicitacao->id}}" data-os_lojista_id="{{$solicitacao->lojista_id}}">
                                                                        <label for="os-{{$solicitacao->id}}" class="form-check-label">#{{\Str::padLeft($solicitacao->id, 6, '0')}}</label>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>{{$solicitacao->lojista->userData->razao_social ?? 'Particular'}}</td>
                                                            <td>{{$solicitacao->client->full_name ?? ''}}</td>
                                                            <td>{{$solicitacao->veiculo->brand_model}}</td>
                                                            <td>{{date('d/m/Y', strtotime($solicitacao->created_at))}}</td>
                                                            <td>
                                                                    <span class="text-success">Finalizado</span>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-info btn-editar" data-href="{{route('buscaDadosGerais')}}" data-id="{{$solicitacao->id}}" data-table="solicitacao" data-target="#conferirSolicitacao">Conferir</button>
                                                                    @if (auth()->user()->permission == 10)
                                                                        <a href="{{route('editar-solicitacao', $solicitacao->id)}}" class="btn btn-primary">Editar</a>
                                                                        <button type="button" class="btn btn-warning btn-arquivar" data-table="solicitacao_arquivar" data-href="{{route('alteraStatus.post')}}" data-id="{{$solicitacao->id}}">Arquivar</button>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="mt-3">{{$solicitacoes_finalizada->links()}}</div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-arquivada" role="tabpanel" aria-labelledby="nav-arquivada-tab">
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
                                                    @foreach ($solicitacoes_arquivada as $solicitacao)
                                                        <tr>
                                                            <td>
                                                                @if ($solicitacao->lojista_id == 0)
                                                                    #{{\Str::padLeft($solicitacao->id, 6, '0')}}
                                                                @else
                                                                    <div class="form-check">
                                                                        <input type="checkbox" id="os-{{$solicitacao->id}}" class="form-check-input check-os" data-os_id="{{$solicitacao->id}}" data-os_lojista_id="{{$solicitacao->lojista_id}}">
                                                                        <label for="os-{{$solicitacao->id}}" class="form-check-label">#{{\Str::padLeft($solicitacao->id, 6, '0')}}</label>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>{{$solicitacao->lojista->userData->razao_social ?? 'Particular'}}</td>
                                                            <td>{{$solicitacao->client->full_name ?? ''}}</td>
                                                            <td>{{$solicitacao->veiculo->brand_model}}</td>
                                                            <td>{{date('d/m/Y', strtotime($solicitacao->created_at))}}</td>
                                                            <td>
                                                                    <span class="text-danger">Arquivado</span>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-info btn-editar" data-href="{{route('buscaDadosGerais')}}" data-id="{{$solicitacao->id}}" data-table="solicitacao" data-target="#conferirSolicitacao">Conferir</button>
                                                                    @if (auth()->user()->permission == 10)
                                                                        <a href="{{route('editar-solicitacao', $solicitacao->id)}}" class="btn btn-primary">Editar</a>
                                                                        <button type="button" class="btn btn-warning btn-desarquivar" data-table="solicitacao_desarquivar" data-href="{{route('alteraStatus.post')}}" data-id="{{$solicitacao->id}}">Desarquivar</button>
                                                                        <button type="button" class="btn btn-danger btn-delete" data-table="solicitacao" data-href="{{route('destroyData.post')}}" data-id="{{$solicitacao->id}}" data-table="solicitacao" data-target="#conferirSolicitacao">Apagar</button>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="mt-3">{{$solicitacoes_arquivada->links()}}</div>
                                        </div>
                                    </div>
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
                    Carregando...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    @if (auth()->user()->permission == 10)
                        <a href="{{route('imprimirOS')}}" class="btn btn-info btn-href">Imprimir OS</a>
                        <a href="{{route('imprimirReciboOS')}}" class="btn btn-info btn-href">Gerar Recibo da OS</a>
                        <button type="button" class="btn btn-success btn-finalizar-solicitacao" data-href="{{route('solicitacaoFinalizar')}}">Finalizar Solicitação</button>
                        <button type="button" class="btn btn-primary btn-save">Salvar Alterações</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('change', '.check-os', function(){
                var isValid = true;
                $('.check-os').each(function(){
                    if($(this).prop('checked')) isValid = false;
                });
                $('.btn-soma-os').prop('disabled', isValid);
            });
            $(document).on('click', '.btn-soma-os', function(){
                var os = [];
                $('.check-os').each(function(){
                    if(typeof os[$(this).data('os_lojista_id')] == 'undefined') os[$(this).data('os_lojista_id')] = [];
                    if($(this).prop('checked')){
                        os[$(this).data('os_lojista_id')].push({lojista_id: $(this).data('os_lojista_id'), os_id: $(this).data('os_id')});
                    }
                });

                Swal.fire({
                    icon: 'info',
                    title: 'Somar os Serviços da OS?',
                    input: 'checkbox',
                    inputPlaceholder: 'Enviar uma copia aos Lojistas?',
                    showCancelButton: true,
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não',
                }).then((result)=>{
                    if(result.isConfirmed){
                        Swal.fire({
                            title: 'Gerando documentos, aguarde...',
                            allowOutsideClick: false,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        window.open(`{{asset('gerar-documento-soma-servicos-os/${btoa(JSON.stringify(os))}')}}`,'_blank');

                        if(result.value == 1){
                            $.ajax({
                                url: `{{route('enviaLojistaDocumentoSOS')}}`,
                                type: 'POST',
                                data: {os},
                                async: false,
                                success: (data) => {
                                    // console.log(data);
                                }
                            });
                        }

                        setTimeout(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Documentos gerados com sucesso!',
                            });
                        }, 1200);
                    }
                });
            });
        });
    </script>
@endsection