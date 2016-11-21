@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Nueva Pesca
@stop

@section('content')

<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'usuarioPesca/pescas/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Embarcacion</label>
            <div class="col-sm-9">
                {!! Form::select('embarcacion_id', $embarcaciones_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'embarcacion_id']) !!}
            </div>
        </div>

        <div class="form-group">
          <label for="tamanoMin" class="col-sm-3 control-label">Latitud</label>
          <div class="col-sm-9">
            {!!Form::input('number','latitud', null ,['class'=>'form-control','id'=>'latitud','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="tamanoMax" class="col-sm-3 control-label">Longitud</label>
          <div class="col-sm-9">
            {!!Form::input('number','longitud', null ,['class'=>'form-control','id'=>'longitud', 'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputcumpleanos" class="col-sm-3 control-label">Fecha Zarpe</label>
          <div class="col-sm-9">
            {!!Form::input('date','fechaZarpe', null ,['class'=>'form-control','id'=>'fechaZarpe','required'])!!}
            <div class="col-sm-9" id="firefox" style="visibility: hidden">
                Formato Año(D/M/Y)
            </div> 
          </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Puerto Zarpe</label>
            <div class="col-sm-9">
                {!! Form::select('puerto_id', $puertos_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'puerto_id']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Permiso Zarpe</label>
            <div class="col-sm-9">
                {!! Form::select('permisoZarpe_id', $permisoZarpe_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'permisoZarpe_id']) !!}
            </div>
        </div>


      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
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
              <h4 class="modal-title">¿Estas seguro que desea crear la Pesca?</h4>
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