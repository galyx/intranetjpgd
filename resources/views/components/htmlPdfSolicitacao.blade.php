<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>OS de {{explode(' ',$solicitacao->client->full_name)[0]}}</title>
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
        <div><b>OS: {{\Str::padLeft($solicitacao->id, 6, '0')}}</b></div>
        <div><b>Data: {{date('d/m/Y', strtotime($solicitacao->created_at))}}</b></div>
    </div>

    <div>
        @if (isset($solicitacao->lojista->userData))
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
        @endif
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
                        <div>{{$solicitacao->veiculo->renavam}}</div>
                    </td>
                    <td>
                        <span>Placa:</span>
                        <div>{{$solicitacao->veiculo->plate_car}}</div>
                    </td>
                    <td>
                        <span>Cor do Veiculo:</span>
                        <div>{{$solicitacao->veiculo->color_car}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Ano Fab./Ano Mod.:</span>
                        <div>{{$solicitacao->veiculo->year_fab_mod}}</div>
                    </td>
                    <td>
                        <span>Marca/Modelo:</span>
                        <div>{{$solicitacao->veiculo->brand_model}}</div>
                    </td>
                    <td>
                        <span>Chassi:</span>
                        <div>{{$solicitacao->veiculo->chassi_car}}</div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <span>Aquisicao:</span>
                        <div>{{date('d/m/Y', strtotime($solicitacao->veiculo->created_at))}}</div>
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

    <footer></footer>
</body>
</html>

