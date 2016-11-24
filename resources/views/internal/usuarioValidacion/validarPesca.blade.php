@extends('layout.usuarioValidacion')

@section('style')

@stop

@section('title')
	Validar pesca ( {{$pesca->id}} )
@stop

@section('content')

<h3> 1) Validar Permiso Zarpe</h3>
<br>
@if($pesca->PermisoPesca!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Numero de Matricula en BD</th>
                  <th class="text-center">Numero de Matricula en Permiso Pesca</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pesca->nMatricula}}</td>
                  <td class="text-center">{{$pesca->permisoPesca->nMatricula}}</td>
                  @if(strcmp($pesca->nMatricula,$pesca->permisoPesca->nMatricula)==0)
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
                  <td class="text-center">{{date_format(date_create($pesca->permisoPesca->fechaVigencia),"d/m/Y")}}</td>
                  @if($validarPermiso)
                      <td class="text-center">Esta en Vigencia</td>
                  @else
                      <td class="text-center" style="color:red;">Fuera de Vigencia</td>
                  @endif
              </tr>

            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No hay Permiso Pesca</h4>
@endif

<h3> 2) Validar Certificado de Matricula</h3>
<br>
@if($pesca->certificadoMatricula!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th class="text-center">Nombres del Dueño en BD</th>
                  <th class="text-center">Nombres del Dueño en Certificado Matricula</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pesca->nombreDueno}}</td>
                  <td class="text-center">{{$pesca->certificadoMatricula->nombreDueno}}</td>
                  @if(strcmp($pesca->nombreDueno,$pesca->certificadoMatricula->nombreDueno)==0)
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
                  <th class="text-center">Apellidos del Dueño en BD</th>
                  <th class="text-center">Apellidos del Dueño en Certificado Matricula</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pesca->apellidoDueno}}</td>
                  <td class="text-center">{{$pesca->certificadoMatricula->apellidosDueno}}</td>
                   @if(strcmp($pesca->apellidoDueno,$pesca->certificadoMatricula->apellidosDueno)==0)
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
                  <th class="text-center">Numero Matricula en BD</th>
                  <th class="text-center">Numero Matricula en Certificado Matricula</th>
                  <th class="text-center">Estado</th>
              </tr> 
              <tr>
                  <td class="text-center">{{$pesca->nMatricula}}</td>
                  <td class="text-center">{{$pesca->certificadoMatricula->nMatricula}}</td>
                  @if($pesca->nMatricula==$pesca->certificadoMatricula->nMatricula)
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
                  <td class="text-center"> {{date_format(date_create($pesca->certificadoMatricula->fechaVigencia),"d/m/Y")}}</td>
                  @if($validarCertificado)
                      <td class="text-center">Esta en Vigencia</td>
                  @else
                      <td class="text-center">Fuera de Vigencia</td>
                  @endif
              </tr>

            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No hay Certificado Matricula</h4>
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