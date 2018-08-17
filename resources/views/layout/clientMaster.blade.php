<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset($favicon) }}">
    <title>@yield('title') | {{$business_name}} - TrazaPerico</title>
     <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/admin.css')!!}
    {!!Html::style('css/style.css')!!}
    {!!Html::style('css/style-desktop.css')!!}
    {!!Html::style('css/estilosLayOut.css')!!}
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    @yield('style')
</head>
<body>
    @extends('layout.topbar')
    <div class="col-sm-2">
            
    </div>
    <div class="col-sm-10">
        <div id="header" class="noprint">
            <div class="container">
                <div id="logo">
                    <h1 id="portada"><a href="{{url('clientMaster/home')}}">{{$business_name}}</a></h1>
                </div>
                <!-- Nav -->
                <nav id="nav">
                    <ul>
                        <li><a href="{{url('clientMaster/home')}}">Inicio</a></li>
                        <li><a href="{{url('about')}}" class="fourth">Nosotros</a></li>
                        <li><a href="{{url('especiesMarinas')}} " class="second">Especies Marinas</a></li>
                        <li><a href="{{url('puertos')}} " class="second">Puertos</a></li>
                    </ul>
                </nav>

            </div>
        </div>

        <div class="container">
            <h1>@yield('title')</h1>
            <hr>
            @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            @yield('content')
        </div>
        <div class="container">
            <hr>
            <p><b>Desarrollado por Luis Fernandez Leon</b></p>
        </div>
    </div>

    {!!Html::script('js/jQuery-2.1.4.min.js')!!}
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
        $('#yes').click(function(){
            $('.modal').modal('hide');
        });
    });
    </script>
    @yield('javascript')
</body>
</html>