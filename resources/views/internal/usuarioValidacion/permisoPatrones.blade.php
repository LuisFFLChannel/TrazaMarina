@extends('layout.usuarioValidacion')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Permisos de Patron
@stop

@section('content')

<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">N° Documento</th>
        <th class="text-center">Fecha Vigencia</th>   
        <th class="text-center">N° de Patron</th>
        <th class="text-center">Marinero</th>
        <!--<th>Imagen</th>-->
        <th class="text-center">Detalle</th>
    </tr>
    
    @foreach($permisoPatrones as $permisoPatron)
    <tr>
      <td class="text-center">{{$permisoPatron->codigo}}</td>
      <td class="text-center">{{$permisoPatron->fechaVigencia}}</td>
      <td class="text-center">{{$permisoPatron->numeroPatron}}</td>
      @if($permisoPatron->pescador!=null)
        <td class="text-center">{{$permisoPatron->pescador->dni}} - {{$permisoPatron->pescador->apellidos}}, {{$permisoPatron->pescador->nombres}} </td>
      @else
          <td class="text-center"> No Asociado aun</td>
      @endif
     
      
      <!--<td>{!! Html::image($permisoPatron->imagen, null, array('class'=>'gift_img')) !!}</td>-->
      <td class="text-center">
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$permisoPatron->id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$permisoPatron->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left" id="myModalLabel">Detalle del Permiso de Patron</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          <h5 class="text-left">N° Documento: {{$permisoPatron->codigo}}</h5>
                          <h5 class="text-left">Nombres y Apellidos (en Documento): {{$permisoPatron->nombres}} - {{$permisoPatron->apellidos}}</h5>
                          <h5 class="text-left">DNI (en Documento): {{$permisoPatron->dni}}</h5>
                          <h5 class="text-left">Numero de Patron: {{$permisoPatron->numeroPatron}} </h5>
                          <h5 class="text-left">Fecha Vigencia: {{date_format(date_create($permisoPatron->fechaVigencia),"d/m/Y")}} </h5>
                          @if($permisoPatron->pescador!=null)
                            <h5 class="text-left">Nombre del pescador: {{$permisoPatron->pescador->nombres}} - {{$permisoPatron->pescador->apellidos}}</h5> 
                          @else
                            <h5 class="text-left">Nombre del pescador: No Esta asociado aun</h5>
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
    </tr>

    @endforeach
    
</table>

{!!$permisoPatrones->render()!!}
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