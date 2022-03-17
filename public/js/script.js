$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let ext_icon = {
        'pdf': `<i class="fa-solid fa-file-pdf"></i>`,
        'doc': `<i class="fa-solid fa-file-lines"></i>`,
        'docx': `<i class="fa-solid fa-file-lines"></i>`,
        'csv': `<i class="fa-solid fa-file-csv"></i>`,
        'xlsx': `<i class="fa-solid fa-file-excel"></i>`,
        'xls': `<i class="fa-solid fa-file-excel"></i>`,
    };

    $('.real').maskMoney({precision: 2, decimal:',', thousands: ''});

    var MercoSulMaskBehavior = function (val) {
        var myMask = 'SSS0A00';
        var mercosul = /([A-Za-z]{3}[0-9]{1}[A-Za-z]{1})/;
        var normal = /([A-Za-z]{3}[0-9]{2})/;
        var replaced = val.replace(/[^\w]/g, '');
        if (normal.exec(replaced)) {
            myMask = 'SSS-0000';
        } else if (mercosul.exec(replaced)) {
            myMask = 'SSS0A00';
        }
        return myMask;
    },

    mercoSulOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(MercoSulMaskBehavior.apply({}, arguments), options);
        }
    };

    $('[name="postal_code"]').mask('00000-000');
    $('[name="year_fab_mod"]').mask('0000/0000');
    $('[name="plate_car"]').addClass('text-uppercase').mask(MercoSulMaskBehavior, mercoSulOptions);

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
        $(this).closest('form').children('div').each(function () {
            total_height += $(this).height();
        });

        $(this).closest('.modal-body').scrollTop(total_height);
    });
    $(document).on('click', '.btn-add-missings', function(){
        $('#missings').append(`
            <div class="row item">
                <div class="form-group col-6">
                    <input type="text" class="form-control form-control-sm" name="missing_infos[]">
                </div>
                <div class="form-group col-4">
                    <input type="text" class="form-control form-control-sm" name="missing_infos[]">
                </div>
                <div class="form-group col-2">
                    <button type="button" class="btn btn-sm btn-block btn-danger btn-remove-itens"><i class="fa-solid fa-times"></i></button>
                </div>
            </div>
        `);

        $('.real').maskMoney({precision: 2, decimal:',', thousands: ''});

        // var total_height = 0;
        // $(this).closest('form').children('div').each(function () {
        //     total_height += $(this).height();
        // });

        // $(this).closest('.modal-body').scrollTop(total_height);
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

    $(document).on('keyup focus', '[data-autocomplete="true"]', function(){
        var thiss = $(this);
        var tabela = $(this).data('tabela');
        var auto_preenchimento = $(this).data('auto_preenchimento');

        $.ajax({
            url: '/busca-tabela-ui',
            type: 'POST',
            data: {tabela: tabela, nome: thiss.val()},
            success: (data) => {
                thiss.autocomplete({
                    source: data,
                    select: (event, ui) => {
                        if(auto_preenchimento == 'sim'){
                            $.ajax({
                                url: '/busca-tabela-preechimento',
                                type: 'POST',
                                data: {tabela: tabela, id: ui.item.value},
                                success: (data) => {
                                    // console.log(data);
                                    $.each(data, (key, value)=>{
                                        thiss.closest('.row').find(`[name="${key}"]`).val(value);
                                    });
                                }
                            });
                        }
                    }
                });
            }
        });
    });

    // Adicionando imagem
    var html_foto = '';
    $(document).on('click', '.btn-add-foto', function(e){
        html_foto = $(this).parent().clone();
        $(this).parent().find('.add-foto').trigger('click');
    });
    $(document).on('change', '.add-foto', function(){
        $(this).removeClass('add-foto');

        $(this).parent().find('.btn-add-foto').removeClass('btn-primary btn-add-foto').addClass('btn-danger btn-remove-foto').html('x');

        // $(this).parent().parent().append(
        //     '<div class="col-6 col-md-3 mb-2">'+
        //         '<button type="button" class="btn btn-primary btn-add-foto">+</button>'+
        //         '<input type="file" class="d-none add-foto" name="foto[]">'+
        //         '<div class="foto"></div>'+
        //     '</div>'
        // );

        $(this).parent().parent().append(html_foto);

        var form_img = $(this).parent();

        var preview = form_img.find('.foto');
        var files   = $(this).prop('files');

        function readAndPreview(file) {
            // Make sure `file.name` matches our extensions criteria
            if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
                var reader = new FileReader();

                reader.addEventListener("load", function () {
                    // var image = new Image();
                    // image.classList = 'rounded img-fluid';
                    // image.height = 180;
                    // image.title = file.name;
                    // image.src = this.result;
                    // preview.append( image );
                    preview.css({
                        'background-image': `url('${this.result}')`,
                        'width': '100px',
                        'height': '100px',
                        'background-repeat': 'no-repeat',
                        'background-position': 'center',
                        'background-size': 'contain',
                        'margin-top': '10px',
                    });
                }, false);

                reader.readAsDataURL(file);
            }else{
                var ext = file.name.split('.');
                ext = ext[ext.length - 1];
                preview.html(ext_icon[ext]).css({
                    'width': '100px',
                    'height': '100px',
                    'margin-top': '10px',
                });
            }
        }

        if (files) {
            [].forEach.call(files, readAndPreview);
        }
    });
    $(document).on('click', '.btn-remove-foto', function(){
        $(this).parent().remove();
    });

    $(document).on('click', '.btn-altera-status', function(e) {
        var btn = $(this);
        var btn_status = $(this).attr('data-status');
        btn.closest('tr').find('.status').html((btn_status == 1 ? `<span class="text-danger">INATIVO</span>` : `<span class="text-success">ATIVO</span>`));
        btn.html((btn_status == 1 ? `Ativar` : `Desativar`));
        if(btn_status == 1) {
            btn.removeClass('btn-warning').addClass('btn-success');
        }else{
            btn.removeClass('btn-success').addClass('btn-warning');
        }
        btn.attr('data-status', (btn_status == 1 ? 0 : 1));

        $.ajax({
            url: btn.data('href'),
            type: 'POST',
            data: {table: btn.data('table'), id: btn.data('id'), status: (btn_status == 1 ? 0 : 1)},
            success: (data) => {
                // console.log(data);
            }
        });
    });

    $(document).on('click', '.btn-delete', function(){
        $.ajax({
            url: $(this).data('href'),
            type: 'POST',
            data: {table: $(this).data('table'), id: $(this).data('id')},
            success: (data) => {
                window.location.reload();
            }
        });
    });

    $(document).on('click', '.btn-editar', function(e) {
        $($(this).data('target')).modal('show');

        $.ajax({
            url: $(this).data('href'),
            type: 'POST',
            data: {table: $(this).data('table'), id: $(this).data('id')},
            success: (data) => {
                $($(this).data('target')).find('.modal-body').html(data.view);
                $('.real').maskMoney({precision: 2, decimal:',', thousands: ''});
                $('[name="year_fab_mod"]').mask('0000/0000');
                $('[name="plate_car"]').addClass('text-uppercase').mask(MercoSulMaskBehavior, mercoSulOptions);
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
            }
        });
    });

    // Btn para salvar
    $(document).on('click', '.btn-save', function(e) {
        e.preventDefault();
        var btn = $(this);
        var btnText = $(this).html();
        var route = $(this).closest('.modal').find('form').attr('action');
        var target = $(this).closest('.modal').find('form');

        var form_dados = new FormData(target[0]);

        btn.html('<div class="spinner-border text-light" role="status"></div>');
        btn.prop('disabled', true);
        target.find('input').prop('disabled', true).removeClass('is-invalid');
        target.find('.invalid-feedback').remove();

        $.ajax({
            url: route,
            type: 'POST',
            data: form_dados,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                // console.log(data);

                btn.html(btnText);
                btn.prop('disabled', false);
                target.find('input').prop('disabled', false);

                if(data[0] == 'success') {
                    switch(data[1]){
                        case 'local':
                            Swal.fire({
                                icon: 'success',
                                title: 'Dados atualizados com sucesso!'
                            });

                            target.closest('.modal').modal('hide');
                        break;
                        case 'redirect':
                            Swal.fire({
                                icon: 'success',
                                title: 'Dados atualizados com sucesso!'
                            });

                            setTimeout(() => {window.location.href = data[2]}, 1400);
                        break;
                    }
                }
            },
            error: (err) => {
                // console.log(err);
                var errors = err.responseJSON.errors;

                btn.html(btnText);
                btn.prop('disabled', false);
                target.find('input').prop('disabled', false);

                if (errors) {
                    // console.log(errors);
                    $.each(errors, (key, value) => {
                        target.find('[name="' + key + '"]').addClass('is-invalid').parent().append('<span class="invalid-feedback">' + value[0] + '</span>');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: err.responseJSON.invalid
                    });
                }
            }
        });
    });

    $(document).on('change', '[name="particular"]', function(){
        if($(this).prop('checked')){
            $(this).closest('form').find('[name="lojista_id"]').parent().addClass('d-none');
        }else{
            $(this).closest('form').find('[name="lojista_id"]').parent().removeClass('d-none');
        }
    });

    $(document).on('click', '.btn-href', function(e) {
        e.preventDefault();
        window.open($(this).attr('href')+'/'+$('[name="solicitacao_id"]').val(),'_blank');
    });

    $(document).on('click', '.btn-finalizar-solicitacao', function(e) {
        $.ajax({
            url: $(this).data('href'),
            type: 'POST',
            data: {os_id: $('[name="solicitacao_id"]').val()},
            success: data => {
                // console.log(data);
                window.open(data,'_blank');
                window.location.reload();
            }
        });
    });
});