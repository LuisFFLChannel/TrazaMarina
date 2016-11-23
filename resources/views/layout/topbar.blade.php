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
                <li><a href="{{url('auth/register')}}">Registarse</a></li>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Esp. Marinas <b class="caret"></b></a>
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
                <li>
                    
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transportistas <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/transportistas')}}">Listar</a></li>
                        <li><a href="{{url('admin/transportistas/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                 
                <li>
                    
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Frigoríficos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/frigorificos')}}">Listar</a></li>
                        <li><a href="{{url('admin/frigorificos/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <!-- 
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Certificaciones de Pesca <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/certificadoMatriculas')}}">Listar</a></li>
                        <li><a href="{{url('admin/certificadoMatriculas/new')}}">Nuevo</a></li>
                    </ul>
                </li>-->
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
@elseif(Auth::user()->role_id == config('constants.usuarioPesca'))
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Esp. Marinas <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/especieMarinas')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/especieMarinas/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Puertos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/puertos')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/puertos/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dpa <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/dpas')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/dpas/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Capitanias <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/capitanias')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/capitanias/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pescadores <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/pescadores')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/pescadores/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Embarcaciones <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/embarcaciones')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/embarcaciones/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">C. de Matricula<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/certificadoMatriculas')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/certificadoMatriculas/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">P. de Pesca<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/permisoPescas')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/permisoPescas/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">P. Zarpe<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/permisoZarpes')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/permisoZarpes/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">P. Marinero<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/permisoMarineros')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/permisoMarineros/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">P. Patron<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/permisoPatrones')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/permisoPatrones/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pescas<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/pescas')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/pescas/new')}}">Nuevo</a></li>
                        <!--<li><a href="{{url('usuarioPesca/pescasNoArribadas')}}">Listar Pescas No Arribadas</a></li>
                        <li><a href="{{url('usuarioPesca/pescasArribadas')}}">Listar Pescas Arribadas</a></li>-->
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Desembarques<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/desembarques')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/notasIngresos')}}">Notas de Ingreso</a></li>
                        <!--<li><a href="{{url('usuarioPesca/desembarques/new')}}">Nuevo</a></li>-->
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">C. de Arribo<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioPesca/certificadoArribos')}}">Listar</a></li>
                        <li><a href="{{url('usuarioPesca/certificadoArribos/new')}}">Nuevo</a></li>
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
                <li><a href="{{url('usuarioPesca/')}}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{url('auth/logout')}}">Salir</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
@elseif(Auth::user()->role_id == config('constants.usuarioIntermediario'))
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Datos Maestros <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioIntermediario/especieMarinas')}}">Especies Marinas</a></li>
                        <li><a href="{{url('usuarioIntermediario/puertos')}}">Puertos</a></li>
                        <li><a href="{{url('usuarioIntermediario/dpas')}}">Dpa</a></li>
                        <li><a href="{{url('usuarioIntermediario/capitanias')}}">Capitanias</a></li>
                        <li><a href="{{url('usuarioIntermediario/embarcaciones')}}">Embarcaciones</a></li>
                        <li><a href="{{url('usuarioIntermediario/pescadores')}}">Pescadores</a></li>
                        <li><a href="{{url('usuarioIntermediario/pescas')}}">Pescas</a></li>
                        <li><a href="{{url('usuarioIntermediario/desembarques')}}">Desembarques</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Permisos/Certificados<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioIntermediario/certificadoMatriculas')}}">C. de Matricula</a></li>
                        <li><a href="{{url('usuarioIntermediario/permisoPescas')}}">P. de Pesca</a></li>
                        <li><a href="{{url('usuarioIntermediario/permisoPatrones')}}">P. de Patron</a></li>
                        <li><a href="{{url('usuarioIntermediario/permisoMarineros')}}">P. de Marinero</a></li>
                        <li><a href="{{url('usuarioIntermediario/permisoZarpes')}}">P. de Zarpe</a></li>
                        <li><a href="{{url('usuarioIntermediario/certificadoArribos')}}">C. de Arribo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transportistas <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioIntermediario/transportistas')}}">Listar</a></li>
                        <li><a href="{{url('usuarioIntermediario/transportistas/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Frigoríficos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioIntermediario/frigorificos')}}">Listar</a></li>
                        <li><a href="{{url('usuarioIntermediario/frigorificos/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Terminales <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioIntermediario/terminales')}}">Listar</a></li>
                        <li><a href="{{url('usuarioIntermediario/terminales/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Fabricas <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioIntermediario/fabricas')}}">Listar</a></li>
                        <li><a href="{{url('usuarioIntermediario/fabricas/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nota de Ingreso<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioIntermediario/notasIngresos')}}">Listar</a></li>
                        <!--<li><a href="{{url('usuarioPesca/desembarques/new')}}">Nuevo</a></li>-->
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Emp. Comercializador<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioIntermediario/empresarioComercializadores')}}">Listar</a></li>
                        <li><a href="{{url('usuarioIntermediario/empresarioComercializadores/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cert. Procedencia<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioIntermediario/certificadoProcedencias')}}">Listar</a></li>
                        <li><a href="{{url('usuarioIntermediario/certificadoProcedencias/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cert. Terminal<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioIntermediario/transporteTerminales')}}">Listar</a></li>
                        <li><a href="{{url('usuarioIntermediario/transporteTerminales/new')}}">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lotes<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioIntermediario/lotesFabricas')}}">Listar Lotes hacia Fabrica</a></li>
                        <li><a href="{{url('usuarioIntermediario/lotesTerminales')}}">Listar Lotes hacia Terminal</a></li>
                        <!--<li><a href="{{url('usuarioIntermediario/transporteTerminales/new')}}">Nuevo</a></li>-->
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
                <li><a href="{{url('usuarioIntermediario/')}}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{url('auth/logout')}}">Salir</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
@elseif(Auth::user()->role_id == config('constants.usuarioValidacion'))
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Datos Maestros <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioValidacion/especieMarinas')}}">Especies Marinas</a></li>
                        <li><a href="{{url('usuarioValidacion/puertos')}}">Puertos</a></li>
                        <li><a href="{{url('usuarioValidacion/dpas')}}">Dpa</a></li>
                        <li><a href="{{url('usuarioValidacion/capitanias')}}">Capitanias</a></li>
                        <li><a href="{{url('usuarioValidacion/embarcaciones')}}">Embarcaciones</a></li>
                        <li><a href="{{url('usuarioValidacion/pescadores')}}">Pescadores</a></li>
                        <li><a href="{{url('usuarioValidacion/fabricas')}}">Fabricas</a></li>
                        <li><a href="{{url('usuarioValidacion/terminales')}}">Terminales</a></li>
                        <li><a href="{{url('usuarioValidacion/transportistas')}}">Transportistas</a></li>
                        <li><a href="{{url('usuarioValidacion/frigorificos')}}">Frigorificos</a></li>
                        <li><a href="{{url('usuarioValidacion/empresarioComercializadores')}}">Emp. Comercializadores</a></li>
                        <li><a href="{{url('usuarioValidacion/pescas')}}">Pescas</a></li>
                        <li><a href="{{url('usuarioValidacion/desembarques')}}">Desembarques</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Permisos/Certificados<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioValidacion/certificadoMatriculas')}}">C. de Matricula</a></li>
                        <li><a href="{{url('usuarioValidacion/permisoPescas')}}">P. de Pesca</a></li>
                        <li><a href="{{url('usuarioValidacion/permisoPatrones')}}">P. de Patron</a></li>
                        <li><a href="{{url('usuarioValidacion/permisoMarineros')}}">P. de Marinero</a></li>
                        <li><a href="{{url('usuarioValidacion/permisoZarpes')}}">P. de Zarpe</a></li>
                        <li><a href="{{url('usuarioValidacion/certificadoArribos')}}">C. de Arribo</a></li>
                        <li><a href="{{url('usuarioValidacion/certificadoProcedencias')}}">C. de Procedencias</a></li>
                        <li><a href="{{url('usuarioValidacion/transporteTerminales')}}">C. de Terminales</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nota de Ingreso<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioValidacion/notasIngresos')}}">Listar</a></li>
                        <!--<li><a href="{{url('usuarioPesca/desembarques/new')}}">Nuevo</a></li>-->
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lotes<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('usuarioValidacion/lotesFabricas')}}">Listar Lotes hacia Fabrica</a></li>
                        <li><a href="{{url('usuarioValidacion/lotesTerminales')}}">Listar Lotes hacia Terminal</a></li>
                        <!--<li><a href="{{url('usuarioIntermediario/transporteTerminales/new')}}">Nuevo</a></li>-->
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
                <li><a href="{{url('usuarioValidacion/')}}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{url('auth/logout')}}">Salir</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
@endif
