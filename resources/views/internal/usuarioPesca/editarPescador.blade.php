@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Editar Pescador
@stop

@section('content')
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'usuarioPesca/pescadores/'.$pescador->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      {!!Form::hidden('id', $pescador->id)!!}
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nombres</label>
          <div class="col-sm-10">
            {!!Form::input('text','nombres', $pescador->nombres ,['class'=>'form-control','id'=>'nombres', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Apellidos</label>
          <div class="col-sm-10">
            {!!Form::input('text','apellidos', $pescador->apellidos ,['class'=>'form-control','id'=>'apellidos', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">DNI</label>
          <div class="col-sm-10">
            {!!Form::input('number','dni', $pescador->dni ,['class'=>'form-control','id'=>'dni','max'=>'99999999', 'min'=>'10000000','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Telefono</label>
          <div class="col-sm-10">
            {!!Form::input('number','telefono', $pescador->telefono ,['class'=>'form-control','id'=>'telefono','required','min'>=1])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="correo" class="col-sm-2 control-label">Correo</label>
          <div class="col-sm-10">
           {!!Form::input('email','correo', $pescador->correo ,['class'=>'form-control','id'=>'correo','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputcumpleanos" class="col-sm-2 control-label">Cumpleaños</label>
          <div class="col-sm-10">
            {!!Form::input('date','cumpleanos', explode(" ",$pescador->cumpleanos)[0] ,['class'=>'form-control','id'=>'cumpleanos','required'])!!}
            <div class="col-sm-6" id="firefox" style="visibility: hidden">
                Formato Año(D/M/Y)
            </div> 
          </div>
        </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
          <a href="{{action('PescadoresController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
        </div>
      </div>

      <!-- MODAL -->
      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea editar al Pescador?</h4>
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