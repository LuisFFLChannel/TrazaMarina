<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset($favicon) }}">
    <title>@yield('title') | {{$business_name}} - StarkTicket</title>

    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/admin.css')!!}
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    @yield('style')
</head>
<body>
    @extends('layout.topbar')
    
    <div class="container">
        <h1>@yield('title')</h1>
        <hr>

        @include('errors.list')
        
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        @yield('content')
    </div>
    <div class="container">
        <hr>
        <p><b>Desarrollado por Stark</b></p>
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