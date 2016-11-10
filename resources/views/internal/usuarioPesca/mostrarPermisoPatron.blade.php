@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title') 
	Mostrar Permiso Patron
@stop

@section('content')
<h3> Información del Permiso Patron </h3>
<br>
@if($pescador->permisoPatron!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th >Codigo</th>
                  <th >{{$pescador->permisoPatron->id}}</th>   
              </tr>  
              <tr>
                  <th>Nombres</th>
                  <th >{{$pescador->permisoPatron->nombres}}</th>   
              </tr> 
              <tr>
                  <th>Apellidos</th>
                  <th >{{$pescador->permisoPatron->apellidos}}</th>   
              </tr> 
              <tr>
                  <th>DNI</th>
                  <th >{{$pescador->permisoPatron->dni}}</th>   
              </tr>
               <tr>
                  <th>Numero de Marinero</th>
                  <th >{{$pescador->permisoPatron->numeroPatron}}</th>   
              </tr> 
              <tr>
                  <th>Fecha de Vigencia</th>
                  <th>{{date_format(date_create($pescador->permisoPatron->fechaVigencia),"d/m/Y")}}</th>   
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
          <a href="{{action('PescadoresController@index')}}"><button type="button" class="btn btn-info">Regresar</button></a>
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