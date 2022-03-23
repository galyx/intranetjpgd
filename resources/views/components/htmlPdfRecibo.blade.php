<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Recibo da OS de {{explode(' ',$solicitacao->client->full_name)[0]}}</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }
        body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }
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
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            /* background-color: #03a9f4; */
            /* color: white; */
            text-align: center;
            line-height: 1.5cm;
        }
        header img {
            margin-top: 15px;
            width: 100px;
            /* height: 155px; */
        }
        /** Define the footer rules **/
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            /* background-color: #03a9f4; */
            /* color: white; */
            text-align: center;
            line-height: 1.5cm;
        }
    </style>
</head>
<body>
    <header>
        {{-- {{asset('imgs/Logo-jpg-branca.png')}} --}}
        <img src="data:image/svg+xml;base64,{{base64_encode(file_get_contents('imgs/Logo-jpg-preta-300x155.png'))}}" alt="">
    </header>

    <div style="margin-top: 10px;margin-bottom: 1px;">
        <div><b>Recibo da OS: {{\Str::padLeft($solicitacao->id, 6, '0')}}</b></div>
    </div>

    <div style="margin-top: 10px;margin-bottom: 20px;">
        Recebi de <b>{{$solicitacao->client->full_name}}</b>, <b><span style="text-transform: uppercase;">{{$solicitacao->client->type_document}}</span> nº {{$solicitacao->client->document_number}}</b> e
        endereço <b>{{$solicitacao->client->address}}</b>, número <b>{{$solicitacao->client->home_number}}</b>, bairro <b>{{$solicitacao->client->address2}}</b>, na cidade de
        <b>{{$solicitacao->client->city}}</b> - <b>{{$solicitacao->client->state}}</b>, CEP {{$solicitacao->client->postal_code}}, a quantia de <b>R$ {{number_format($solicitacao->valor_orcamento, 2, ',', '')}}</b> ( <b>{{$valor_extenso}}</b> )
        referente ao pagamento para compra do veículo que segue:
    </div>

    <div style="margin-bottom: 20px;">
        <div><b>Identificação do veículo:</b></div>
        <div>Marca/Modelo: <b>{{$solicitacao->veiculo->brand_model}}</b></div>
        <div>Ano de Fabricação/Modelo: <b>{{$solicitacao->veiculo->year_fab_mod}}</b></div>
        <div>Chassi: <b>{{$solicitacao->veiculo->chassi_car}}</b></div>
        <div>Cor predominante: <b>{{$solicitacao->veiculo->color_car}}</b></div>
        <div>Placas nº: <b>{{$solicitacao->veiculo->plate_car}}</b></div>
    </div>

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

    <div style="margin-top: 50px; text-align:center;">{{date('d/m/Y')}}</div>

    <footer></footer>
</body>
</html>
