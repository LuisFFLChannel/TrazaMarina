@extends('layout.usuarioPesca')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Permisos de Zarpes
@stop

@section('content')

<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">N° Documennto</th>
        <th class="text-center">Nombre</th>   
        <th class="text-center">N° de Matricula</th>
        <th class="text-center">Fecha Zarpe</th>
        <!--<th>Imagen</th>-->
        <th class="text-center">Detalle</th>
        <th class="text-center">Editar</th>
        <th class="text-center">Eliminar</th>
    </tr>
    
    @foreach($permisoZarpes as $permisoZarpe)
    <tr>
      <td class="text-center">{{$permisoZarpe->id}}</td>
      <td class="text-center">{{$permisoZarpe->nombre}}</td>
      <td class="text-center">{{$permisoZarpe->nMatricula}}</td>
      <th class="text-center">{{date_format(date_create($permisoZarpe->Zarpe),"d/m/Y")}} </td>
         
      
      <!--<td>{!! Html::image($permisoZarpe->imagen, null, array('class'=>'gift_img')) !!}</td>-->
      <td class="text-center">
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$permisoZarpe->id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$permisoZarpe->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left" id="myModalLabel">Detalle del Permiso de Zarpe</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          <h5 class="text-left">N° Documento: {{$permisoZarpe->id}}</h5>
                          <h5 class="text-left">Nombre: {{$permisoZarpe->nombre}}</h5>
                          <h5 class="text-left">Numero de Matricula: {{$permisoZarpe->nMatricula}} </h5>
                          <h5 class="text-left">Fecha Zarpe: {{date_format(date_create($permisoZarpe->fechaZarpe),"d/m/Y")}} </h5>
                          <h5 class="text-left">Fecha Arribo: {{date_format(date_create($permisoZarpe->fechaArribo),"d/m/Y")}} </h5>
                          <h5 class="text-left">Capitania Asociada: {{$permisoZarpe->capitania->id}} - {{$permisoZarpe->capitania->nombre}} </h5>
                          <h5 class="text-left">Puerto de Zarpe: {{$permisoZarpe->puerto->id}} - {{$permisoZarpe->puerto->nombre}} </h5>
                          <h5 class="text-left">Patron: </h5>
                          @if($permisoZarpe->patron!=null)
                              @foreach($permisoZarpe->patron as $pes)
                                  <h6 class="text-center">DNI - Nombre: {{$pes->pescador->dni}} - {{$pes->pescador->apellidos}}, {{$pes->$pescador->nombres}}</h5> 
                              @endforeach
                          @endif 
                          <h5 class="text-left">Pescadores: </h5>
                          @if($permisoZarpe->pescadores!=null)
                              @foreach($permisoZarpe->pescadores as $pes)
                                  <h6 class="text-center">DNI - Nombre: {{$pes->pescador->dni}} - {{$pes->pescador->apellidos}}, {{$pes->$pescador->nombres}}</h5> 
                              @endforeach                    
                          @endif 
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
      <td class="text-center">
        <a class="btn btn-info" href="{{url('usuarioPesca/permisoZarpes/'.$permisoZarpe->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$permisoZarpe->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
      </td>
    </tr>

    <!-- MODAL -->
    <div class="modal fade"  id="deleteModal{{$permisoZarpe->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">¿Estas seguro que desea eliminar el Permiso de Zarpe?</h4>
          </div>
          <div class="modal-body">
            <h5 class="modal-title">Los cambios serán permanentes</h5>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
              <a class="btn btn-info" href="{{url('usuarioPesca/permisoZarpes/'.$permisoZarpe->id.'/delete')}}" title="Delete" >Sí</a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
   
    @endforeach
    
</table>

{!!$permisoZarpes->render()!!}
@stop

@section('javascript')
<script >
  /*  x = navigator.geolocation;
    x.getCurrentPosition(success,failure);

    function success(position){

      var mylat =   -12.069622;
      var mylong =  -77.080185;

      $('#lat').html(mylat);
      $('#long').html(mylong);

      var coords = new google.maps.LatLng(mylat,mylong);

      var mapOptions = {
        zoom: 16,
        center:coords,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }

      //crear mapa
      var map = new google.maps.Map(document.getElementById("map"),mapOptions);

      var ctaLayer = new google.maps.KmlLayer({
          url: 'http://googlemaps.github.io/js-v2-samples/ggeoxml/cta.kml',
          map: map
      });
    }
    function failure (){
      $('#lat').html("<p>No funciona, error")
    }*/
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          center: {lat: -12.069622, lng: -77.080185}
        });

        var ctaLayer = new google.maps.KmlLayer({
          url: 'http://googlemaps.github.io/js-v2-samples/ggeoxml/cta.kml',
          map: map
        });
    }



</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoElgDQ21cdBJtVLgvpFB8ywDLqhn4cKI&signed_in=true&callback=initMap">
    </script>
@stop