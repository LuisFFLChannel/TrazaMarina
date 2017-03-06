@extends('layout.admin')

@section('style')

@stop

@section('title')
	Mostrar Certificado de Matricula
@stop

@section('content')
<h3> Información del Certificado Actual </h3>
<br>
@if($embarcacion->certificadoMatricula!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th >Codigo</th>
                  <th >{{$embarcacion->certificadoMatricula->codigo}}</th>   
              </tr>  
              <tr>
                  <th>Nombre Dueño</th>
                  <th >{{$embarcacion->certificadoMatricula->nombreDueno}}</th>   
              </tr> 
              <tr>
                  <th >Apellidos Dueno</th>
                  <th >{{$embarcacion->certificadoMatricula->apellidosDueno}}</th>   
              </tr> 
              <tr>
                  <th >DNI Dueno</th>
                  <th >{{$embarcacion->certificadoMatricula->dniDueno}}</th>   
              </tr> 
               <tr>
                  <th>Numero de Matricula</th>
                  <th >{{$embarcacion->certificadoMatricula->nMatricula}}</th>   
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
<script>
$('document').ready(function () {

  if(navigator.userAgent.indexOf("Firefox")>-1 ) {
    console.log("its firefox");
    document.getElementById('firefox').style.visibility='visible';
  }
})
</script>  

@stop