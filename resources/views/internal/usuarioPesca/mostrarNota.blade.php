@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Mostrar Notas de Ingreso del Desembarque 
@stop

@section('content')

<h3> Información de Notas de Ingreso </h3>
<br>
@if($desembarque->notaIngreso!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Codigo</th>
                  <th class="text-center">Especie Marina</th>
                  <th class="text-center">Toneladas</th>
                  <th class="text-center">Talla Promedio</th>
                  <th class="text-center">Toneladas a Fabrica</th>
                  <th class="text-center">Toneladas a Mercados</th>

              </tr> 
               @foreach($desembarque->notaIngreso as $nota)
                  <tr>
                    <td class="text-center">{{$nota->id}}</td>
                    <td class="text-center">{{$nota->especieMarina->nombre}}</td>
                    <td class="text-center">{{$nota->toneladas}}</td>
                    <td class="text-center">{{$nota->tallaPromedio}}</td>
                    <td class="text-center">{{$nota->toneladasExportacion}}</td>
                    <td class="text-center">{{$nota->toneladasMercado}}</td>
                  </tr>
   
                @endforeach

            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No hay notas de ingreso</h4>
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