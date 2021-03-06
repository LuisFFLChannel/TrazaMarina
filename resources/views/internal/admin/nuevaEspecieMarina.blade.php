@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nueva Especie Marina
@stop

@section('content')
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'admin/especieMarinas/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-10">
            {!!Form::input('text','nombre', null ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'40','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nombre Cientifico</label>
          <div class="col-sm-10">
            {!!Form::input('text','nombreCientifico', null ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Promedio de Vida (Años)</label>
          <div class="col-sm-10">
            {!!Form::input('text','promedioVida', null ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="tamanoMin" class="col-sm-2 control-label">Tamaño Minimo (cm)</label>
          <div class="col-sm-10">
            {!!Form::input('text','tamanoMin', null ,['class'=>'form-control','id'=>'tamanoMin', 'maxlength'=>'100','min' >0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="tamanoMax" class="col-sm-2 control-label">Tamaño Maximo (cm)</label>
          <div class="col-sm-10">
            {!!Form::input('text','tamanoMax', null ,['class'=>'form-control','id'=>'tamanoMax', 'maxlength'=>'100','min' >0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
            <label for="inputBirth" class="col-sm-2 control-label">Inicio Veda</label>
              <div class="col-sm-10">
                  {!!Form::input('date','inicioVeda', null ,['class'=>'form-control','id'=>'inputBirth','required'])!!}
              <div class="col-sm-6" id="firefox" style="visibility: hidden">
                    Formato fecha: aaaaa-mm-dd
              </div>                     
            </div>
          </div>
        <div class="form-group">
            <label for="inputBirth" class="col-sm-2 control-label">Fin Veda</label>
              <div class="col-sm-10">
                  {!!Form::input('date','finVeda', null ,['class'=>'form-control','id'=>'inputBirth','required'])!!}
              <div class="col-sm-6" id="firefox" style="visibility: hidden">
                    Formato fecha: aaaaa-mm-dd
              </div>                     
            </div>
          </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tipo Pesca</label>
            <div class="col-sm-10">
                {!! Form::select('tipoPesca_id', $tipoPesca_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'tipoPesca_id']) !!}
            </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Factor Hielo</label>
          <div class="col-sm-10">
            {!!Form::input('number','factorHielo', null ,['class'=>'form-control','id'=>'inputEmai3', 'min' =>0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
          <div class="col-sm-10">
            {!!Form::input('file','imagen', null ,['class'=>'form-control','id'=>'inputEmail3'])!!}
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
              <h4 class="modal-title">¿Estas seguro que desea crear la especie marina?</h4>
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