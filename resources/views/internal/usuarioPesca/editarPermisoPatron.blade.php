@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Editar Permiso de Patron
@stop

@section('content')
  <div class="row">
    <div class="col-sm-8">
      {!!Form::open(array('url' => 'usuarioPesca/permisoPatrones/'.$permisoPatron->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        {!!Form::hidden('id', $permisoPatron->id)!!}
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Codigo</label>
          <div class="col-sm-9">
            {!!Form::input('text','codigo', $permisoPatron->codigo ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'50','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Nombre</label>
          <div class="col-sm-9">
            {!!Form::input('text','nombres', $permisoPatron->nombres ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Apellidos</label>
          <div class="col-sm-9">
            {!!Form::input('text','apellidos', $permisoPatron->apellidos ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">DNI</label>
          <div class="col-sm-9">
            {!!Form::input('number','dni', $permisoPatron->dni ,['class'=>'form-control','id'=>'dni','max'=>'99999999', 'min'=>'10000000','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Numero de Patron</label>
          <div class="col-sm-9">
            {!!Form::input('text','numeroPatron', $permisoPatron->numeroPatron ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'50','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputcumpleanos" class="col-sm-3 control-label">Fecha Vigencia</label>
          <div class="col-sm-9">
            {!!Form::input('date','fechaVigencia', explode(" ",$permisoPatron->fechaVigencia)[0] ,['class'=>'form-control','id'=>'fechaVigencia','required'])!!}
            <div class="col-sm-9" id="firefox" style="visibility: hidden">
                Formato Año(D/M/Y)
            </div> 
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">PDF del Documento (Opcional) </label>
          <div class="col-sm-9">
            {!!Form::input('file','pdf', $permisoPatron->pdf ,['class'=>'form-control','id'=>'inputEmail3'])!!}
            {{$permisoPatron->pdf}}
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
                <h4 class="modal-title">¿Estas seguro que desea editar el Permiso de Marinero</h4>
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