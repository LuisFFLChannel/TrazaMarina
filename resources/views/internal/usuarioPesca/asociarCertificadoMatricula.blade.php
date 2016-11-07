@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Nuevo Certificado de Matricula
@stop

@section('content')
<h3> Información de la Embarcacion </h3>
<br>
<div class="row">
    <div class="col-sm-2">
  
    </div>
    <div class="col-sm-8">
        <table class="table table-bordered table-striped">
          <tr>
              <th >Nombre</th>
              <th >{{$embarcacion->nombre}}</th>   
              <!--<th>Imagen</th>-->
          </tr>  
          <tr>
              <th>Numero Matricula</th>
              <th >{{$embarcacion->nMatricula}}</th>   
              <!--<th>Imagen</th>-->
          </tr> 
          <tr>
              <th >Nombres Dueno</th>
              <th >{{$embarcacion->nombreDueno}}</th>   
              <!--<th>Imagen</th>-->
          </tr> 
          <tr>
              <th>Apellidos Dueno</th>
              <th >{{$embarcacion->apellidoDueno}}</th>   
              <!--<th>Imagen</th>-->
          </tr> 
          <tr>
              <th>Capacidad</th>
              <th >{{$embarcacion->capacidad}}</th>   
              <!--<th>Imagen</th>-->
          </tr> 
           <tr>
              <th>Estara</th>
              <th >{{$embarcacion->estara}}</th>   
              <!--<th>Imagen</th>-->
          </tr> 
           <tr>
              <th>Manga</th>
              <th >{{$embarcacion->manga}}</th>   
              <!--<th>Imagen</th>-->
          </tr> 
           <tr>
              <th>Puntual</th>
              <th >{{$embarcacion->puntual}}</th>   
              <!--<th>Imagen</th>-->
          </tr> 
        </table>
    </div>
</div>
<h3> Información del Certificado Actual </h3>
<br>
@if($embarcacion->certificado!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th >Codigo</th>
                  <th >{{$embarcacion->certificado->id}}</th>   
                  <!--<th>Imagen</th>-->
              </tr>  
              <tr>
                  <th>Nombre Dueño</th>
                  <th >{{$embarcacion->certificado->nombreDueno}}</th>   
                  <!--<th>Imagen</th>-->
              </tr> 
              <tr>
                  <th >Apellidos Dueno</th>
                  <th >{{$embarcacion->certificado->apellidosDueno}}</th>   
                  <!--<th>Imagen</th>-->
              </tr> 
               <tr>
                  <th>Numero de Matricula</th>
                  <th >{{$embarcacion->certificado->nMatricula}}</th>   
                  <!--<th>Imagen</th>-->
              </tr> 
            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No Asociado aun</h4>
@endif
<h3> Busqueda del Certificado Actual </h3>
<br>
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'usuarioPesca/embarcaciones/'.$embarcacion->id.'/editCertificado','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      
       
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
          <a href="{{action('EmbarcacionController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
        </div>
      </div>

      <!-- MODAL -->
      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea crear la capitania?</h4>
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
<script>
      function initMap() {
        var myLatlng = {lat: -12.089279446409028, lng: -77.02249328165635};
        var mapDiv = document.getElementById("map");
        var map = new google.maps.Map(mapDiv, {
          zoom: 15,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var geocoder = new google.maps.Geocoder;
        // Create the search box and link it to the UI element.
        var input = document.getElementById('searchmap');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29),
          draggable:true
        });
        // We add a DOM event here to show an alert if the DIV containing the
        // map is clicked.
        google.maps.event.addDomListener(window, 'load', initMap);
        marker.addListener('click', function() {
          infowindow.open(marker.get('map'), marker);
        });
        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
             window.alert("Autocomplete's returned place contains no geometry");
             return;
          }
          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(15);  // Why 17? Because it looks good.
          }
            
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(35, 35)
           }));
          var address = '';
            if (place.address_components) {
              address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
              ].join(' ');
            }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
            infowindow.open(map, marker);
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
            //Esto es para obtener la longitud y latitud
            var lat=marker.getPosition().lat();
          var lng=marker.getPosition().lng();
          //alert(lat);
          $('#latitud').val(lat);
          $('#longitud').val(lng);
         });
        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById("latitud").value = this.getPosition().lat();
            document.getElementById("longitud").value = this.getPosition().lng();
            geocodeLatLng(geocoder, map, infowindow);
            
        });
/*          document.getElementById('submit').addEventListener('click', function() {
            geocodeLatLng(geocoder, map, infowindow);
          });*/
        /*Obtener el nombre de la direccion*/
        function geocodeLatLng(geocoder, map, infowindow) {
          var latitud= document.getElementById('latitud').value;
          var longitud= document.getElementById('longitud').value;
          var latlng = {lat: parseFloat(latitud), lng: parseFloat(longitud)};
          geocoder.geocode({'location': latlng}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
              if (results[1]) {
                marker.setPosition(latlng);
                marker.setMap(map);
                map.setZoom(15  );
/*                var marker = new google.maps.Marker({
                  position: latlng,
                  map: map
                });*/
                infowindow.setContent(results[1].formatted_address);
                infowindow.open(map, marker);
              } else {
                window.alert('No results found');
              }
            } else {
              window.alert('Geocoder failed due to: ' + status);
            }
          });
        }
      }
  </script>


<!--  <script>
  function initialize(){
    
    
    var map= new google.maps.Map(document.getElementById('map-canvas'), {
      center:{ 
        lat:-12.089279446409028,
        lng:-77.02249328165635
      },
      zoom:15,
      mapTypeId: google.maps.MapTypeId.TERRAIN
    });
    var marker= new google.maps.Marker({
      position:{
        lat:-12.089279446409028,
        lng:-77.02249328165635
      },
      map: map,
      draggable:true
    });
    var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
    google.maps.event.addListener(searchBox,'places_changed', function(){
      var places = searchBox.getPlaces();
      var bounds = new google.maps.LatLngBounds();
      for(i=0;place=places[i];i++){
        bounds.extend(place.geometry.location);
        marker.setPosition(place.geometry.location); //set marker position new
      }
      map.fitBounds(bounds);
      map.setZoom(30);
    });
    google.maps.event.addListener(marker,'position_changed',function(){
      var lat=marker.getPosition().lat();
      var lng=marker.getPosition()-lng();
      $('#lat').val(lat);
      $('#lat').val(lng);
    });
  }
  google.maps.event.addDomListener(window,"load",initialize); 
  </script> -->

@stop