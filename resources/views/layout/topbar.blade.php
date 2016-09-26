@if(Auth::user() == null)
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
            <a class="navbar-brand" href="{{url('/')}}">{{$business_name}} </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('auth/login')}}">Login</a></li>
                <li><a href="{{url('auth/register')}}">Sign Up</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
@elseif(Auth::user()->role_id == config('constants.salesman'))
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
            <a class="navbar-brand" href="{{url('/')}}">{{$business_name}} </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-left">

                <li><a href="{{url('salesman/cash_count')}}">Apertura y Arqueo de caja</a></li>
                <li><a href="{{url('salesman/exchange_gift')}}">Canjeo de regalos</a></li>
                <li><a href="{{url('event')}}">Venta Ticket</a></li>
                <li><a href="{{url('salesman/giveaway')}}">Entrega Ticket</a></li>
                <li><a href="{{url('salesman/devolutions/')}}">Devoluciones </a></li>
                <li><a href="{{url('salesman/event/pay_booking')}}">Cobrar Reserva</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('/salesman')}}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{url('auth/logout')}}">Salir</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
@elseif(Auth::user()->role_id == config('constants.client'))
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
            <a class="navbar-brand" href="{{url('/')}}">{{$business_name}} </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Eventos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('client')}}">Perfil</a></li>
                        <li><a href="{{url('client/event_record')}}">Historial</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a>Puntos Acumulados: {{Auth::user()->points}}</a></li>
                <li> {!! Html::image(Auth::user()->image,  null, array( "width"=>45, 'height' => 45)) !!} </li>
                <li><a href="{{url('client')}}">{{\Auth::user()->name}}</a></li>
                <li><a href="{{url('auth/logout')}}">Salir</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
@elseif(Auth::user()->role_id == config('constants.promoter'))
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
            <a href="{{url('/')}}" class="navbar-brand" >{{$business_name}} </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Eventos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('promoter/event/create')}}">Nuevo</a></li>
                        <li><a href="{{url('promoter/event/record')}}">Historial</a></li>
                        <li><a href="{{url('promoter/presentation/cancelled')}}">Presentaciones cancelados</a></li>
                        <li><a href="{{url('promoter/highlights')}}">Destacados</a></li>
                    </ul>
                </li>
                <li>
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Promociones <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('promoter/promotion')}}">Listar</a></li>
                        <li><a href="{{url('promoter/promotion/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Negocio<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('promoter/transfer_payments')}}">Transferencias de pago</a></li>
                        <!--li><a href="{{url('promoter/event/recordPayment')}}">Historial de pagos</a></li-->
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Organizador <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('promoter/organizers')}}">Listar</a></li>
                        <li><a href="{{url('promoter/organizer/create')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li><a href="{{url('promoter/politics')}}">Politicas</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('promoter')}}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{url('auth/logout')}}">Salir</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
@elseif(Auth::user()->role_id == config('constants.admin'))
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
            <a class="navbar-brand" href="{{url('/')}}">{{$business_name}} </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <!--
                <li>
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Categorias <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/category')}}">Listar</a></li>
                        <li><a href="{{url('admin/category/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Regalos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/gifts')}}">Listar</a></li>
                        <li><a href="{{url('admin/gifts/new')}}">Nuevo</a></li>
                        <li><a href="{{url('admin/exchange_gift')}}">Canjear</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Locales <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/local')}}">Listar</a></li>
                        <li><a href="{{url('admin/local/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Trabajadores <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/user/new')}}">Nuevo</a></li>
                        <li class="divider"></li>
                        <li><a href="{{url('admin/promoter')}}">Promotores de ventas</a></li>
                        <li><a href="{{url('admin/salesman')}}">Vendedores</a></li>
                        <li><a href="{{url('admin/admin')}}">Administradores</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clientes <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/client')}}">Listar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Puntos de Venta <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/modules')}}">Listar</a></li>
                        <li><a href="{{url('admin/modules/new')}}">Nuevo</a></li>
                        <li><a href="{{url('admin/modules/assigment')}}">Asignación de Módulos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Negocio <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="divider"></li>
                        <li><a href="{{url('admin/politics')}}">Politicas </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{url('admin/report/sales')}}">Reporte Ventas</a>
                        </li>
                         <li>
                            <a href="{{url('admin/report/assistance')}}">Reporte de Asistencias</a>
                        </li>
                        <li>
                            <a href="{{url('admin/report/assignment')}}">Reporte de Asignación</a>
                        </li>
                    </ul>
                </li>-->
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Especies Marinas <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/especieMarinas')}}">Listar</a></li>
                        <li><a href="{{url('admin/especieMarinas/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Puertos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/puertos')}}">Listar</a></li>
                        <li><a href="{{url('admin/puertos/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dpa <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/dpas')}}">Listar</a></li>
                        <li><a href="{{url('admin/dpas/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Capitanias <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/capitanias')}}">Listar</a></li>
                        <li><a href="{{url('admin/capitanias/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Terminales <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/terminales')}}">Listar</a></li>
                        <li><a href="{{url('admin/terminales/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Fabricas <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/fabricas')}}">Listar</a></li>
                        <li><a href="{{url('admin/fabricas/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pescadores <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/pescadores')}}">Listar</a></li>
                        <li><a href="{{url('admin/pescadores/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Embarcaciones <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/embarcaciones')}}">Listar</a></li>
                        <li><a href="{{url('admin/embarcaciones/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuración  <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/config/exchange_rate')}}">Tipo de cambio</a></li>
                        <li><a href="{{url('admin/config/about')}}">Acerca de</a></li>
                        <li><a href="{{url('admin/config/system')}}">Sistema</a></li>
                    </ul>
                </li>-->

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('admin/')}}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{url('auth/logout')}}">Salir</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
@endif
