@extends('layout.usuarioIntermediario')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Pescas
@stop

@section('content')

<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">Numero</th>
        <th class="text-center">Embarcacion</th>
        <th class="text-center">Puerto Zarpe</th>   
        <th class="text-center">Coordenadas de Pesca (Latitud , Longitud) </th>
        <th class="text-center">¿Esta en alta mar? </th>
        <!--<th>Imagen</th>-->
        <th class="text-center">Detalle</th>
        <th class="text-center">Desembarque</th>
        <!--<th class="text-center">Eliminar</th>-->
    </tr>
    
    @foreach($pescas as $pesca)
    <tr>
      <td class="text-center">{{$pesca->id}}</td>
      <td class="text-center">{{$pesca->embarcacion->nMatricula}} - {{$pesca->embarcacion->nombre}}</td>
      <td class="text-center">{{$pesca->puerto->nombre}}</td>
      <td class="text-center">( {{$pesca->coordenadaX}} , {{$pesca->coordenadaY}} )</td>
      @if($pesca->arribo == false)
          <td class="text-center"> Si </td>
      @else
          <td class="text-center"> No </td>
      @endif 
      <!--<td>{!! Html::image($pesca->imagen, null, array('class'=>'gift_img')) !!}</td>-->
      <td class="text-center">
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$pesca->id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$pesca->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left" id="myModalLabel">Detalle del Pesca</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          <h5 class="text-left">Numero: {{$pesca->id}} </h5>
                          <h5 class="text-left">Embarcacion: {{$pesca->embarcacion->nMatricula}} - {{$pesca->embarcacion->nombre}} </h5> 
                          <h5 class="text-left">Puerto de Zarpe: {{$pesca->puerto->nombre}}</h5>                                
                          <h5 class="text-left">Latitud de Pesca: {{$pesca->coordenadaX}}</h5> 
                          <h5 class="text-left">Longitud de Pesca: {{$pesca->coordenadaY}}</h5> 
                          <h5 class="text-left">Permiso Zarpe: {{$pesca->permisoZarpe->nombre}}</h5> 
                          <h5 class="text-left">Fecha Zarpe: {{date_format(date_create($pesca->fechaZarpe),"d/m/Y") }}</h5> 
                          <h5 class="text-left">Mapa: </h5>
                          
                          <hr>
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
      <td class="text-center"> 
            <a class="btn btn-info" href="{{url('usuarioIntermediario/pescas/'.$pesca->id.'/showDesembarque')}}" title="Ver Desembarque" ><i class="glyphicon glyphicon-plus"></i></a>
      </td>
      <!--<td class="text-center">
        <a class="btn btn-info" title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$pesca->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
      </td>-->
    
    </tr>

    @endforeach
    
</table>

{!!$pescas->render()!!}
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