@extends('layout.admin')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Terminales
@stop

@section('content')

<table class="table table-bordered table-striped">
    <tr>
        <th>Nombre</th>
        <th>Direccion</th>   
        <th>Coordenadas (Latitud , Longitud) </th>
        <!--<th>Imagen</th>-->
        <th>Detalle</th>
        <th>Editar</th>
        <th>Eliminar</th>
        <th></th>
    </tr>
    
    @foreach($terminales as $terminal)
    <tr>
      <td>{{$terminal->nombre}}</td>
      <td>{{$terminal->direccion}}</td>
      <td>( {{$terminal->coordenadaX}} , {{$terminal->coordenadaY}} )</td>
      <!--<td>{!! Html::image($terminal->imagen, null, array('class'=>'gift_img')) !!}</td>-->
      <td>
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$terminal->id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$terminal->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detalle del Terminal</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          <h5>Nombre: {{$terminal->nombre}} </h5>
                          <h5>Direccion: {{$terminal->direccion}} </h5>                              
                          <h5>Latitud: {{$terminal->coordenadaX}}</h5> 
                          <h5>Longitud: {{$terminal->coordenadaY}}</h5> 
                          <h5>Mapa: </h5>
                          
                          <hr>
                          <h5>Imagen:</h5> 
                          <p>{!! Html::image($terminal->imagen, null, array('class'=>'gift_img')) !!}</p>
                       </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
      <td>
        <a class="btn btn-info" href="{{url('admin/terminales/'.$terminal->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td>
        <a class="btn btn-info" title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$terminal->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
      </td>
      <td> <div id="map"></div></td>
    </tr>

    <!-- MODAL -->
    <div class="modal fade"  id="deleteModal{{$terminal->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">¿Estas seguro que desea eliminar el terminal?</h4>
          </div>
          <div class="modal-body">
            <h5 class="modal-title">Los cambios serán permanentes</h5>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
              <a class="btn btn-info" href="{{url('admin/terminales/'.$terminal->id.'/delete')}}" title="Delete" >Sí</a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
   
    @endforeach
    
</table>

{!!$terminales->render()!!}
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