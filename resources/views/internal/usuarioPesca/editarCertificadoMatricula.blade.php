@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Editar Certificado Matricula
@stop

@section('content')
  <div class="row">
    <div class="col-sm-8">
      {!!Form::open(array('url' => 'usuarioPesca/certificadoMatriculas/'.$certificadoMatricula->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        {!!Form::hidden('id', $certificadoMatricula->id)!!}
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Nombres del Dueño</label>
          <div class="col-sm-7">
            {!!Form::input('text','nombreDueno', $certificadoMatricula->nombreDueno ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Apellidos del Dueño</label>
          <div class="col-sm-7">
            {!!Form::input('text','apellidosDueno', $certificadoMatricula->apellidosDueno ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">DNI del Dueño</label>
          <div class="col-sm-7">
            {!!Form::input('text','dniDueno', $certificadoMatricula->dniDueno ,['class'=>'form-control','id'=>'inputEmai3','maxlength'=>'10','min' >0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Numero de Matricula</label>
          <div class="col-sm-7">
            {!!Form::input('text','nMatricula', $certificadoMatricula->nMatricula ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'50','required'])!!}
          </div>
        </div>
      
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
            <a href="{{action('CertificadoMatriculasController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
          </div>
        </div>

        <!-- MODAL -->
        <div class="modal fade"  id="submitModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">¿Estas seguro que desea editar el Certificado Matricula</h4>
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