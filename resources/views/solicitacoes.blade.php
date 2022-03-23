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
                                            @foreach ($solicitacoes as $solicitacao)
                                                <tr>
                                                    <td>#{{\Str::padLeft($solicitacao->id, 6, '0')}}</td>
                                                    <td>{{$solicitacao->lojista->userData->razao_social ?? 'Particular'}}</td>
                                                    <td>{{$solicitacao->client->full_name ?? ''}}</td>
                                                    <td>{{$solicitacao->veiculo->brand_model}}</td>
                                                    <td>{{date('d/m/Y', strtotime($solicitacao->created_at))}}</td>
                                                    <td>
                                                        @if ($solicitacao->status == '0')
                                                            <span class="text-warning">Analise</span>
                                                        @else
                                                            <span class="text-success">Finalizado</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info btn-editar" data-href="{{route('buscaDadosGerais')}}" data-id="{{$solicitacao->id}}" data-table="solicitacao" data-target="#conferirSolicitacao">Conferir</button>
                                                            <a href="{{route('editar-solicitacao', $solicitacao->id)}}" class="btn btn-primary">Editar</a>
                                                            @if (auth()->user()->permission == 10)
                                                                <button type="button" class="btn btn-danger btn-delete" data-table="solicitacao" data-href="{{route('destroyData.post')}}" data-id="{{$solicitacao->id}}" data-table="solicitacao" data-target="#conferirSolicitacao">Apagar</button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">{{$solicitacoes->links()}}</div>
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