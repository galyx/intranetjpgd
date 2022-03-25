@php
    $permission = true;
    if(auth()->user()->permission == 10) $permission = false;
@endphp
<form action="{{route('veiculos.post')}}" method="post">
    <div class="row">
        @if ($veiculo->particular == 1)
            <input type="hidden" name="particular" value="true">
        @endif
        <input type="hidden" name="veiculo_id" value="{{$veiculo->id}}">
        <input type="hidden" name="lojista_id" value="{{$veiculo->lojista_id}}">

        <div class="form-group col-12 col-sm-4">
            <label for="renavam">Renavam</label>
            <input type="text" class="form-control form-control-sm" @if($permission) readonly @endif name="renavam" value="{{$veiculo->renavam}}">
        </div>
        <div class="form-group col-12 col-sm-4">
            <label for="plate_car">Placa</label>
            <input type="text" class="form-control form-control-sm" @if($permission) readonly @endif name="plate_car" value="{{$veiculo->plate_car}}">
        </div>
        <div class="form-group col-12 col-sm-4">
            <label for="color_car">Cor do Veiculo</label>
            <input type="text" class="form-control form-control-sm" @if($permission) readonly @endif name="color_car" value="{{$veiculo->color_car}}">
        </div>
        <div class="form-group col-12 col-sm-4">
            <label for="year_fab_mod">Ano Fab./Ano Mod.</label>
            <input type="text" class="form-control form-control-sm" @if($permission) readonly @endif name="year_fab_mod" value="{{$veiculo->year_fab_mod}}">
        </div>
        <div class="form-group col-12 col-sm-4">
            <label for="brand_model">Marca/Modelo</label>
            <input type="text" class="form-control form-control-sm" @if($permission) readonly @endif name="brand_model" value="{{$veiculo->brand_model}}">
        </div>
        <div class="form-group col-12 col-sm-4">
            <label for="chassi_car">Chassi</label>
            <input type="text" class="form-control form-control-sm text-uppercase" @if($permission) readonly @endif name="chassi_car" value="{{$veiculo->chassi_car}}">
        </div>
    </div>
    
    <div class="mt-3"><h4>Anexos</h4></div>
    <div class="row">
        @isset($veiculo->fotos)
            @foreach ($veiculo->fotos as $foto)
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
        @if (auth()->user()->permission == 10)
            <div class="col-6 col-md-3 mb-2">
                <button type="button" class="btn btn-primary btn-add-foto">+</button>
                <input type="file" name="foto[]" class="d-none add-foto">
                <div class="foto"></div>
            </div>
        @endif
    </div>
</form>