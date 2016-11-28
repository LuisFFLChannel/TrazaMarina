@extends('layoutExternal')

@section('style')
@stop

@section('title')
	Bienvenido...
@stop

@section('content')
	<h4>Búscar Producto con el código de trazabilidad</h4>
    <br>
    <div class="row">
        {!!Form::open(array('url' => 'codigoTrazabilidad','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
            <div class="col-sm-2">Codigo: </div>
            <div class="col-sm-8">
                {!!Form::input('text','buscar', null ,['class'=>'form-control','id'=>'textSearch', 'required'])!!}
             </div>   
            <div class="col-sm-2 pull-right">
                <button id="yes" type="submit" class="btn btn-info">Buscar</button>
          
            </div>
        {!!Form::close()!!}
    </div>
        

@stop

@section('javascript')
<script type="text/javascript">
  /*  $( document ).ready(function() {
        $('#searchButton').on('click',function(){
            var titulo = $('#textSearch').val();
            $('#searchButton').attr('href', 'event?title='+titulo);
        });
    });*/
</script>
@stop