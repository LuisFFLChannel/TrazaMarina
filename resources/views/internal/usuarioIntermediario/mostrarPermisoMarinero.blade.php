@extends('layout.usuarioIntermediario')

@section('style')

@stop

@section('title')
	Mostrar Permiso Marinero
@stop

@section('content')
<h3> Información del Permiso Marinero </h3>
<br>
@if($pescador->permisoMarinero!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th >Codigo</th>
                  <th >{{$pescador->permisoMarinero->id}}</th>   
              </tr>  
              <tr>
                  <th>Nombres</th>
                  <th >{{$pescador->permisoMarinero->nombres}}</th>   
              </tr> 
              <tr>
                  <th>Apellidos</th>
                  <th >{{$pescador->permisoMarinero->apellidos}}</th>   
              </tr> 
              <tr>
                  <th>DNI</th>
                  <th >{{$pescador->permisoMarinero->dni}}</th>   
              </tr>
               <tr>
                  <th>Numero de Marinero</th>
                  <th >{{$pescador->permisoMarinero->numeroMarinero}}</th>   
              </tr> 
              <tr>
                  <th>Fecha de Vigencia</th>
                  <th>{{date_format(date_create($pescador->permisoMarinero->fechaVigencia),"d/m/Y")}}</th>   
              </tr> 
            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No Asociado aun</h4>
@endif

<div class="row">
  <div class="col-sm-8">
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-8">
          <a href="{{URL::previous()}}"><button type="button" class="btn btn-info">Regresar</button></a>
        </div>
      </div>
  </div>
</div>
@stop

@section('javascript')
<script type="text/javascript">
  $('#yes').click(function(){
    $('#submitModal').modal('hide');  
  });
  
</script>

@stop