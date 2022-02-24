<form action="{{route('lojistas.post')}}" method="post">
    <input type="hidden" name="user_id" value="{{$user->id}}">
    <div class="row">
        <div class="form-group col-12"><h2>Dados do Usuario</h2></div>
        <div class="form-group col-12 col-sm-8">
            <label for="">Nome Completo</label>
            <input type="text" class="form-control form-control-sm" name="name" value="{{$user->name}}">
        </div>
        <div class="form-group col-12 col-sm-4">
            <label for="">CPF</label>
            <input type="text" class="form-control form-control-sm documento" name="cpf" value="{{$user->document}}">
        </div>
        <div class="form-group col-12 col-sm-4">
            <label for="">Email</label>
            <input type="email" class="form-control form-control-sm" name="email" value="{{$user->email}}">
        </div>
        <div class="form-group col-12 col-sm-4">
            <label for="">Senha</label>
            <input type="password" class="form-control form-control-sm" name="password">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12"><h2>Dados da Loja</h2></div>
        <div class="form-group col-12 col-sm-4">
            <label for="">Razao Social</label>
            <input type="text" class="form-control form-control-sm" name="razao_social" value="{{$user->userData->razao_social}}">
        </div>
        <div class="form-group col-12 col-sm-4">
            <label for="">Nome Fantasia</label>
            <input type="text" class="form-control form-control-sm" name="nome_fantasia" value="{{$user->userData->nome_fantasia}}">
        </div>
        <div class="form-group col-12 col-sm-4">
            <label for="">CNPJ</label>
            <input type="text" class="form-control form-control-sm documento" name="cnpj" value="{{$user->userData->cnpj}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="phone1">Telefone/Celular - 1</label>
            <input type="text" class="form-control form-control-sm phone" name="phone1" value="{{$user->userData->phone1}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="phone2">Telefone/Celular - 2</label>
            <input type="text" class="form-control form-control-sm phone" name="phone2" value="{{$user->userData->phone2 ?? ''}}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12 col-sm-3">
            <label for="postal_code">CEP</label>
            <input type="text" class="form-control form-control-sm" name="postal_code" value="{{$user->userData->postal_code}}">
        </div>
        <div class="form-group col-12 col-sm-6">
            <label for="address">Rua/Endereço</label>
            <input type="text" class="form-control form-control-sm" name="address" value="{{$user->userData->address}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="home_number">Numero da Casa</label>
            <input type="text" class="form-control form-control-sm" name="home_number" value="{{$user->userData->home_number}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="address2">Bairro</label>
            <input type="text" class="form-control form-control-sm" name="address2" value="{{$user->userData->address2}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="city">Cidade</label>
            <input type="text" class="form-control form-control-sm" name="city" value="{{$user->userData->city}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="state">Estado</label>
            <input type="text" class="form-control form-control-sm" name="state" value="{{$user->userData->state}}">
        </div>
        <div class="form-group col-12 col-sm-3">
            <label for="complement">Complemento</label>
            <input type="text" class="form-control form-control-sm" name="complement" value="{{$user->userData->complement}}">
        </div>
    </div>
</form>