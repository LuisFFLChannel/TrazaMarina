<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset($favicon) }}">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<title>@yield('title') | {{$business_name}}</title>
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/style.css')!!}
    {!!Html::style('css/images.css')!!}
    {!!Html::style('css/style-desktop.css')!!}
    {!!Html::script('js/jQuery-2.1.4.min.js')!!}
    {!!Html::style('css/estilosLayOut.css')!!}
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
	@yield('style')

</head>
<body>
    @extends('layout.topbar')
    <div class="col-sm-2">
            
    </div>
    <div class="col-sm-10">
    	<div id="header">
    		<div class="container">
    			<!-- Logo -->

    			<div id="logo">
    				<h1 id="portada"><a href="{{url('/')}}">{{$business_name}}</a></h1>
    			</div>
    			<!-- Nav -->
    			<nav id="nav">
    				<ul>
    					<li><a href="{{url('/')}}" class="first">Inicio</a></li>
    					<li><a href="{{url('about')}}" class="fourth">Nosotros</a></li>
    					<li><a href="{{url('especiesMarinas')}} " class="second">Especies Marinas</a></li>
                        <li><a href="{{url('puertos')}} " class="second">Puertos</a></li>
                        
                        <!--<li><a href="{{url('category')}} " class="second">Categorias</a></li>-->
    					<!--<li><a href="{{url('event')}}" class="third">Eventos</a></li>
    					<li><a href="{{url('modules')}}" class="fifth">Puntos de venta</a></li>
    					<li><a href="{{url('calendar')}}" class="sixth">Calendario</a></li>
    					<li><a href="{{url('gifts')}}" class="seventh">Canjealo</a></li>-->
    				</ul>
    			</nav>

    		</div>
    	</div>
    	<div class="container">
            <h1>@yield('title')</h1>
            <hr>

            @include('errors.list')

            @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
            @endif
    		@yield('content')
    	</div>
    </div>

</body>
<!--
<footer id="footer">
    <p>
        <a href="#" class="icon circle fa-twitter"><span class="label">Twitter</span></a>
        <a href="#" class="icon circle fa-facebook"><span class="label">Facebook</span></a>
        <a href="#" class="icon circle fa-google-plus"><span class="label">Google+</span></a>
        <a href="#" class="icon circle fa-github"><span class="label">Github</span></a>
        <a href="#" class="icon circle fa-dribbble"><span class="label">Dribbble</span></a>
    </p>
</footer>-->
	{!!Html::script('js/bootstrap.min.js')!!}
    {!!Html::script('js/jquery.validate.min.js')!!}
    {!!Html::script('js/messages_es_PE.js')!!}
    <script type="text/javascript">
    $(document).ready(function(){
        $('#form').validate({
        errorElement: "span",
        rules: {
        },
        highlight: function(element) {
            $(element).closest('.form-group')
            .removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element)
            .addClass('help-inline')
            .closest('.form-group')
            .removeClass('has-error').addClass('has-success');
            }
        });
    });
    </script>
	@yield('javascript')

</html>