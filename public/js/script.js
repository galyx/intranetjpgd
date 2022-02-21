$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.real').maskMoney({precision: 2, decimal:',', thousands: ''});

    $('[name="postal_code"]').mask('00000-000');

    $('[name="cpf"]').mask('000.000.000-00');
    $('[name="cnpj"]').mask('00.000.000/0000-00');
    $('[name="document_number"]').mask('000.000.000-00');
    $(document).on('change', '[name="type_document"]', function(){
        if($(this).val() == 'cpf'){
            $('[name="document_number"]').mask('000.000.000-00');
        }else{
            $('[name="document_number"]').mask('00.000.000/0000-00');
        }
    });

    // Telefone/Celeular
    var behavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    options_fone = {
        onKeyPress: function (val, e, field, options_fone) {
            field.mask(behavior.apply({}, arguments), options_fone);
        }
    };
    $('.phone').mask(behavior, options_fone);

    $(document).on('keyup', '[name="postal_code"]', function(){
        if($(this).val().length > 8){
            $.ajax({
                url: '/cep-busca',
                type: 'POST',
                data: {cep: $(this).val()},
                success: (data) => {
                    // console.log(data);

                    $('[name="address2"]').val(data.bairro);
                    $('[name="state"]').val(data.uf);
                    $('[name="city"]').val(data.localidade);
                    $('[name="address"]').val(data.logradouro);
                    $('[name="home_number"]').focus();
                }
            });
        }
    });

    // Aciona a validação ao sair do input
    $(document).on('blur', '[name="document_number"], .documento',function(){
        var thiss = $(this);
    
        // O CPF ou CNPJ
        var document_number = $(this).val();

        if(document_number){
            // Testa a validação
            if ( valida_cpf_cnpj( document_number ) ) {
    
            } else {
                Swal.fire({
                    icon: 'error',
                    text: ($('[name="type_document"]').length > 0 ? $('[name="type_document"]').val().toUpperCase() : 'Documento')+' informado invalido!',
                }).then((result)=>{
                    // thiss.focus();
                });
            }
        }
    });

    $(document).on('click', '.btn-add-itens', function(){
        $('#itens').append(`
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
        `);

        $('.real').maskMoney({precision: 2, decimal:',', thousands: ''});

        var total_height = 0;
        $(this).closest('.modal-body').children('div').each(function () {
            total_height += $(this).height();
        });

        $(this).closest('.modal-body').scrollTop(total_height);
    });
    $(document).on('click', '.btn-remove-itens', function () {
        $(this).closest('.item').remove();
        var valor_total = 0;
        $('.valor-item').each(function(){
            valor_total += parseFloat($(this).val().replace(',','.')) || 0;
        });
        $('[name="total_value"]').val(valor_total.toFixed(2));
        $('.valor-total').html(`R$ ${valor_total.toFixed(2).toString().replace('.',',')}`);
    });

    $(document).on('keyup', '.valor-item', function(){
        var valor_total = 0;
        $('.valor-item').each(function(){
            valor_total += parseFloat($(this).val().replace(',','.')) || 0;
        });
        $('[name="total_value"]').val(valor_total.toFixed(2));
        $('.valor-total').html(`R$ ${valor_total.toFixed(2).toString().replace('.',',')}`);
    });
});