<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>OS Somadas</title>
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
        h2, h4 {
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
        <div><b>OSs: {{$solicitacoes->map(function($query){return \Str::padLeft($query->id, 6, '0');})->join(' - ')}}</b></div>
    </div>

    <div>
        @if (isset($solicitacoes[0]->lojista->userData))
            <div class="col-12 mb-2"><h2>Lojista</h2></div>
            <table width="100%">
                <tbody>
                    <tr>
                        <td>
                            <span>Loja:</span>
                            <div>{{$solicitacoes[0]->lojista->userData->razao_social}} - #{{\Str::padLeft($solicitacoes[0]->lojista_id, 6, '0')}}</div>
                        </td>
                        <td>
                            <span>Encarregado da Loja:</span>
                            <div class="border-bottom">{{$solicitacoes[0]->lojista->name}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span>Endereço:</span>
                            <div class="border-bottom">{{$solicitacoes[0]->lojista->userData->address}}, {{$solicitacoes[0]->lojista->userData->home_number}} - {{$solicitacoes[0]->lojista->userData->address2}} - {{$solicitacoes[0]->lojista->userData->city}}/{{$solicitacoes[0]->lojista->userData->state}}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>

    <div><h2>Serviços</h2></div>

    @foreach ($solicitacoes as $solicitacao)
        <div style="margin-bottom: 20px;">
            <div><h4>OS - {{\Str::padLeft($solicitacao->id, 6, '0')}}</h4></div>
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
        </div>
    @endforeach

    <div>
        <div><h2>Total das OS</h2></div>
        <table width="100%">
            <tbody>
                @foreach ($solicitacoes as $solicitacao)
                <tr>
                    <td class="form-group col-6">
                        OS - {{\Str::padLeft($solicitacao->id, 6, '0')}}
                    </td>
                    <td class="form-group col-4">
                        R$ {{number_format($solicitacao->valor_orcamento, 2, ',', '')}}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total:</th>
                    <th>R$ {{number_format($solicitacoes->map(function($query){return $query->valor_orcamento;})->sum(), 2, ',', '')}}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <footer></footer>
</body>
</html>

