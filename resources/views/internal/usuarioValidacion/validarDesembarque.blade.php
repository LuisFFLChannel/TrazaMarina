@extends('layout.usuarioValidacion')

@section('style')

@stop

@section('title')
	Validar desembarque (Número {{$desembarque->id}})
@stop

@section('content')

<h3> 1) Validar Certificado Arribo</h3>
<br>
@if($desembarque->certificadoArribo!=null)

    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">NMatricula de la Embarcacion en BD del desembarque</th>
                  <th class="text-center">NMatricula de la Embarcacion de Zarpe en el Permiso Zarpe</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$desembarque->embarcacion->nMatricula}}</td>
                  <td class="text-center">{{$desembarque->certificadoArribo->nMatricula}}</td>
                  @if(strcmp($desembarque->embarcacion->nMatricula,$desembarque->certificadoArribo->nMatricula)==0)
                      <td class="text-center">Iguales</td>
                  @else
                      <td class="text-center" style="color:red;">Diferentes</td>
                  @endif
              </tr>

            </table>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Fecha de Arribo en la desembarque</th>
                  <th class="text-center">Fecha de Arribo en el Certificado de Arribo</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{date_format(date_create($desembarque->fechaLlegada),"d/m/Y")}}</td>
                  <td class="text-center">{{date_format(date_create($desembarque->certificadoArribo->fechaArribo),"d/m/Y")}}</td>
                  @if(date_format(date_create($desembarque->fechaLlegada),"d/m/Y") ==date_format(date_create($desembarque->certificadoArribo->fechaArribo),"d/m/Y"))
                      <td class="text-center">Iguales</td>
                  @else
                      <td class="text-center" style="color:red;">Diferentes</td>
                  @endif
              </tr>

            </table>
        </div>
    </div>
    
@else
      <h4 class="text-center"> No hay Permiso Zarpe</h4>
@endif

<h3> 2) Validar con la Pesca Registrada</h3>
<br>
@if($desembarque->pesca!=null)

    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Embarcacion en BD del desembarque</th>
                  <th class="text-center">Embarcacion en DB de la pesca</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$desembarque->embarcacion->id}} {{$desembarque->embarcacion->nombre}}</td>
                  <td class="text-center">{{$desembarque->pesca->embarcacion->id}} {{$desembarque->pesca->embarcacion->nombre}}</td>
                  @if($desembarque->embarcacion->id==$desembarque->pesca->embarcacion->id)
                      <td class="text-center">Iguales</td>
                  @else
                      <td class="text-center" style="color:red;">Diferentes</td>
                  @endif
              </tr>

            </table>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Fecha de Arribo en la desembarque</th>
                  <th class="text-center">Fecha de Arribo en el Permiso Zarpe</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{date_format(date_create($desembarque->fechaLlegada),"d/m/Y")}}</td>
                  <td class="text-center">{{date_format(date_create($desembarque->pesca->permisoZarpe->fechaLlegada),"d/m/Y")}}</td>
                  @if(date_format(date_create($desembarque->fechaLlegada),"d/m/Y") == date_format(date_create($desembarque->pesca->permisoZarpe->fechaLlegada),"d/m/Y"))
                      <td class="text-center">Iguales</td>
                  @else
                      <td class="text-center" style="color:red;">Diferentes</td>
                  @endif
              </tr>

            </table>
        </div>
    </div>
    
@else
      <h4 class="text-center"> No tiene una pesca realizada</h4>
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