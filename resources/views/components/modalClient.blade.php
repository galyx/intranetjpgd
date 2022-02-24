<form action="{{route('clientes.post')}}" method="post">
    <div class="row">
        <input type="hidden" name="client_id" value="{{$client->id}}">
        <input type="hidden" name="lojista_id" value="{{$client->lojista_id}}">

        <div class="form-group col-12 col-sm-3">
            <label for="type_document">Tipo Documento</label>
            <select name="type_document" class="form-control form-control-sm">
                <option value="cpf" value="{{$client->type_document == 'cpf' ? 'selected' : ''}}">CPF</option>
                <option value="cnpj" value="{{$client->type_document == 'cnpj' ? 'selected' : ''}}">CNPJ</option>
            </select>
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="document_number">Numero Documento</label>
            <input type="text" class="form-control form-control-sm" name="document_number" value="{{$client->document_number}}">
        </div>
        <div class="form-group col-12 col-sm-6">
            <label for="full_name">Nome Completo</label>
            <input type="text" class="form-control form-control-sm" name="full_name" value="{{$client->full_name}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="document_number_rg">RG</label>
            <input type="text" class="form-control form-control-sm" name="document_number_rg" value="{{$client->document_number_rg ?? ''}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="phone1">Telefone/Celular - 1</label>
            <input type="text" class="form-control form-control-sm phone" name="phone1" value="{{$client->phone1}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="phone2">Telefone/Celular - 2</label>
            <input type="text" class="form-control form-control-sm phone" name="phone2" value="{{$client->phone2 ?? ''}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="phone3">Telefone/Celular - 3</label>
            <input type="text" class="form-control form-control-sm phone" name="phone3" value="{{$client->phone3 ?? ''}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="postal_code">CEP</label>
            <input type="text" class="form-control form-control-sm" name="postal_code" value="{{$client->postal_code}}">
        </div>
        <div class="form-group col-12 col-sm-6">
            <label for="address">Rua/Endereço</label>
            <input type="text" class="form-control form-control-sm" name="address" value="{{$client->address}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="home_number">Numero da Casa</label>
            <input type="text" class="form-control form-control-sm" name="home_number" value="{{$client->home_number}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="address2">Bairro</label>
            <input type="text" class="form-control form-control-sm" name="address2" value="{{$client->address2}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="city">Cidade</label>
            <input type="text" class="form-control form-control-sm" name="city" value="{{$client->city}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="state">Estado</label>
            <input type="text" class="form-control form-control-sm" name="state" value="{{$client->state}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="complement">Complemento</label>
            <input type="text" class="form-control form-control-sm" name="complement" value="{{$client->complement ?? ''}}">
        </div>
    </div>
    
    <div class="mt-3"><h4>Anexos</h4></div>
    <div class="row">
        @isset($client->fotos)
            @foreach ($client->fotos as $foto)
                <div class="col-6 col-md-3 mb-2">
                    <div class="checkbox justify-content-start mb-3">
                        <input class="me-2" type="checkbox" name="excluir_foto[]" value="{{$foto->id}}" />
                        <label for="">Excluir Foto?</label>
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
                            $ext = explode('.', $foto->name);
                            $ext = $ext[count($ext) - 1];
                        @endphp
                        @if (array_key_exists($ext, $ext_icon))
                            <a href="{{$foto->link}}" target="_blank" title="{{$foto->name}}" style="width: 100px;height: 100px;margin-top: 10px">{!!$ext_icon[$ext]!!}</a>
                        @else
                            <a href="{{$foto->link}}" target="_blank" title="{{$foto->name}}"><div style="
                                background-image: url({{$foto->link}});
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
            <input type="file" name="foto[]" class="d-none add-foto">
            <div class="foto"></div>
        </div>
    </div>
</form>