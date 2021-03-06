@extends('layout.usuarioValidacion')

@section('style')

@stop

@section('title')
	Validar pesca (Número {{$pesca->id}})
@stop

@section('content')

<h3> 1) Validar Permiso Zarpe</h3>
<br>
@if($pesca->PermisoZarpe!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Puerto Zarpe en BD de la Pesca</th>
                  <th class="text-center">Puerto de Zarpe en el Permiso Zarpe</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pesca->puerto->id}} - {{$pesca->puerto->nombre}}</td>
                  <td class="text-center">{{$pesca->permisoZarpe->puerto->id}} - {{$pesca->permisoZarpe->puerto->nombre}}</td>
                  @if( $pesca->puerto->id == $pesca->permisoZarpe->puerto->id)
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
                  <th class="text-center">NMatricula de la Embarcacion en BD de la Pesca</th>
                  <th class="text-center">NMatricula de la Embarcacion de Zarpe en el Permiso Zarpe</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pesca->embarcacion->nMatricula}}</td>
                  <td class="text-center">{{$pesca->permisoZarpe->nMatricula}}</td>
                  @if(strcmp($pesca->embarcacion->nMatricula,$pesca->permisoZarpe->nMatricula)==0)
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
                  <th class="text-center">Fecha de Zarpe en la Pesca</th>
                  <th class="text-center">Fecha de Zarpe en el Permiso Zarpe</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{date_format(date_create($pesca->fechaZarpe),"d/m/Y")}}</td>
                  <td class="text-center">{{date_format(date_create($pesca->permisoZarpe->fechaZarpe),"d/m/Y")}}</td>
                  @if($pesca->fechaZarpe == $pesca->permisoZarpe->fechaZarpe )
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
                  <th class="text-center">Latitud en BD de la Pesca</th>
                  <th class="text-center">Latitud en el Permiso Zarpe</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pesca->coordenadaX}}</td>
                  <td class="text-center">{{$pesca->permisoZarpe->coordenadaX}}</td>
                  @if($pesca->coordenadaX == $pesca->permisoZarpe->coordenadaX )
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
                  <th class="text-center">Longitud en BD de la Pesca</th>
                  <th class="text-center">Longitud en el Permiso Zarpe</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pesca->coordenadaY}}</td>
                  <td class="text-center">{{$pesca->permisoZarpe->coordenadaY}}</td>
                  @if($pesca->coordenadaY == $pesca->permisoZarpe->coordenadaY)
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