@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Mostrar Certificado de Arribo
@stop

@section('content')
<h3> Información del Certificado Actual </h3>
<br>
@if($desembarque->certificadoArribo!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th >Codigo</th>
                  <th >{{$desembarque->certificadoArribo->id}}</th>   
              </tr> 
              <tr>
                  <th>Nombre</th>
                  <th >{{$desembarque->certificadoArribo->nombre}}</th>   
              </tr>  
               <tr>
                  <th>Numero de Matricula</th>
                  <th >{{$desembarque->certificadoArribo->nMatricula}}</th>   
              </tr> 
              <tr>
                  <th>Toneladas</th>
                  <th >{{$desembarque->certificadoArribo->toneladas}}</th>   
              </tr> 
              <tr>
                  <th>Fecha Arribo</th>
                  <th >{{date_format(date_create($desembarque->certificadoArribo->fechaArribo),"d/m/Y") }}</th>   
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
          <a href="{{action('DesembarqueController@index')}}"><button type="button" class="btn btn-info">Regresar</button></a>
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