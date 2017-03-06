@extends('layout.admin')

@section('style')

@stop

@section('title')
	Asociar Permiso Patron a Pescador
@stop

@section('content')
<h3> Información de Pescador </h3>
<br>
<div class="row">
    <div class="col-sm-2">
  
    </div>
    <div class="col-sm-8">
        <table class="table table-bordered table-striped">
          <tr>
              <th >Nombres</th>
              <th >{{$pescador->nombres}}</th>   
          </tr>  
          <tr>
              <th>Apellidos</th>
              <th >{{$pescador->apellidos}}</th>   
          </tr> 
          <tr>
              <th >DNI</th>
              <th >{{$pescador->dni}}</th>   
          </tr> 
          <tr>
              <th>Telefono</th>
              <th >{{$pescador->telefono}}</th>   
          </tr> 
          <tr>
              <th>Correo</th>
              <th >{{$pescador->correo}}</th>   
          </tr> 
           <tr>
              <th>Cumpleaños</th>
              <th >{{ explode(" ",$pescador->cumpleanos)[0]}}</th>   
          </tr> 
        </table>
    </div>
</div>
<h3> Información del Permiso Patron Actual </h3>
<br>
@if($pescador->permisoPatron!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th >Codigo</th>
                  <th >{{$pescador->permisoPatron->codigo}}</th>   
              </tr>  
              <tr>
                  <th>Nombres</th>
                  <th >{{$pescador->permisoPatron->nombres}}</th>   
              </tr> 
              <tr>
                  <th>Apellidos</th>
                  <th >{{$pescador->permisoPatron->apellidos}}</th>   
              </tr> 
              <tr>
                  <th>DNI</th>
                  <th >{{$pescador->permisoPatron->dni}}</th>   
              </tr>
               <tr>
                  <th>Numero de Patron</th>
                  <th >{{$pescador->permisoPatron->numeroPatron}}</th>   
              </tr> 
              <tr>
                  <th>Fecha de Vigencia</th>
                  <th>{{date_format(date_create($pescador->permisoPatron->fechaVigencia),"d/m/Y")}}</th>   
              </tr> 
            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No Asociado aun</h4>
@endif
<h3> Busqueda del Permiso Actual </h3>
<br>
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'admin/pescadores/'.$pescador->id.'/editPermisoPatron','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <table id="example" class="table table-bordered display" >
            <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Numero Patron</th>
                  <th>Vigencia</th>
                  <th>Seleccionar</th>
                </tr>
             </thead>
            <tbody>
              @foreach($permisoPatrones as $permisoPatron)
                <tr>
                  <td>{{$permisoPatron->id}}</td>
                  <td>{{$permisoPatron->numeroPatron}}</td>
                  <td>{{ date_format(date_create($permisoPatron->fechaVigencia),"d/m/Y")}}</td>
                  <td> {!! Form::radio('permisoPatron', $permisoPatron->id ,   (Input::old('permisoPatron') == $permisoPatron->id ), array('id'=>'true', 'class'=>'radio  permisoPatron_id'         ,'required'   ))  !!} </td>
                </tr>

                @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @if(!$permisoPatrones->isEmpty())
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
            <a href="{{URL::previous()}}"><button type="button" class="btn btn-info">Cancelar</button></a>
          </div>
        </div>
      @else
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a href="{{URL::previous()}}"><button type="button" class="btn btn-info">Regresar</button></a>
          </div>
        </div>
      @endif

      <!-- MODAL -->
      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea asociar este Permiso de Patron?</h4>
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