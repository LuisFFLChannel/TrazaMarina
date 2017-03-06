@extends('layout.admin')

@section('style')

@stop

@section('title')
	Editar Embarcacion
@stop

@section('content')
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'admin/embarcaciones/'.$embarcacion->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-10">
            {!!Form::input('text','nombre', $embarcacion->nombre ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Numero de Matricula</label>
          <div class="col-sm-10">
            {!!Form::input('text','nMatricula', $embarcacion->nMatricula ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'50','required'])!!}
          </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Armador</label>
            <div class="col-sm-10">
                {!! Form::select('armador_id', $armadores_lista->toArray(), $embarcacion->armador_id, ['class' => 'form-control','required', 'id'=>'armador_id']) !!}
            </div>
        </div>
        <div class="form-group">
          <label for="capacidad" class="col-sm-2 control-label">Capacidad (Kg)</label>
          <div class="col-sm-10">
            {!!Form::input('text','capacidad', $embarcacion->capacidad ,['class'=>'form-control','id'=>'capacidad', 'maxlength'=>'10','min' >0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="estara" class="col-sm-2 control-label">Estara (metros)</label>
          <div class="col-sm-10">
            {!!Form::input('text','estara', $embarcacion->estara ,['class'=>'form-control','id'=>'estara', 'maxlength'=>'10','min' >0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="manga" class="col-sm-2 control-label">Manga (metros)</label>
          <div class="col-sm-10">
            {!!Form::input('text','manga', $embarcacion->manga ,['class'=>'form-control','id'=>'manga', 'maxlength'=>'10','min' >0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="puntual" class="col-sm-2 control-label">Puntual (metros)</label>
          <div class="col-sm-10">
            {!!Form::input('text','puntual', $embarcacion->puntual ,['class'=>'form-control','id'=>'puntual', 'maxlength'=>'10','min' >0,'required'])!!}
          </div>
        </div>


        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
          <div class="col-sm-10">
            {!!Form::input('file','imagen', null ,['class'=>'form-control','id'=>'inputEmail3'])!!}
            {{$embarcacion->imagen}}
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
              <h4 class="modal-title">¿Estas seguro que desea editar la embarcacion?</h4>
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