@extends('layout.usuarioValidacion')

@section('style')

@stop

@section('title')
	Validar Pescador ( {{$pescador->id}} - {{$pescador->nombres}} {{$pescador->apellidos}} )
@stop

@section('content')

<h3> 1) Validar Permiso Marinero</h3>
<br>
@if($pescador->PermisoMarinero!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Nombres en BD</th>
                  <th class="text-center">Nombres en Permiso Marinero</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pescador->nombres}}</td>
                  <td class="text-center">{{$pescador->permisoMarinero->nombres}}</td>
                  @if(strcmp($pescador->nombres,$pescador->permisoMarinero->nombres)==0)
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
                  <th class="text-center">Apellidos en BD</th>
                  <th class="text-center">Apellidos en Permiso Marinero</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pescador->apellidos}}</td>
                  <td class="text-center">{{$pescador->permisoMarinero->apellidos}}</td>
                  @if(strcmp($pescador->apellidos,$pescador->permisoMarinero->apellidos)==0)
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
                  <th class="text-center">Dni en BD</th>
                  <th class="text-center">Dni en Permiso Marinero</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pescador->dni}}</td>
                  <td class="text-center">{{$pescador->permisoMarinero->dni}}</td>
                  @if($pescador->dni==$pescador->permisoMarinero->dni)
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
                  <th class="text-center">Fecha de Vigencia</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{date_format(date_create($pescador->permisoMarinero->fechaVigencia),"d/m/Y")}}</td>
                  @if($validarMarinero)
                      <td class="text-center">Esta en Vigencia</td>
                  @else
                      <td class="text-center" style="color:red;">Fuera de Vigencia</td>
                  @endif
              </tr>

            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No hay Permiso Marinero</h4>
@endif

<h3> 2) Validar Permiso Patron</h3>
<br>
@if($pescador->PermisoPatron!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Nombres en BD</th>
                  <th class="text-center">Nombres en Permiso Patron</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pescador->nombres}}</td>
                  <td class="text-center">{{$pescador->permisoPatron->nombres}}</td>
                  @if(strcmp($pescador->nombres,$pescador->permisoPatron->nombres)==0)
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
                  <th class="text-center">Apellidos en BD</th>
                  <th class="text-center">Apellidos en Permiso Marinero</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pescador->apellidos}}</td>
                  <td class="text-center">{{$pescador->permisoPatron->apellidos}}</td>
                   @if(strcmp($pescador->apellidos,$pescador->permisoPatron->apellidos)==0)
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
                  <th class="text-center">Dni en BD</th>
                  <th class="text-center">Dni en Permiso Marinero</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pescador->dni}}</td>
                  <td class="text-center">{{$pescador->permisoPatron->dni}}</td>
                  @if($pescador->dni==$pescador->permisoPatron->dni)
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
                  <th class="text-center">Fecha de Vigencia</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center"> {{date_format(date_create($pescador->permisoPatron->fechaVigencia),"d/m/Y")}}</td>
                  @if($validarPatron)
                      <td class="text-center">Esta en Vigencia</td>
                  @else
                      <td class="text-center">Fuera de Vigencia</td>
                  @endif
              </tr>

            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No hay Permiso Patron</h4>
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