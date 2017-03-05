@extends('layout.usuarioIntermediario')

@section('style')

@stop

@section('title')
	Mostrar Lotes por Notas de Ingreso
@stop

@section('content')

<h3> Información de Notas de Ingreso </h3>
<br>
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

                  <tr>
                    <td class="text-center">{{$nota->id}}</td>
                    <td class="text-center">{{$nota->especieMarina->nombre}}</td>
                    <td class="text-center">{{$nota->toneladas}}</td>
                    <td class="text-center">{{$nota->tallaPromedio}}</td>
                    <td class="text-center">{{$nota->toneladasExportacion}}</td>
                    <td class="text-center">{{$nota->toneladasMercado}}</td>
                  </tr>

            </table>
        </div>
    </div>
<h3> Lotes de Notas de Ingreso hacia Fábrica </h3>
<br>
@if($lista_Fabrica!=null || $lista_Fabrica.isEmpty())
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Codigo Cert. Procedencia</th>
                  <th class="text-center">Toneladas</th>
                  <th class="text-center">Fabrica</th>
                  <th class="text-center">Transportista</th>
                  <th class="text-center">Frigorífico</th>
              </tr> 
               @foreach($lista_Fabrica as $lote)
                  <tr>
                    <td class="text-center">{{$lote->certificado->codigo}}</td>
                    <td class="text-center">{{$lote->toneladas}}</td>
                    <td class="text-center">{{$lote->certificado->fabrica->nombre}}</td>
                    <td class="text-center">{{$lote->certificado->transportista->nombres}} {{$lote->certificado->transportista->apellidos}}</td>
                    <td class="text-center">{{$lote->certificado->frigorifico->nombre}}</td>
                  </tr>
   
                @endforeach

            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No hay Lotes</h4>
@endif
<h3> Lotes de Notas de Ingreso hacia Terminal </h3>
<br>
@if($lista_Terminal!=null || $lista_Terminal.isEmpty())
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Codigo Cert. Procedencia</th>
                  <th class="text-center">Toneladas</th>
                  <th class="text-center">Terminal</th>
                  <th class="text-center">Transportista</th>
                  <th class="text-center">Frigorífico</th>
              </tr> 
               @foreach($lista_Terminal as $lote)
                  <tr>
                    <td class="text-center">{{$lote->certificadoTerminal->codigo}}</td>
                    <td class="text-center">{{$lote->toneladas}}</td>
                    <td class="text-center">{{$lote->certificadoTerminal->terminal->nombre}}</td>
                    <td class="text-center">{{$lote->certificadoTerminal->transportista->nombres}} {{$lote->certificadoTerminal->transportista->apellidos}}</td>
                    <td class="text-center">{{$lote->certificadoTerminal->frigorifico->nombre}}</td>
                  </tr>
   
                @endforeach

            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No hay Lotes</h4>
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