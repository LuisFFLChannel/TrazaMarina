@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Editar Nota Ingreso
@stop

@section('content')

<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'usuarioPesca/notasIngresos/'.$nota->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
            <label class="col-sm-3 control-label">Especie Marina</label>
            <div class="col-sm-9">
                {!! Form::select('especie_id', $especie_lista->toArray(), $nota->especie_id, ['class' => 'form-control','required', 'id'=>'especie_id']) !!}
            </div>
        </div>

        <div class="form-group">
          <label for="tamanoMin" class="col-sm-3 control-label">Toneladas Totales</label>
          <div class="col-sm-9">
            {!!Form::input('number','toneladas', $nota->toneladas ,['class'=>'form-control','id'=>'toneladas','min'=>0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="tamanoMax" class="col-sm-3 control-label">Talla Promedio</label>
          <div class="col-sm-9">
            {!!Form::input('number','tallaPromedio', $nota->tallaPromedio ,['class'=>'form-control','id'=>'tallaPromedio', 'min'=>0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="tamanoMin" class="col-sm-3 control-label">Toneladas a Exportacion</label>
          <div class="col-sm-9">
            {!!Form::input('number','toneladasExportacion', $nota->toneladas ,['class'=>'form-control','id'=>'toneladasExportacion','min'=>0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="tamanoMin" class="col-sm-3 control-label">Toneladas a Mercado</label>
          <div class="col-sm-9">
            {!!Form::input('number','toneladasMercado', $nota->toneladas ,['class'=>'form-control','id'=>'toneladasMercado','min'=>0,'required'])!!}
          </div>
        </div>


      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
          <a href="{{action('NotaIngresoController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
        </div>
      </div>

      <!-- MODAL -->
      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea editar la Nota de Ingreso?</h4>
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