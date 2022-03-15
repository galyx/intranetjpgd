<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>OS de {{explode(' ',$solicitacao->client->full_name)[0]}}</title>
<style>
    h2 {
        color: #0F3A49;
    }
    table tr td span {
        font-weight: bold;
    }
    table tr td, table tr th{
        border: 1px solid #000;
        padding: 3px 6px;
    }
</style>

<div>
    <div class="col-12 mb-2"><h2>Lojista</h2></div>
    <table width="100%">
        <tbody>
            <tr>
                <td>
                    <span>Loja:</span>
                    <div>{{$solicitacao->lojista->userData->razao_social}} - #{{\Str::padLeft($solicitacao->lojista_id, 6, '0')}}</div>
                </td>
                <td>
                    <span>Encarregado da Loja:</span>
                    <div class="border-bottom">{{$solicitacao->lojista->name}}</div>
                </td>
                <td>
                    <span>Endereço:</span>
                    <div class="border-bottom">{{$solicitacao->lojista->userData->address}}, {{$solicitacao->lojista->userData->home_number}} - {{$solicitacao->lojista->userData->address2}} - {{$solicitacao->lojista->userData->city}}/{{$solicitacao->lojista->userData->state}}</div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <div class="form-group col-12"><h2>Cliente</h2></div>
    <table width="100%">
        <tbody>
            <tr>
                <td>
                    <span>Documento <span style="text-transform: uppercase;">{{$solicitacao->client->type_document}}</span>:</span>
                    <div class="border-bottom">{{$solicitacao->client->document_number}}</div>
                </td>
                <td>
                    <span>Nome:</span>
                    <div class="border-bottom">{{$solicitacao->client->full_name}}</div>
                </td>
                <td>
                    <span>Document RG:</span>
                    <div class="border-bottom">{{$solicitacao->client->document_number_rg}}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Telefone/Celular:</span>
                    <div class="border-bottom">{{$solicitacao->client->phone1}}/{{$solicitacao->client->phone2}}/{{$solicitacao->client->phone3}}</div>
                </td>
                <td>
                    <span>Endereço:</span>
                    <div class="border-bottom">{{$solicitacao->client->address}}, {{$solicitacao->client->home_number}} - {{$solicitacao->client->address2}} - {{$solicitacao->client->city}}/{{$solicitacao->client->state}}</div>
                </td>
                <td>
                    <span>Complemento:</span>
                    <div class="border-bottom">{{$solicitacao->client->complement}}</div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <div class="form-group col-12"><h2>Veiculo</h2></div>
    <table width="100%">
        <tbody>
            <tr>
                <td>
                    <span>Renavam:</span>
                    <div class="border-bottom">{{$solicitacao->veiculo->renavam}}</div>
                </td>
                <td>
                    <span>Placa:</span>
                    <div class="border-bottom">{{$solicitacao->veiculo->plate_car}}</div>
                </td>
                <td>
                    <span>Cor do Veiculo:</span>
                    <div class="border-bottom">{{$solicitacao->veiculo->color_car}}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Ano Fab./Ano Mod.:</span>
                    <div class="border-bottom">{{$solicitacao->veiculo->year_fab_mod}}</div>
                </td>
                <td>
                    <span>Marca/Modelo:</span>
                    <div class="border-bottom">{{$solicitacao->veiculo->brand_model}}</div>
                </td>
                <td>
                    <span>Aquisição de Veiculos com Gravame:</span>
                    <div class="border-bottom" style="text-transform: capitalize;">{{$solicitacao->gravame}}</div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <span>Compra com Troca de Município:</span>
                    <div class="border-bottom" style="text-transform: capitalize;">{{$solicitacao->purchase_change_address2}}</div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <h4>Observações do Lojista</h4>
    <div>{{$solicitacao->observacao}}</div>
</div>

<div>
    <h4>Observações do Despachante</h6>
    <div>{{$solicitacao->observacao}}</div>
</div>

<div><h2>Orçamento</h2></div>
<table width="100%">
    <thead>
        <tr>
            <th>Item</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($solicitacao->orcamentos as $orcamento)
            <tr>
                <td class="form-group col-6">
                    {{$orcamento->item_name}}
                </td>
                <td class="form-group col-4">
                    R$ {{number_format($orcamento->item_value, 2, ',', '')}}
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Total:</th>
            <th>R$ {{number_format($solicitacao->valor_orcamento, 2, ',', '')}}</th>
        </tr>
    </tfoot>
</table>