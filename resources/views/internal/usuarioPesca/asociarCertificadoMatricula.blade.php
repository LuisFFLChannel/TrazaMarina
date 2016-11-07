@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Asociar Certificado de Matricula a Embarcacion
@stop

@section('content')
<h3> Información de la Embarcacion </h3>
<br>
<div class="row">
    <div class="col-sm-2">
  
    </div>
    <div class="col-sm-8">
        <table class="table table-bordered table-striped">
          <tr>
              <th >Nombre</th>
              <th >{{$embarcacion->nombre}}</th>   
          </tr>  
          <tr>
              <th>Numero Matricula</th>
              <th >{{$embarcacion->nMatricula}}</th>   
          </tr> 
          <tr>
              <th >Nombres Dueno</th>
              <th >{{$embarcacion->nombreDueno}}</th>   
          </tr> 
          <tr>
              <th>Apellidos Dueno</th>
              <th >{{$embarcacion->apellidoDueno}}</th>   
          </tr> 
          <tr>
              <th>Capacidad</th>
              <th >{{$embarcacion->capacidad}}</th>   
          </tr> 
           <tr>
              <th>Estara</th>
              <th >{{$embarcacion->estara}}</th>   
          </tr> 
           <tr>
              <th>Manga</th>
              <th >{{$embarcacion->manga}}</th>   
          </tr> 
           <tr>
              <th>Puntual</th>
              <th >{{$embarcacion->puntual}}</th>   
          </tr> 
        </table>
    </div>
</div>
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
                  <th >{{$embarcacion->certificadoMatricula->id}}</th>   
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
                  <th>Numero de Matricula</th>
                  <th >{{$embarcacion->certificadoMatricula->nMatricula}}</th>   
              </tr> 
            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No Asociado aun</h4>
@endif
<h3> Busqueda del Certificado Actual </h3>
<br>
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'usuarioPesca/embarcaciones/'.$embarcacion->id.'/editCertificado','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <table id="example" class="table table-bordered display" >
            <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre Dueño</th>
                  <th>Descripción</th>
                  <th>Seleccionar</th>
                </tr>
             </thead>
            <tbody>
              @foreach($certificadoMatriculas as $certificadoMatricula)
                <tr>
                  <td>{{$certificadoMatricula->id}}</td>
                  <td>{{$certificadoMatricula->nombreDueno}}</td>
                  <td>{{$certificadoMatricula->apellidosDueno}}</td>
                  <td> {!! Form::radio('certificadoMatricula', $certificadoMatricula->id ,   (Input::old('certificadoMatricula') == $certificadoMatricula->id ), array('id'=>'true', 'class'=>'radio  certificadoMatricula_id'         ,'required'   ))  !!} </td>
                </tr>

                @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @if($certificadoMatriculas)
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
            <a href="{{action('EmbarcacionController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
          </div>
        </div>
      @else
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a href="{{action('EmbarcacionController@index')}}"><button type="button" class="btn btn-info">Regresar</button></a>
          </div>
        </div>
      @endif

      <!-- MODAL -->
      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea asociar este Certificado de Matricula?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                <button id="yes" type="submit" class="btn btn-info">Si</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    {!!Form::close()!!}
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