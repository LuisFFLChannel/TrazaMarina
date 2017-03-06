@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Nueva Embarcacion
@stop

@section('content')
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'usuarioPesca/embarcaciones/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-10">
            {!!Form::input('text','nombre', null ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Numero de Matricula</label>
          <div class="col-sm-10">
            {!!Form::input('text','nMatricula', null ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'50','required'])!!}
          </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Armador</label>
            <div class="col-sm-10">
                {!! Form::select('armador_id', $armadores_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'armador_id']) !!}
            </div>
        </div>
        <div class="form-group">
          <label for="capacidad" class="col-sm-2 control-label">Capacidad (Kg)</label>
          <div class="col-sm-10">
            {!!Form::input('number','capacidad', null ,['class'=>'form-control','id'=>'capacidad', 'min'=>0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="estara" class="col-sm-2 control-label">Estara (metros)</label>
          <div class="col-sm-10">
            {!!Form::input('number','estara', null ,['class'=>'form-control','id'=>'estara','min'=>0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="manga" class="col-sm-2 control-label">Manga (metros)</label>
          <div class="col-sm-10">
            {!!Form::input('number','manga', null ,['class'=>'form-control','id'=>'manga', 'min'=>0,'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="puntual" class="col-sm-2 control-label">Puntual (metros)</label>
          <div class="col-sm-10">
            {!!Form::input('number','puntual', null ,['class'=>'form-control','id'=>'puntual', 'min'=>0,'required'])!!}
          </div>
        </div>


        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
          <div class="col-sm-10">
            {!!Form::input('file','imagen', null ,['class'=>'form-control','id'=>'inputEmail3'])!!}
          </div>
        </div>
<!--
                <div class="form-group required">
                  <div class="col-sm-6">
                    <div class="col-sm-6 text-left">
                      <label for="" class="control-label">Direccion Laboral</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="searchmap" name="direccion_vivienda" placeholder="Direccion Laboral" style="max-width: 250px" value="{{old('direccion_laboral')}}">
                    </div>    
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-6">
                    <div class="col-sm-6 text-left">
                      <label for="" class="control-label">Mapa: </label>
                    </div>
                    <div class="col-sm-6">
                      <div id="map" width="600" height="450" frameborder="0" style="border:0"  allowfullscreen></div>
                      <iframe width="600" height="450" frameborder="0" style="border:0"  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAuOs_TsnqNatCMf__4y1fSoQi0-L-soHM&q=Space+Needle,Seattle+WA" allowfullscreen></iframe>
                    </div>    
                  </div>
                </div>
                <div class="form-group required">
                  <div class="col-sm-6">
                    <div class="col-sm-6 text-left">
                      <label for="" class="control-label">Longitud: </label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Correo" style="max-width: 250px" value="{{old('longitud')}}">
                    </div>    
                  </div>
                </div>  
                <div class="form-group required">
                  <div class="col-sm-6">
                    <div class="col-sm-6 text-left">
                      <label for="" class="control-label">Latitud: </label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Correo" style="max-width: 250px" value="{{old('latitud')}}">
                    </div>    
                  </div>
                </div>   

                <!-- <input id="submit" type="button" value="Reverse Geocode"> -->

    
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
              <h4 class="modal-title">¿Estas seguro que desea crear la embarcacion?</h4>
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