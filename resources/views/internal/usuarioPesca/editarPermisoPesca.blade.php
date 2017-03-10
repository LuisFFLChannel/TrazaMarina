@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Editar Permiso de Pesca
@stop

@section('content')
  <div class="row">
    <div class="col-sm-8">
      {!!Form::open(array('url' => 'usuarioPesca/permisoPescas/'.$permisoPesca->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        {!!Form::hidden('id', $permisoPesca->id)!!}
        <div class="form-group">
          <label for="codigo" class="col-sm-3 control-label">Numero de Permiso de Pesca</label>
          <div class="col-sm-9">
            {!!Form::input('text','codigo', $permisoPesca->codigo ,['class'=>'form-control','id'=>'codigo', 'maxlength'=>'50','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-3 control-label">Nombre de Embarcacion</label>
          <div class="col-sm-9">
            {!!Form::input('text','nombreEmbarcacion', $permisoPesca->nombreEmbarcacion ,['class'=>'form-control','id'=>'nombre', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Numero de Matricula</label>
          <div class="col-sm-9">
            {!!Form::input('text','nMatricula', $permisoPesca->nMatricula ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'50','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputcumpleanos" class="col-sm-3 control-label">Fecha Vigencia</label>
          <div class="col-sm-9">
            {!!Form::input('date','fechaVigencia', explode(" ",$permisoPesca->fechaVigencia)[0] ,['class'=>'form-control','id'=>'fechaVigencia','required'])!!}
            <div class="col-sm-9" id="firefox" style="visibility: hidden">
                Formato Año(D/M/Y)
            </div> 
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">PDF del Documento (Opcional) </label>
          <div class="col-sm-9">
            {!!Form::input('file','pdf', $permisoPesca->pdf ,['class'=>'form-control','id'=>'inputEmail3'])!!}
            {{$permisoPesca->pdf}}
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
                <h4 class="modal-title">¿Estas seguro que desea editar el Permiso de Pesca</h4>
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