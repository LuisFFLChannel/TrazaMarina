@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Asignar/Actualizar código trazabilidad
@stop

@section('content')
<h3> Información de creación para el código de trabilidad</h3>
<br>
<div class="row">
    <div class="col-sm-2">
  
    </div>
    <div class="col-sm-8">
        <table class="table table-bordered table-striped">
          <tr>
              <th >Pez Extraído</th>
              <th >{{$notaIngreso->especieMarina->nombre}}</th>   
              <th >{{$codPescado}}</th>  
          </tr> 
          <tr>
              <th>Embarcacion</th>
              <th >{{$notaIngreso->desembarque->embarcacion->nMatricula}}</th> 
              <th >{{$codEmb}}</th>    
          </tr>
          <tr>
              <th>Puerto desembarque</th>
              <th >{{$notaIngreso->desembarque->puerto->nombre}}</th>   
              <th >{{$codPuerto}}</th>
          </tr> 
          <tr>
              <th >Numero</th>
              <th >{{$notaIngreso->id}}</th> 
              <th >{{$codNota}}</th>   
          </tr> 
        </table>
    </div>
</div>
<h3> Codigo de Trazabilidad Registrado Actualmente</h3>
<br>
@if($notaIngreso->codigoTraza!=null)
    <div class="row">
      <div class="col-sm-12">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Codigo de Trazabilidad Registrado Actualmente</label>
            <div class="col-sm-8">
              {!!Form::input('text','antigua', $notaIngreso->codigoTraza,['class'=>'form-control','id'=>'inputEmai3', 'readonly'])!!}
            </div>
          </div>
      </div>
    </div>
@else
      <h4 class="text-center"> Aun no tiene un código de trazabilidad</h4>
@endif
<br>
<br>
<h3> Codigo de Trazabilidad Que va a Ser Registrado </h3>
<br>
  <div class="row">
    <div class="col-sm-12">
      {!!Form::open(array('url' => 'usuarioPesca/notasIngresos/'.$notaIngreso->id.'/agregarTrazabilidad','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">Codigo de Trazabilidad por Registrar</label>
          <div class="col-sm-8">
            {!!Form::input('text','codigoTrazabilidad', $valor ,['class'=>'form-control','id'=>'inputEmai3', 'readonly'])!!}
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
            <a href="{{URL::previous()}}"><button type="button" class="btn btn-info">Cancelar</button></a>
          </div>
        </div>

      <!-- MODAL -->
            <div class="modal fade"  id="submitModal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">¿Estas seguro que desea Crear el código de trazabilidad?</h4>
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
<br>
<br>
<br>


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