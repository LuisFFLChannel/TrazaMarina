@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Editar Pesca
@stop

@section('content')
<h3> Información de la Pesca </h3>
<br>
<div class="row">
    <div class="col-sm-2">
  
    </div>
    <div class="col-sm-8">
        <table class="table table-bordered table-striped">
          <tr>
              <th >Numero</th>
              <th >{{$pesca->id}}</th>   
          </tr>  
          <tr>
              <th>Embarcacion</th>
              <th >{{$pesca->embarcacion->nMatricula}} - {{$pesca->embarcacion->nombre}}</th>   
          </tr> 
          <tr>
              <th >Puerto Zarpe</th>
              <th >{{$pesca->puerto->nombre}}</th>   
          </tr> 
          <tr>
              <th>Latitud de Pesca</th>
              <th >{{$pesca->coordenadaX}}</th>   
          </tr> 
          <tr>
              <th>Longitud de Pesca</th>
              <th >{{$pesca->coordenadaY}}</th>   
          </tr> 
           <tr>
              <th>Permiso Zarpe</th>
              <th >{{$pesca->permisoZarpe->id}} - {{$pesca->permisoZarpe->nombre}}</th>   
          </tr> 
           <tr>
              <th>Fecha Zarpe</th>
              <th >{{date_format(date_create($pesca->fechaZarpe),"d/m/Y") }}</th>   
          </tr> 
        </table>
    </div>
</div>
<br>
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'usuarioPesca/desembarques/'.$desembarque->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
            <label class="col-sm-3 control-label">Embarcacion</label>
            <div class="col-sm-9">
                {!! Form::select('embarcacion_id', $embarcaciones_lista->toArray(), $desembarque->embarcacion_id, ['class' => 'form-control','required', 'id'=>'embarcacion_id']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Dpa</label>
            <div class="col-sm-9">
                {!! Form::select('dpa_id', $dpas_lista->toArray(), $desembarque->dpa_id, ['class' => 'form-control','required', 'id'=>'dpa_id']) !!}
            </div>
        </div>

        <div class="form-group">
          <label for="inputcumpleanos" class="col-sm-3 control-label">Fecha Arribo</label>
          <div class="col-sm-9">
            {!!Form::input('date','fechaLlegada', explode(" ",$desembarque->fechaLlegada)[0] ,['class'=>'form-control','id'=>'fechaLlegada','required'])!!}
            <div class="col-sm-9" id="firefox" style="visibility: hidden">
                Formato Año(D/M/Y)
            </div> 
          </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Puerto Arribo</label>
            <div class="col-sm-9">
                {!! Form::select('puerto_id', $puertos_lista->toArray(), $desembarque->puerto_id, ['class' => 'form-control','required', 'id'=>'puerto_id']) !!}
            </div>
        </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
          <a href="{{action('DesembarqueController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
        </div>
      </div>

      <!-- MODAL -->
      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea editar el Desembarque?</h4>
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