@extends('layout.usuarioIntermediario')

@section('style')

@stop

@section('title')
	Asignar/Actualizar código trazabilidad Parte 2
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
              <th >Código Trazabilidad 1° Parte </th>
              <th > - </th>   
              <th >{{$notaIngreso->codigoTraza}}</th>  
          </tr> 
          <tr>
              <th >Certificado a Terminal</th>
              <th >{{$certificado->id}}</th>   
              <th >{{$codCert}}</th>  
          </tr> 
          <tr>
              <th>Frigorifico</th>
              <th >{{$certificado->frigorifico->placa}}</th> 
              <th >{{$codFrigorifico}}</th>    
          </tr>
          <tr>
              <th>Terminal</th>
              <th >{{$certificado->terminal->id}} {{$certificado->terminal->nombre}}</th>   
              <th >{{$codTerminal}}</th>
          </tr> 
        </table>
    </div>
</div>
<h3> Codigo de Trazabilidad Registrado Actualmente en la Segunda Parte</h3>
<br>
@if($lote->codigoTraza!=null)
    <div class="row">
      <div class="col-sm-12">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Codigo de Trazabilidad Registrado Actualmente</label>
            <div class="col-sm-8">
              {!!Form::input('text','antigua', $lote->codigoTraza,['class'=>'form-control','id'=>'inputEmai3', 'readonly'])!!}
            </div>
          </div>
      </div>
    <div>
@else
      <h4 class="text-center"> Aun no tiene un código de trazabilidad</h4>
@endif
<br>
<br>
<h3> Codigo de Trazabilidad Que va a Ser Registrado en la Segunda Parte</h3>
<br>
  <div class="row">
    <div class="col-sm-12">
      {!!Form::open(array('url' => 'usuarioIntermediario/lotesTerminales/'.$notaIngreso->id.'/'.$certificado->id.'/agregarTrazabilidad','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">Codigo de Trazabilidad por Registrar (Segunda Parte)</label>
          <div class="col-sm-8">
            {!!Form::input('text','codigoTrazabilidad', $valorCompleto ,['class'=>'form-control','id'=>'inputEmai3', 'readonly'])!!}
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
                    <h4 class="modal-title">¿Estas seguro que desea Crear el código de trazabilidad (Segunda Parte)?</h4>
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
  <div>
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