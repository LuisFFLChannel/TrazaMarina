@extends('layout.usuarioValidacion')

@section('style')

@stop

@section('title')
	Mostrar Permiso de Pesca
@stop

@section('content')
<h3> Información del Permiso de Pesca </h3>
<br>
@if($embarcacion->permisoPesca!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th >Codigo</th>
                  <th >{{$embarcacion->permisoPesca->codigo}}</th>   
              </tr>  
               <tr>
                  <th>Numero de Matricula</th>
                  <th >{{$embarcacion->permisoPesca->nMatricula}}</th>   
              </tr> 
              <tr>
                  <th>Fecha de Vigencia</th>
                  <th >{{date_format(date_create($embarcacion->permisoPesca->fechaVigencia),"y/m/d")}} </th>   
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