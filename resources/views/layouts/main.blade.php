<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IntraNet - JPG Despachante</title>

  <link rel="stylesheet" href="{{asset('plugins/bootstrap-4.6.1-dist/css/bootstrap.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('plugins/adminlte/css/adminlte.min.css')}}">
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="../../index3.html" class="navbar-brand">
          {{-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
          <span class="brand-text font-weight-light">Despachante JPG</span>
        </a>
  
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="{{route('home')}}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{route('solicitacoes')}}" class="nav-link">Solicitações</a>
            </li>
            <li class="nav-item">
              <a href="{{route('nova-solicitacao')}}" class="nav-link">Nova Solicitação</a>
            </li>
            <li class="nav-item">
              <a href="{{route('lojistas')}}" class="nav-link">Lojistas</a>
            </li>
            <li class="nav-item">
              <a href="{{route('clientes')}}" class="nav-link">Clientes</a>
            </li>
            <li class="nav-item">
              <a href="{{route('veiculos')}}" class="nav-link">Veiculos</a>
            </li>
          </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item">
            <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#">
              <i class="fa-solid fa-right-from-bracket"></i>
            </a>
          </li>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    @yield('container')

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- Default to the left -->
      <strong>&copy; {{date('Y')}} Desenvolvido pela <a href="https://agenciaweb7.com.br">Agencia Web7</a>.</strong> Todos os Direitos Reservados.
    </footer>
  </div>
  <!-- ./wrapper -->

  <form id="logout-form" action="#" method="POST" style="display: none;">
    @csrf
  </form>

  <script src="https://kit.fontawesome.com/e4e38bb8fc.js" crossorigin="anonymous"></script>
  <!-- jQuery -->
  <script src="{{asset('plugins/jquery-3.6.0.min.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('plugins/bootstrap-4.6.1-dist/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('plugins/adminlte/js/adminlte.min.js')}}"></script>
  <script src="{{asset('plugins/valida_cpf_cnpj.js')}}"></script>
  <script src="{{asset('plugins/mask.jquery.js')}}"></script>
  <script src="{{asset('plugins/mask.money.js')}}"></script>
  <script src="{{asset('js/script.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  {{-- <script src="{{asset('adminlte/js/demo.js')}}"></script> --}}
</body>
</html>
