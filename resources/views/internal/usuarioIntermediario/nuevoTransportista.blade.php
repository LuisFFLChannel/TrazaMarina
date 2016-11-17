@extends('layout.usuarioIntermediario')

@section('style')

@stop

@section('title')
	Nueva Transportista
@stop

@section('content')
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'usuarioIntermediario/transportistas/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nombres</label>
          <div class="col-sm-10">
            {!!Form::input('text','nombres', null ,['class'=>'form-control','id'=>'nombres', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Apellidos</label>
          <div class="col-sm-10">
            {!!Form::input('text','apellidos', null ,['class'=>'form-control','id'=>'apellidos', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">DNI</label>
          <div class="col-sm-10">
            {!!Form::input('number','dni', null ,['class'=>'form-control','id'=>'dni','max'=>'99999999', 'min'=>'10000000','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Telefono</label>
          <div class="col-sm-10">
            {!!Form::input('number','telefono', null ,['class'=>'form-control','id'=>'telefono','required','min'>=1])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="correo" class="col-sm-2 control-label">Correo</label>
          <div class="col-sm-10">
           {!!Form::input('email','correo', null ,['class'=>'form-control','id'=>'correo','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Brevete</label>
          <div class="col-sm-10">
            {!!Form::input('text','brevete', null,['class'=>'form-control','id'=>'brevete','maxlength'=>'50','required'])!!}
          </div>
        </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
          <a href="{{action('TransportistaController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
        </div>
      </div>

      <!-- MODAL -->
      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea crear el transportista?</h4>
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