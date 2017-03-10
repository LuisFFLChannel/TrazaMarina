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
          <label for="codigo" class="col-sm-3 control-label">Numero del Documento</label>
          <div class="col-sm-9">
            {!!Form::input('text','codigo', $certificadoMatricula->codigo ,['class'=>'form-control','id'=>'codigo', 'maxlength'=>'50','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="folio" class="col-sm-3 control-label">Folio</label>
          <div class="col-sm-9">
            {!!Form::input('text','folio', $certificadoMatricula->folio ,['class'=>'form-control','id'=>'folio', 'maxlength'=>'10','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="libro" class="col-sm-3 control-label">Libro</label>
          <div class="col-sm-9">
            {!!Form::input('text','libro', $certificadoMatricula->libro ,['class'=>'form-control','id'=>'libro', 'maxlength'=>'10','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Nombres del Dueño</label>
          <div class="col-sm-9">
            {!!Form::input('text','nombreDueno', $certificadoMatricula->nombreDueno ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Apellidos del Dueño</label>
          <div class="col-sm-9">
            {!!Form::input('text','apellidosDueno', $certificadoMatricula->apellidosDueno ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">DNI del Dueño</label>
          <div class="col-sm-9">
            {!!Form::input('text','dniDueno', $certificadoMatricula->dniDueno ,['class'=>'form-control','id'=>'inputEmai3','maxlength'=>'10','min' >0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Nombre de Embarcacion</label>
          <div class="col-sm-9">
            {!!Form::input('text','nombreEmbarcacion', $certificadoMatricula->nombreEmbarcacion ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Numero de Matricula</label>
          <div class="col-sm-9">
            {!!Form::input('text','nMatricula', $certificadoMatricula->nMatricula ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'50','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">PDF del Documento (Opcional) </label>
          <div class="col-sm-9">
            {!!Form::input('file','pdf', $certificadoMatricula->pdf ,['class'=>'form-control','id'=>'inputEmail3'])!!}
            {{$certificadoMatricula->pdf}}
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