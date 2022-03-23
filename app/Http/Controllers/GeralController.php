<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Veiculo;
use App\Models\UserData;
use Barryvdh\DomPDF\PDF;
use App\Models\Orcamento;
use App\Models\ClientFoto;
use App\Mail\ShippingInfos;
use App\Models\MissingInfo;
use App\Models\Solicitacao;
use App\Models\VeiculoFoto;
use Illuminate\Http\Request;
use App\Models\DocumentImage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use WGenial\NumeroPorExtenso\NumeroPorExtenso;

class GeralController extends Controller
{
    public function cepBusca(Request $request)
    {
        $cep = Http::get('https://viacep.com.br/ws/'.$request->cep.'/json')->object();
        return response()->json($cep);
    }

    public function solicitacoes()
    {
        $solicitacoes = new Solicitacao();
        if(auth()->user()->permission == 0) $solicitacoes = $solicitacoes->where('lojista_id', auth()->user()->id);
        $solicitacoes = $solicitacoes->paginate(20);
        return view('solicitacoes', get_defined_vars());
    }

    public function solicitacoesUpdate(Request $request)
    {
        \Log::info($request->all());
        $solicitacao_update['despachante_observacao'] = $request->despachante_observacao;
        if(isset($request->total_value))$solicitacao_update['valor_orcamento'] = $request->total_value;
        Solicitacao::find($request->solicitacao_id)->update($solicitacao_update);

        if(isset($request->itens)){
            foreach(array_chunk($request->itens,2) as $item){
                if($item[0]){
                    Orcamento::create([
                        'solicitacao_id' => $request->solicitacao_id,
                        'item_name' => $item[0],
                        'item_value' => str_replace(['.',','],['','.'], $item[1]),
                    ]);
                }
            }
        }

        if(isset($request->itens_create)){
            $itens_key = [];
            foreach($request->itens_create as $item_key => $item_create){
                $itens_key[] = $item_key;
                Orcamento::find($item_key)->update([
                    'item_name' => $item_create[0],
                    'item_value' => str_replace(['.',','],['','.'], $item_create[1]),
                ]);
            }
            if(count($itens_key) > 0){
                Orcamento::where('solicitacao_id', $request->solicitacao_id)->whereNotIn('id',$itens_key)->delete();
            }
        }

        if(isset($request->missing_infos)){
            foreach(array_chunk($request->missing_infos,2) as $missing_info){
                if($missing_info[0]){
                    MissingInfo::create([
                        'solicitacao_id' => $request->solicitacao_id,
                        'field' => $missing_info[0],
                        'reason' => $missing_info[1],
                    ]);
                }
            }
        }

        if(isset($request->missing_infos_create)){
            $itens_key = [];
            foreach($request->missing_infos_create as $missing_infos_key => $missing_infos_create){
                if(isset($missing_infos_create[2])){
                    MissingInfo::find($missing_infos_key)->delete();
                }else{
                    MissingInfo::find($missing_infos_key)->update([
                        'field' => $missing_infos_create[0],
                        'reason' => $missing_infos_create[1],
                    ]);
                }
            }
        }

        if(isset($request->document)){
            foreach($request->document as $document){
                $save_foto = Storage::disk('public')->put('solicitacao_'.$request->solicitacao_id, $document);
                $fotos_create['solicitacao_id'] = $request->solicitacao_id;
                $fotos_create['name'] = $document->getClientOriginalName();
                $fotos_create['path'] = $save_foto;
                $fotos_create['link'] = asset('storage/'.$save_foto);
                DocumentImage::create($fotos_create);
            }
        }

        if(isset($request->excluir_document)) {
            foreach($request->excluir_document as $excluir_document){
                $document = DocumentImage::find($excluir_document);
                Storage::delete('public/'.$document->path);

                $document->delete();
            }
        }

        if(isset(Solicitacao::find($request->solicitacao_id)->lojista->email)){
            Mail::to(Solicitacao::find($request->solicitacao_id)->lojista->email)->send(new ShippingInfos('Caro lojista, informamos que a atualizações na sua solicitação criada! #'.\Str::padLeft($request->solicitacao_id, 6, '0')));
        }

        return response()->json(['success', 'redirect', route('solicitacoes')], 200);
    }

    public function novaSolicitacao()
    {
        // dd(collect(session()->get('_old_input'))->forget('_token'));
        return view('novaSolicitacao');
    }

    public function novaSolicitacaoPost(Request $request)
    {
        $rules = [
            'document_number' => 'required|string',
            'full_name' => 'required|string',
            'phone1' => 'required|string',
            'postal_code' => 'required|string',
            'address' => 'required|string',
            'home_number' => 'required|string',
            'address2' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'renavam' => 'required|string',
            'plate_car' => 'required|string',
            'color_car' => 'required|string',
            'year_fab_mod' => 'required|string',
            'brand_model' => 'required|string',
        ];

        $customMessages = [
            'document_number.required' => 'O campo Documento é obrigatório!',
            'full_name.required' => 'O campo Nome Completo é obrigatório!',
            'phone1.required' => 'O campo Telefone/Celular 1 é obrigatório!',
            'postal_code.required' => 'O campo CEP é obrigatório!',
            'address.required' => 'O campo Rua/Endereço é obrigatório!',
            'home_number.required' => 'O campo Numero é obrigatório!',
            'address2.required' => 'O campo Bairro é obrigatório!',
            'city.required' => 'O campo Cidade é obrigatório!',
            'state.required' => 'O campo Estado é obrigatório!',
            'renavam.required' => 'O campo Renavam é obrigatório!',
            'plate_car.required' => 'O campo Placa é obrigatório!',
            'color_car.required' => 'O campo Cor do Veiculo é obrigatório!',
            'year_fab_mod.required' => 'O campo Ano Fab./Ano Mod. é obrigatório!',
            'brand_model.required' => 'O campo Marca/Modelo é obrigatório!',
        ];

        $this->validate($request, $rules, $customMessages);

        $client_id = $this->saveClient($request);
        $veiculo_id = $this->saveVeiculo($request);
        $solicitacao = Solicitacao::create([
            'lojista_id' => isset($request->particular) ? 0 : $request->lojista_id,
            'particular' => isset($request->particular) ? 1 : 0,
            'client_id' => $client_id,
            'veiculo_id' => $veiculo_id,
            'observacao' => $request->observacao,
            'descricao_servicos' => $request->descricao_servicos,
        ]);

        if(isset(User::find($request->lojista_id)->userData->razao_social)){
            Mail::to('zednetinformatica@gmail.com')->send(new ShippingInfos('Informamos que o Lojista '.User::find($request->lojista_id)->userData->razao_social.' abriu uma solicitação! #'.\Str::padLeft($solicitacao->id, 6, '0')));
        }
        return redirect()->route('solicitacoes')->with('success', 'Sua solicitação foi enviada com successo!');
    }

    public function editarSolicitacao($id)
    {
        $solicitacao = Solicitacao::with('lojista', 'client', 'veiculo')->find($id);
        return view('editarSolicitacao', get_defined_vars());
    }

    public function editarSolicitacaoPost(Request $request)
    {
        $rules = [
            'document_number' => 'required|string',
            'full_name' => 'required|string',
            'phone1' => 'required|string',
            'postal_code' => 'required|string',
            'address' => 'required|string',
            'home_number' => 'required|string',
            'address2' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'renavam' => 'required|string',
            'plate_car' => 'required|string',
            'color_car' => 'required|string',
            'year_fab_mod' => 'required|string',
            'brand_model' => 'required|string',
        ];

        $customMessages = [
            'document_number.required' => 'O campo Documento é obrigatório!',
            'full_name.required' => 'O campo Nome Completo é obrigatório!',
            'phone1.required' => 'O campo Telefone/Celular 1 é obrigatório!',
            'postal_code.required' => 'O campo CEP é obrigatório!',
            'address.required' => 'O campo Rua/Endereço é obrigatório!',
            'home_number.required' => 'O campo Numero é obrigatório!',
            'address2.required' => 'O campo Bairro é obrigatório!',
            'city.required' => 'O campo Cidade é obrigatório!',
            'state.required' => 'O campo Estado é obrigatório!',
            'renavam.required' => 'O campo Renavam é obrigatório!',
            'plate_car.required' => 'O campo Placa é obrigatório!',
            'color_car.required' => 'O campo Cor do Veiculo é obrigatório!',
            'year_fab_mod.required' => 'O campo Ano Fab./Ano Mod. é obrigatório!',
            'brand_model.required' => 'O campo Marca/Modelo é obrigatório!',
        ];

        $this->validate($request, $rules, $customMessages);

        $client_id = $this->saveClient($request);
        $veiculo_id = $this->saveVeiculo($request);
        Solicitacao::find($request->solicitacao_id)->update([
            'observacao' => $request->observacao,
            'descricao_servicos' => $request->descricao_servicos,
        ]);
        Mail::to('zednetinformatica@gmail.com')->send(new ShippingInfos('Informamos que que o Lojista '.User::find($request->lojista_id)->userData->razao_social.' fez uma atualização nas informações da solicitação criada! #'.\Str::padLeft($request->solicitacao_id, 6, '0')));
        return redirect()->route('solicitacoes')->with('success', 'Sua solicitação foi atualizada com successo!');
    }

    public function solicitacaoFinalizar(Request $request)
    {
        Solicitacao::find($request->os_id)->update(['status' => 1]);
        return response()->json(route('imprimirOS', $request->os_id));
    }

    public function lojista()
    {
        $users = User::with(['userData'])->where('permission', 0)->paginate('20');
        return view('lojista', get_defined_vars());
    }

    public function lojistaPost(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'cpf' => 'required|string',
            'razao_social' => 'required|string',
            'cnpj' => 'required|string',
            'phone1' => 'required|string',
            'postal_code' => 'required|string',
            'address' => 'required|string',
            'home_number' => 'required|string',
            'address2' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
        ];

        if(isset($request->user_id)) {
            $rules['email'] = 'unique:users,email,'.$request->user_id;
        }else{
            $rules['email'] = 'required|string|email|unique:users';
        }
        if(!isset($request->user_id)) $rules['password'] = 'required|string|min:8';

        $customMessages = [
            'name.required' => 'O campo Nome é obrigatório!',
            'cpf.required' => 'O campo CPF é obrigatório!',
            'email.required' => 'O campo Email é obrigatório!',
            'email.unique' => 'Já existe um Email desse registrado!',
            'razao_social.required' => 'O campo Razão Social é obrigatório!',
            'cnpj.required' => 'O campo CNPJ é obrigatório!',
            'phone1.required' => 'O campo Telefone/Celular 1 é obrigatório!',
            'postal_code.required' => 'O campo CEP é obrigatório!',
            'address.required' => 'O campo Rua/Endereço é obrigatório!',
            'home_number.required' => 'O campo Numero é obrigatório!',
            'address2.required' => 'O campo Bairro é obrigatório!',
            'city.required' => 'O campo Cidade é obrigatório!',
            'state.required' => 'O campo Estado é obrigatório!',
        ];

        if(!isset($request->user_id)) $customMessages['password.required'] = 'O campo Senha é Obrigatório!';

        $this->validate($request, $rules, $customMessages);

        $user_create['name'] = $request->name;
        $user_create['email'] = $request->email;
        if(isset($request->user_id)){
            if(!empty($request->password)) $user_create['password'] = Hash::make($request->password);
        }else{
            $user_create['password'] = Hash::make($request->password);
        }
        $user_create['document'] = $request->cpf;

        if(isset($request->user_id)){
            $user = User::find($request->user_id)->update($user_create);
        }else{
            $user = User::create($user_create);
        }

        $user_data_create['user_id'] = $user->id ?? $request->user_id;
        $user_data_create['razao_social'] = $request->razao_social;
        $user_data_create['nome_fantasia'] = $request->nome_fantasia;
        $user_data_create['cnpj'] = $request->cnpj;
        $user_data_create['phone1'] = $request->phone1;
        $user_data_create['phone2'] = $request->phone2;
        $user_data_create['postal_code'] = $request->postal_code;
        $user_data_create['address'] = $request->address;
        $user_data_create['home_number'] = $request->home_number;
        $user_data_create['address2'] = $request->address2;
        $user_data_create['city'] = $request->city;
        $user_data_create['state'] = $request->state;
        $user_data_create['complement'] = $request->complement;

        if(isset($request->user_id)){
            UserData::where('user_id', $request->user_id)->update($user_data_create);
        }else{
            UserData::create($user_data_create);
        }

        return response()->json(['success', 'redirect', route('lojistas')], 200);
    }

    public function cliente()
    {
        $clients = Client::with('fotos');
        if(auth()->user()->permission == 0) $clients = $clients->where('lojista_id', auth()->user()->id);
        $clients = $clients->paginate(20);
        return view('cliente', get_defined_vars());
    }

    public function clientePost(Request $request)
    {
        $rules = [
            'document_number' => 'required|string',
            'full_name' => 'required|string',
            'phone1' => 'required|string',
            'postal_code' => 'required|string',
            'address' => 'required|string',
            'home_number' => 'required|string',
            'address2' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
        ];

        $customMessages = [
            'document_number.required' => 'O campo Documento é obrigatório!',
            'full_name.required' => 'O campo Nome Completo é obrigatório!',
            'phone1.required' => 'O campo Telefone/Celular 1 é obrigatório!',
            'postal_code.required' => 'O campo CEP é obrigatório!',
            'address.required' => 'O campo Rua/Endereço é obrigatório!',
            'home_number.required' => 'O campo Numero é obrigatório!',
            'address2.required' => 'O campo Bairro é obrigatório!',
            'city.required' => 'O campo Cidade é obrigatório!',
            'state.required' => 'O campo Estado é obrigatório!',
        ];

        $this->validate($request, $rules, $customMessages);

        $this->saveClient($request);

        return response()->json(['success', 'redirect', route('clientes')], 200);
    }

    public function veiculo()
    {
        $veiculos = Veiculo::with('fotos');
        if(auth()->user()->permission == 0) $veiculos = $veiculos->where('lojista_id', auth()->user()->id);
        $veiculos = $veiculos->paginate(20);
        return view('veiculo', get_defined_vars());
    }

    public function veiculoPost(Request $request)
    {
        $rules = [
            'renavam' => 'required|string',
            'plate_car' => 'required|string',
            'color_car' => 'required|string',
            'year_fab_mod' => 'required|string',
            'brand_model' => 'required|string',
            'chassi_car' => 'required|string',
        ];

        $customMessages = [
            'renavam.required' => 'O campo Renavam é obrigatório!',
            'plate_car.required' => 'O campo Placa é obrigatório!',
            'color_car.required' => 'O campo Cor do Veiculo 1 é obrigatório!',
            'year_fab_mod.required' => 'O campo Ano Fab./Ano Mod. é obrigatório!',
            'brand_model.required' => 'O campo Marca é obrigatório!',
            'chassi_car.required' => 'O campo Chassi é obrigatório!',
        ];

        $this->validate($request, $rules, $customMessages);

        $this->saveVeiculo($request);

        return response()->json(['success', 'redirect', route('veiculos')], 200);
    }

    public function alteraStatusPost(Request $request)
    {
        switch($request->table){
            case 'user':
                User::find($request->id)->update(['status' => $request->status]);
                break;
        }

        return response()->json('',200);
    }

    public function destroyDataPost(Request $request)
    {
        switch($request->table){
            case 'user':
                User::find($request->id)->delete();
                UserData::where('user_id', $request->id)->delete();
                break;
            case 'client':
                Client::find($request->id)->delete();
                Storage::deleteDirectory('public/client_'.$request->id);
                ClientFoto::where('client_id', $request->id)->delete();
                break;
            case 'veiculo':
                Veiculo::find($request->id)->delete();
                Storage::deleteDirectory('public/veiculo_'.$request->id);
                VeiculoFoto::where('veiculo_id', $request->id)->delete();
                break;
            case 'solicitacao':
                Solicitacao::find($request->id)->delete();
                Orcamento::where('solicitacao_id', $request->id)->delete();
                MissingInfo::where('solicitacao_id', $request->id)->delete();
                foreach(DocumentImage::where('solicitacao_id', $request->id)->get() as $excluir_document){
                    Storage::delete('public/'.$excluir_document->path);
                    DocumentImage::find($excluir_document->id)->delete();
                }
                break;
        }

        return response()->json('',200);
    }

    public function buscaDadosGerais(Request $request)
    {
        switch($request->table){
            case 'user':
                $user = User::with('userData')->find($request->id);
                $return = view('components.modalLojista', get_defined_vars())->render();
                $data = $user;
                break;
            case 'client':
                $client = Client::with('fotos')->find($request->id);
                $return = view('components.modalClient', get_defined_vars())->render();
                $data = $client;
                break;
            case 'veiculo':
                $veiculo = Veiculo::with('fotos')->find($request->id);
                $return = view('components.modalVeiculo', get_defined_vars())->render();
                $data = $veiculo;
                break;
            case 'solicitacao':
                $solicitacao = Solicitacao::with('lojista', 'client', 'veiculo')->find($request->id);
                $return = view('components.modalConferiSolicitacao', get_defined_vars())->render();
                $data = $solicitacao;
                break;
        }

        return response()->json(['view' => $return, 'data' => $data],200);
    }

    public function buscaTabelaUi(Request $request)
    {
        switch($request->tabela){
            case 'client':
                $data = Client::where('document_number', 'LIKE', '%'.$request->nome.'%');
                if(auth()->user()->permission == 0) $data = $data->where('lojista_id', auth()->user()->id);
                $data = $data->get()->map(function ($query){return $query->document_number;});
                break;
            case 'veiculo':
                $data = Veiculo::where('renavam', 'LIKE', '%'.$request->nome.'%');
                if(auth()->user()->permission == 0) $data = $data->where('lojista_id', auth()->user()->id);
                $data = $data->get()->map(function ($query){return $query->renavam;});
                break;
        }

        return response()->json($data,200);
    }

    public function buscaTabelaPreenchimento(Request $request)
    {
        switch($request->tabela){
            case 'client':
                $data = Client::with('fotos')->where('document_number', $request->id);
                if(auth()->user()->permission == 0) $data = $data->where('lojista_id', auth()->user()->id);
                $data = $data->first();
                break;
            case 'veiculo':
                $data = Veiculo::with('fotos')->where('renavam', $request->id);
                if(auth()->user()->permission == 0) $data = $data->where('lojista_id', auth()->user()->id);
                $data = $data->first();
                break;
        }

        return response()->json($data,200);
    }

    // ------------------------------
    public function imprimirOS($id)
    {
        $solicitacao = Solicitacao::find($id);
        $html_solicitacao = view('components.htmlPdfSolicitacao', get_defined_vars())->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html_solicitacao);
        return $pdf->stream('OS-'.\Str::padLeft($id, 6, '0').'.pdf');
    }
    // ------------------------------
    public function imprimirReciboOS($id)
    {
        $extenso = new NumeroPorExtenso;
        $solicitacao = Solicitacao::find($id);
        $valor_extenso = $extenso->converter($solicitacao->valor_orcamento);
        $html_solicitacao = view('components.htmlPdfRecibo', get_defined_vars())->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html_solicitacao);
        return $pdf->stream('Recibo-OS-'.\Str::padLeft($id, 6, '0').'.pdf');
    }

    // ------------------------------
    public function saveClient($request)
    {
        if(isset($request->client_foto)) $request->foto = $request->client_foto;
        $client_create['lojista_id'] = isset($request->particular) ? 0 : $request->lojista_id;
        $client_create['particular'] = isset($request->particular) ? 1 : 0;
        $client_create['type_document'] = $request->type_document;
        $client_create['document_number'] = $request->document_number;
        $client_create['full_name'] = $request->full_name;
        $client_create['document_number_rg'] = $request->document_number_rg;
        $client_create['phone1'] = $request->phone1;
        $client_create['phone2'] = $request->phone2;
        $client_create['phone3'] = $request->phone3;
        $client_create['postal_code'] = $request->postal_code;
        $client_create['address'] = $request->address;
        $client_create['home_number'] = $request->home_number;
        $client_create['address2'] = $request->address2;
        $client_create['city'] = $request->city;
        $client_create['state'] = $request->state;
        $client_create['complement'] = $request->complement;

        if(isset($request->client_id)){
            $client = Client::find($request->client_id)->update($client_create);
        }else{
            if(Client::where('lojista_id', $request->lojista_id)->where('document_number', $request->document_number)->get()->count() > 0){
                Client::where('lojista_id', $request->lojista_id)->where('document_number', $request->document_number)->update($client_create);
                $client = Client::where('lojista_id', $request->lojista_id)->where('document_number', $request->document_number)->first();
            }else{
                $client = Client::create($client_create);
            }
        }

        $client_id = $request->client_id ?? $client->id;

        $originalPath = storage_path('app/public/client_'.$client_id.'/');
        if (!file_exists($originalPath)) {
            mkdir($originalPath, 0777, true);
        }

        if(isset($request->foto)){
            foreach($request->foto as $foto){
                $save_foto = Storage::disk('public')->put('client_'.$client_id, $foto);
                $fotos_create['client_id'] = $client_id;
                $fotos_create['name'] = $foto->getClientOriginalName();
                $fotos_create['path'] = $save_foto;
                $fotos_create['link'] = asset('storage/'.$save_foto);
                ClientFoto::create($fotos_create);
            }
        }

        if(isset($request->excluir_foto)) {
            foreach($request->excluir_foto as $excluir_foto){
                $foto = ClientFoto::find($excluir_foto);
                Storage::delete('public/'.$foto->path);

                $foto->delete();
            }
        }
        if(isset($request->excluir_client_foto)) {
            foreach($request->excluir_client_foto as $excluir_client_foto){
                $foto = ClientFoto::find($excluir_client_foto);
                Storage::delete('public/'.$foto->path);

                $foto->delete();
            }
        }

        return $client_id;
    }

    public function saveVeiculo($request)
    {
        if(isset($request->veiculo_foto)) $request->foto = $request->veiculo_foto;
        $veiculo_create['lojista_id'] = isset($request->particular) ? 0 : $request->lojista_id;
        $veiculo_create['particular'] = isset($request->particular) ? 1 : 0;
        $veiculo_create['renavam'] = $request->renavam;
        $veiculo_create['plate_car'] = $request->plate_car;
        $veiculo_create['color_car'] = $request->color_car;
        $veiculo_create['year_fab_mod'] = $request->year_fab_mod;
        $veiculo_create['brand_model'] = $request->brand_model;
        $veiculo_create['chassi_car'] = $request->chassi_car;

        if(isset($request->veiculo_id)){
            $veiculo = Veiculo::find($request->veiculo_id)->update($veiculo_create);
        }else{
            if(Veiculo::where('lojista_id', $request->lojista_id)->where('renavam', $request->renavam)->get()->count() > 0){
                Veiculo::where('lojista_id', $request->lojista_id)->where('renavam', $request->renavam)->update($veiculo_create);
                $veiculo = Veiculo::where('lojista_id', $request->lojista_id)->where('renavam', $request->renavam)->first();
            }else{
                $veiculo = Veiculo::create($veiculo_create);
            }
        }

        $veiculo_id = $request->veiculo_id ?? $veiculo->id;

        $originalPath = storage_path('app/public/veiculo_'.$veiculo_id.'/');
        if (!file_exists($originalPath)) {
            mkdir($originalPath, 0777, true);
        }

        if(isset($request->foto)){
            foreach($request->foto as $foto){
                $save_foto = Storage::disk('public')->put('veiculo_'.$veiculo_id, $foto);
                $fotos_create['veiculo_id'] = $veiculo_id;
                $fotos_create['name'] = $foto->getClientOriginalName();
                $fotos_create['path'] = $save_foto;
                $fotos_create['link'] = asset('storage/'.$save_foto);
                VeiculoFoto::create($fotos_create);
            }
        }

        if(isset($request->excluir_foto)) {
            foreach($request->excluir_foto as $excluir_foto){
                $foto = VeiculoFoto::find($excluir_foto);
                Storage::delete('public/'.$foto->path);

                $foto->delete();
            }
        }
        if(isset($request->excluir_veiculo_foto)) {
            foreach($request->excluir_veiculo_foto as $excluir_veiculo_foto){
                $foto = VeiculoFoto::find($excluir_veiculo_foto);
                Storage::delete('public/'.$foto->path);

                $foto->delete();
            }
        }

        return $veiculo_id;
    }
}
