@extends('layout.usuarioValidacion')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Capitanias
@stop

@section('content')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoElgDQ21cdBJtVLgvpFB8ywDLqhn4cKI&callback=myMap"></script>


<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">Nombre</th>
        <th class="text-center">Direccion</th>   
        <th class="text-center">Coordenadas (Latitud , Longitud) </th>
        <th class="text-center">Mostrar Mapa</th>
        <!--<th>Imagen</th>-->
        <th class="text-center">Detalle</th>
    </tr>
    
    @foreach($capitanias as $capitania)
    <tr>
      <td class="text-center">{{$capitania->nombre}}</td>
      <td class="text-center">{{$capitania->direccion}}</td>
      <td class="text-center">( {{$capitania->coordenadaX}} , {{$capitania->coordenadaY}} )</td>
      <td class="text-center">
          <a class="btn btn-info" href="{{url('usuarioValidacion/mapas/'.$capitania->id.'/mostarMapaCapitania')}}" title="Mostrar Mapa" ><i class="glyphicon glyphicon-map-marker"></i></a>
        </td>
      <!--<td>{!! Html::image($capitania->imagen, null, array('class'=>'gift_img')) !!}</td>-->
      <td class="text-center">
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$capitania->id}}" onclick="myMap({{$capitania->id}})" ><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$capitania->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left" id="myModalLabel">Detalle de la capitania</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div id="modeloModal" class="col-sm-8">
                          <h5 class="text-left">Nombre: {{$capitania->nombre}} </h5>
                          <h5 class="text-left">Direccion: {{$capitania->direccion}} </h5>                              
                          <h5 class="text-left">Latitud: {{$capitania->coordenadaX}}</h5> 
                          <h5 class="text-left">Longitud: {{$capitania->coordenadaY}}</h5>
                          <h5 class="text-left">Imagen:</h5> 
                          <p class="text-left">{!! Html::image($capitania->imagen, null, array('class'=>'gift_img')) !!}</p>
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
    </tr>
    @endforeach
    
</table>

{!!$capitanias->render()!!}
@stop
<script type="text/javascript">
  function myMap() {
    //var element = document.createElement("map");
    //element.appendChild(document.createTextNode('The man who mistook his wife for a hat'));
    //document.getElementById('modeloModal').appendChild(element);

      var mapOptions = {
       center: {lat: -34.397, lng: 150.644},
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP};
        var map = new google.maps.Map(document.getElementById("map"),mapOptions);
      }  
</script>
<style type="text/css">
  #map { height: 50%; width: 100% }
</style>
@section('javascript')





@stop