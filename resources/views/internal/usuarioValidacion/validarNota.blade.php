@extends('layout.usuarioValidacion')

@section('style')

@stop

@section('title')
	Validar Nota de Ingreso (Número {{$notaIngreso->id}})
@stop

@section('content')

<h3> 1) Validar Toneladas en los Pesos de los Lotes</h3>
<br>
@if($notaIngreso!=null)

    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Numero de Lote</th>
                  <th class="text-center">Tonelada a Exportación</th>
                  <th class="text-center">Tonelada a Mercado</th>
              </tr> 
                  @foreach($notaIngreso->notasPorFabrica as $lote)
                    <tr>
                      <td class="text-center">{{$lote->certificado_id}}</td>
                      <td class="text-center">{{$lote->toneladas}}</td>
                      <td class="text-center">0</td>
                    </tr>
                  @endforeach
                  @foreach($notaIngreso->notasPorTerminal as $lote)
                    <tr>
                      <td class="text-center">{{$lote->transporte_id}}</td>
                      <td class="text-center">0</td>
                      <td class="text-center">{{$lote->toneladas}}</td>
                    </tr>
                  @endforeach
                   <tr>
                      <th class="text-center">Toneladas en el Registro de la Nota</th>
                      <th class="text-center">Tonelada Totales Exportación</th>
                      <th class="text-center">Tonelada Totales Mercado</th>
                      <th class="text-center">Diferencia</th>
                      <th class="text-center">Estado</th>
                  </tr> 
                  <tr>
                      <td class="text-center">{{$notaIngreso->toneladas}}</td>
                      <td class="text-center">{{$notaIngreso->toneladasExportacion}}</td>
                      <td class="text-center">{{$notaIngreso->toneladasMercado}}</td>
                      <td class="text-center">{{$notaIngreso->toneladasSobrantes}}</td>
                      @if($notaIngreso->toneladasSobrantes>=0)
                          <td class="text-center">Correcto</td>
                      @else
                          <td class="text-center" style="color:red;">Incorrecto</td>
                      @endif
             
                  </tr>

            </table>
        </div>
    </div>

    
@else
      <h4 class="text-center"> No hay una Nota bien Definida</h4>
@endif


<br>
<br>
<div class="row">
  <div class="col-sm-10">
      <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
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