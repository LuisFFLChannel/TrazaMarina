<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title') | StarkTicket</title>
    
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/admin.css')!!}
    @yield('style')
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{url('home')}}" class="navbar-brand" href="">Telecticke </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Eventos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('promoter/event/create')}}">Nuevo</a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('promoter/event/record')}}">Historial</a></li>
                            <li><a href="{{url('promoter/promotion')}}">Promociones</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Negocio<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('promoter/new_transfer_payment')}}">Nueva transferencia de pago</a></li>
                            <li><a href="{{url('promoter/transfer_payments')}}">Transferencias de pago</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="">Promotor</a></li>
                    <li><a href="{{url('auth/logout')}}">(Salir)</a></li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
        <h1>@yield('title')</h1>
        @yield('content')
    </div>
    <div class="container">
        <hr>
        <p><b>Todos los derechos reservados.</b></p>
    </div>

    {!!Html::script('js/jQuery-2.1.4.min.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}
    @yield('javascript')

</body>
</html>