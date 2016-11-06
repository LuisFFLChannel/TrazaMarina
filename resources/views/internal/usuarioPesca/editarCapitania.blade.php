@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Editar Capitania
@stop

@section('content')
  <div class="row">
    <div class="col-sm-8">
      {!!Form::open(array('url' => 'usuarioPesca/capitanias/'.$capitania->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-10">
            {!!Form::input('text','nombre', $capitania->nombre ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'40','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Direccion</label>
          <div class="col-sm-10">
            {!!Form::input('text','direccion', $capitania->direccion ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'150','required'])!!}
          </div>
        </div>

        <div class="form-group">
          <label for="tamanoMin" class="col-sm-2 control-label">Latitud</label>
          <div class="col-sm-10">
            {!!Form::input('text','latitud', $capitania->coordenadaX ,['class'=>'form-control','id'=>'latitud', 'maxlength'=>'100','min' >0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="tamanoMax" class="col-sm-2 control-label">Longitud</label>
          <div class="col-sm-10">
            {!!Form::input('text','longitud', $capitania->coordenadaY ,['class'=>'form-control','id'=>'longitud', 'maxlength'=>'100','min' >0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
          <div class="col-sm-10">
            {!!Form::input('file','imagen', null ,['class'=>'form-control','id'=>'inputEmail3'])!!}
            {{$capitania->imagen}}
          </div>
        </div>
      
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
            <a href="{{action('CapitaniaController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
          </div>
        </div>

        <!-- MODAL -->
        <div class="modal fade"  id="submitModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">¿Estas seguro que desea editar la capitania</h4>
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