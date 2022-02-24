<form action="{{route('solicitacoes.update')}}" method="post">
    <input type="hidden" name="solicitacao_id" value="{{$solicitacao->id}}">
    <div class="row">
        <div class="col-12 mb-2"><h2>Lojista</h2></div>
        <div class="col-12 col-sm-6 py-2 px-1">
            <span>Loja:</span>
            <div class="border-bottom">{{$solicitacao->lojista->userData->razao_social}} - #{{\Str::padLeft($solicitacao->lojista_id, 6, '0')}}</div>
        </div>
        <div class="col-12 col-sm-6 py-2 px-1">
            <span>Encarregado da Loja:</span>
            <div class="border-bottom">{{$solicitacao->lojista->name}}</div>
        </div>
        <div class="col-12 col-sm-12 py-2 px-1">
            <span>Endereço:</span>
            <div class="border-bottom">{{$solicitacao->lojista->userData->address}}, {{$solicitacao->lojista->userData->home_number}} - {{$solicitacao->lojista->userData->address2}} - {{$solicitacao->lojista->userData->city}}/{{$solicitacao->lojista->userData->state}}</div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="form-group col-12"><h2>Cliente</h2></div>
        <div class="col-12 col-sm-3 py-2 px-1">
            <span>Documento <span style="text-transform: uppercase;">{{$solicitacao->client->type_document}}</span>:</span>
            <div class="border-bottom">{{$solicitacao->client->document_number}}</div>
        </div>
        <div class="col-12 col-sm-6 py-2 px-1">
            <span>Nome:</span>
            <div class="border-bottom">{{$solicitacao->client->full_name}}</div>
        </div>
        <div class="col-12 col-sm-3 py-2 px-1">
            <span>Document RG:</span>
            <div class="border-bottom">{{$solicitacao->client->document_number_rg}}</div>
        </div>
        <div class="col-12 col-sm-6 py-2 px-1">
            <span>Telefone/Celular:</span>
            <div class="border-bottom">{{$solicitacao->client->phone1}}/{{$solicitacao->client->phone2}}/{{$solicitacao->client->phone3}}</div>
        </div>
        <div class="col-12 col-sm-6 py-2 px-1">
            <span>Endereço:</span>
            <div class="border-bottom">{{$solicitacao->client->address}}, {{$solicitacao->client->home_number}} - {{$solicitacao->client->address2}} - {{$solicitacao->client->city}}/{{$solicitacao->client->state}}</div>
        </div>
        <div class="col-12 col-sm-3 py-2 px-1">
            <span>Complemento:</span>
            <div class="border-bottom">{{$solicitacao->client->complement}}</div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="form-group col-12"><h2>Veiculo</h2></div>
        <div class="col-12 col-sm-4 py-2 px-1">
            <span>Renavam:</span>
            <div class="border-bottom">{{$solicitacao->veiculo->renavam}}</div>
        </div>
        <div class="col-12 col-sm-4 py-2 px-1">
            <span>Placa:</span>
            <div class="border-bottom">{{$solicitacao->veiculo->plate_car}}</div>
        </div>
        <div class="col-12 col-sm-4 py-2 px-1">
            <span>Cor do Veiculo:</span>
            <div class="border-bottom">{{$solicitacao->veiculo->color_car}}</div>
        </div>
        <div class="col-12 col-sm-4 py-2 px-1">
            <span>Ano Fab./Ano Mod.:</span>
            <div class="border-bottom">{{$solicitacao->veiculo->year_fab_mod}}</div>
        </div>
        <div class="col-12 col-sm-4 py-2 px-1">
            <span>Marca/Modelo:</span>
            <div class="border-bottom">{{$solicitacao->veiculo->brand_model}}</div>
        </div>
        <div class="col-12 col-sm-6 py-2 px-1">
            <span>Aquisição de Veiculos com Gravame:</span>
            <div class="border-bottom" style="text-transform: capitalize;">{{$solicitacao->gravame}}</div>
        </div>
        <div class="col-12 col-sm-6 py-2 px-1">
            <span>Compra com Troca de Município:</span>
            <div class="border-bottom" style="text-transform: capitalize;">{{$solicitacao->purchase_change_address2}}</div>
        </div>
    </div>
    <div class="mt-3">
        <h6>Observações do Lojista</h6>
        <div>{{$solicitacao->observacao}}</div>
    </div>
    @if (auth()->user()->permission == 10)
        <div class="mt-3"><h4>Anexos</h4></div>
        <div class="row">
            @isset($solicitacao->documentImages)
                @foreach ($solicitacao->documentImages as $document)
                    <div class="col-6 col-md-3 mb-2">
                        <div class="checkbox justify-content-start mb-3">
                            <input class="me-2" type="checkbox" name="excluir_document[]" value="{{$document->id}}" />
                            <label for="">Excluir Documento?</label>
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
                                $ext = explode('.', $document->name);
                                $ext = $ext[count($ext) - 1];
                            @endphp
                            @if (array_key_exists($ext, $ext_icon))
                                <a href="{{$document->link}}" target="_blank" title="{{$document->name}}" style="width: 100px;height: 100px;margin-top: 10px">{!!$ext_icon[$ext]!!}</a>
                            @else
                                <a href="{{$document->link}}" target="_blank" title="{{$document->name}}"><div style="
                                    background-image: url({{$document->link}});
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
                <input type="file" name="document[]" class="d-none add-foto">
                <div class="foto"></div>
            </div>
        </div>
        <div class="mt-3">
            <label for="">Observações adicionais (opcional)</label>
            <textarea name="despachante_observacao" class="form-control">{{$solicitacao->despachante_observacao}}</textarea>
        </div>

        <div class="card mt-3 card-campo">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12"><h2>Informações Faltantes ou Incorretas</h2></div>
                    <div class="form-group col-6">Campo</div>
                    <div class="form-group col-4">Motivo</div>
                    <div class="form-group col-2">Ação</div>
                </div>
                <div>
                    @foreach ($solicitacao->missingInfos as $missing_info)
                        <div class="row item">
                            <div class="form-group col-6">
                                <input type="text" class="form-control form-control-sm" name="missing_infos_create[{{$missing_info->id}}][]" value="{{$missing_info->field}}">
                            </div>
                            <div class="form-group col-4">
                                <input type="text" class="form-control form-control-sm" name="missing_infos_create[{{$missing_info->id}}][]" value="{{$missing_info->reason}}">
                            </div>
                            <div class="form-group col-2">
                                <input type="checkbox" name="missing_infos_create[{{$missing_info->id}}][]" id="resolvido_missing_info" value="true">
                                <label for="resolvido_missing_info">Resolvido?</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="missings">
                    <div class="row item">
                        <div class="form-group col-6">
                            <input type="text" class="form-control form-control-sm" name="missing_infos[]">
                        </div>
                        <div class="form-group col-4">
                            <input type="text" class="form-control form-control-sm" name="missing_infos[]">
                        </div>
                        <div class="form-group col-2">
                            <button type="button" class="btn btn-sm btn-block btn-danger btn-remove-itens"><i class="fa-solid fa-times"></i></button>
                        </div>
                    </div>
                </div>
                <div><button type="button" class="btn btn-sm btn-primary btn-add-missings">Adicionar Campo</button></div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12"><h2>Orçamento</h2></div>
                    <div class="form-group col-6">Item</div>
                    <div class="form-group col-4">Valor</div>
                    <div class="form-group col-2">Ação</div>
                </div>
                <div>
                    @foreach ($solicitacao->orcamentos as $orcamento)
                        <div class="row item">
                            <div class="form-group col-6">
                                <input type="text" class="form-control form-control-sm" name="itens_create[{{$orcamento->id}}][]" value="{{$orcamento->item_name}}">
                            </div>
                            <div class="form-group col-4">
                                <input type="text" class="form-control form-control-sm real valor-item" name="itens_create[{{$orcamento->id}}][]" value="{{number_format($orcamento->item_value, 2, ',', '')}}">
                            </div>
                            <div class="form-group col-2">
                                <button type="button" class="btn btn-sm btn-block btn-danger btn-remove-itens"><i class="fa-solid fa-times"></i></button>
                            </div>
                        </div>
                    @endforeach
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
                        <span class="valor-total">R$ {{number_format($solicitacao->valor_orcamento, 2, ',', '')}}</span>
                    </div>
                </div>
                <div><button type="button" class="btn btn-sm btn-primary btn-add-itens">Adicionar Item</button></div>
            </div>
        </div>
    @else
        <div class="mt-3">
            <h6>Observações do Despachante</h6>
            <div>{{$solicitacao->observacao}}</div>
        </div>

        <div class="row">
            <div class="form-group col-12"><h2>Informações Faltantes ou Incorretas</h2></div>
            <div class="form-group col-6">Campo</div>
            <div class="form-group col-4">Motivo</div>
            <div class="form-group col-2">Ação</div>
        </div>
        <div>
            @foreach ($solicitacao->missingInfos as $missing_info)
                <div class="row item">
                    <div class="form-group col-6">
                        <input type="text" class="form-control form-control-sm" value="{{$missing_info->field}}" readonly>
                    </div>
                    <div class="form-group col-4">
                        <input type="text" class="form-control form-control-sm" value="{{$missing_info->reason}}" readonly>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-3">
            <div class="form-group col-12"><h2>Orçamento</h2></div>
            <div class="form-group col-6">Item</div>
            <div class="form-group col-4">Valor</div>
        </div>
        @foreach ($solicitacao->orcamentos as $orcamento)
            <div class="row item">
                <div class="form-group col-6">
                    <input type="text" class="form-control form-control-sm" value="{{$orcamento->item_name}}" readonly>
                </div>
                <div class="form-group col-4">
                    <input type="text" class="form-control form-control-sm real valor-item" value="{{number_format($orcamento->item_value, 2, ',', '')}}" readonly>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="form-group col-8">Total:</div>
            <div class="form-group col-4">
                <input type="hidden" name="total_value">
                <span class="valor-total">R$ {{number_format($solicitacao->valor_orcamento, 2, ',', '')}}</span>
            </div>
        </div>
    @endif
</form>