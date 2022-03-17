<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Recibo da OS de {{explode(' ',$solicitacao->client->full_name)[0]}}</title>
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

{{-- <div>
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
</div> --}}

<div><h2>Valores</h2></div>
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