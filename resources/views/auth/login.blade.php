<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login ao Painel JPG Despachante</title>

  <link rel="stylesheet" href="{{asset('plugins/bootstrap-4.6.1-dist/css/bootstrap.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('plugins/adminlte/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>JPG</b> Despachante</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Faça login para iniciar sua sessão</p>

                <form id="form-login" action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    LEMBRAR ACESSO
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="button" id="btn-login" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <script src="https://kit.fontawesome.com/e4e38bb8fc.js" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="{{asset('plugins/jquery-3.6.0.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap-4.6.1-dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('plugins/adminlte/js/adminlte.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(document).on('click', '#btn-login', function () {
                var btn = $(this);
                var form = $('#form-login').serialize();
                var url = $('#form-login').attr('action');
                btn.html('<div class="spinner-border text-light" role="status"></div>');
                btn.prop('disabled', true);
                $('#form-login').find('input').prop('disabled', true);
                $('#form-login').find('.invalid-feedbeck').remove();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form,
                    success: (data) => {
                        // console.log(data);

                        window.location.href = data;
                    },
                    error: (err) => {
                        // console.log(err);
                        var errors = err.responseJSON.errors;

                        btn.html('ENTRAR');
                        btn.prop('disabled', false);
                        $('#form-login').find('input').prop('disabled', false);

                        if (errors) {
                            // console.log(errors);
                            $.each(errors, (key, value) => {
                                $('#form-login').find('[name="' + key + '"]').parent().append('<span class="invalid-feedbeck">' + value[0] + '</span>');
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
        });
    </script>
</body>
</html>
