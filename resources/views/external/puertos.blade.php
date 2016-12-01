@extends('layoutExternal')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Puertos
@stop

@section('content')

<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">Nombre</th>
        <th class="text-center">Informacion</th>   
        <th class="text-center">Imagen</th>
    </tr>
    
    @foreach($puertos as $puerto)
    <tr>
      <td class="text-center">{{$puerto->nombre}}</td>
      <td class="text-center">
          <h5 class="text-left">Direccion: {{$puerto->direccion}} </h5>                              
          <h5 class="text-left">Latitud: {{$puerto->coordenadaX}}</h5> 
          <h5 class="text-left">Longitud: {{$puerto->coordenadaY}}</h5> 

      </td>
      <td class="text-center">{!! Html::image($puerto->imagen, null, array('class'=>'gift_img')) !!}</td>
      
    </tr>

    @endforeach
    
</table>

{!!$puertos->render()!!}
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