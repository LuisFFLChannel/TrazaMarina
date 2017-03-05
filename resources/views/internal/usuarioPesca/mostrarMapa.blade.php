@extends('layout.usuarioPesca')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
@if($valorEscogido==1)
    Mapa de Capitania: {{$capitania->id}} - {{$capitania->nombre}}
@elseif ($valorEscogido==2)
    Mapa de Dpa : {{$dpa->id}} - {{$dpa->nombre}}
@elseif ($valorEscogido==3)
    Mapa de Fabrica: {{$fabrica->id}} - {{$fabrica->nombre}}
@elseif ($valorEscogido==4)
    Mapa de Puerto: {{$puerto->id}} - {{$puerto->nombre}}
@elseif ($valorEscogido==5)
    Mapa de Terminal: {{$terminal->id}} - {{$terminal->nombre}}
@elseif ($valorEscogido==6)
    Mapa del Permiso Zarpe: {{$pesca->permisoZarpe->codigo}}
@endif

@stop

@section('content')
<script  type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoElgDQ21cdBJtVLgvpFB8ywDLqhn4cKI&callback=myMap"></script>

<div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              @if($valorEscogido==1)
                <tr>
                    <th >Codigo</th>
                    <th >{{$capitania->id}}</th>   
                </tr> 
                <tr>
                    <th>Nombre</th>
                    <th >{{$capitania->nombre}}</th>   
                </tr>  
                 <tr>
                    <th>Direccion</th>
                    <th >{{$capitania->direccion}}</th>   
                </tr> 
                <tr>
                    <th>Laitud</th>
                    <th >{{$capitania->coordenadaX}}</th>   
                </tr> 
                <tr>
                    <th>Longitud</th>
                    <th >{{$capitania->coordenadaY}}</th>   
                </tr> 
                <tr>
                    <th>Imagen</th>
                    <th >{!! Html::image($capitania->imagen, null, array('class'=>'cat_img')) !!}</th>   
                </tr>
              @elseif ($valorEscogido==2)
                <tr>
                    <th >Codigo</th>
                    <th >{{$dpa->id}}</th>   
                </tr> 
                <tr>
                    <th>Nombre</th>
                    <th >{{$dpa->nombre}}</th>   
                </tr>  
                 <tr>
                    <th>Direccion</th>
                    <th >{{$dpa->direccion}}</th>   
                </tr> 
                <tr>
                    <th>Laitud</th>
                    <th >{{$dpa->coordenadaX}}</th>   
                </tr> 
                <tr>
                    <th>Longitud</th>
                    <th >{{$dpa->coordenadaY}}</th>   
                </tr> 
                <tr>
                    <th>Imagen</th>
                    <th >{!! Html::image($dpa->imagen, null, array('class'=>'cat_img')) !!}</th>   
                </tr>
              @elseif ($valorEscogido==3)
                <tr>
                    <th >Codigo</th>
                    <th >{{$fabrica->id}}</th>   
                </tr> 
                <tr>
                    <th>Nombre</th>
                    <th >{{$fabrica->nombre}}</th>   
                </tr>  
                 <tr>
                    <th>Direccion</th>
                    <th >{{$fabrica->direccion}}</th>   
                </tr> 
                <tr>
                    <th>Laitud</th>
                    <th >{{$fabrica->coordenadaX}}</th>   
                </tr> 
                <tr>
                    <th>Longitud</th>
                    <th >{{$fabrica->coordenadaY}}</th>   
                </tr> 
                <tr>
                    <th>Imagen</th>
                    <th >{!! Html::image($fabrica->imagen, null, array('class'=>'cate_img')) !!}</th>   
                </tr>
                @elseif ($valorEscogido==4)
                <tr>
                    <th >Codigo</th>
                    <th >{{$puerto->id}}</th>   
                </tr> 
                <tr>
                    <th>Nombre</th>
                    <th >{{$puerto->nombre}}</th>   
                </tr>  
                 <tr>
                    <th>Direccion</th>
                    <th >{{$puerto->direccion}}</th>   
                </tr> 
                <tr>
                    <th>Laitud</th>
                    <th >{{$puerto->coordenadaX}}</th>   
                </tr> 
                <tr>
                    <th>Longitud</th>
                    <th >{{$puerto->coordenadaY}}</th>   
                </tr> 
                <tr>
                    <th>Imagen</th>
                    <th >{!! Html::image($puerto->imagen, null, array('class'=>'cat_img')) !!}</th>   
                </tr>
                @elseif ($valorEscogido==5)
                <tr>
                    <th >Codigo</th>
                    <th >{{$terminal->id}}</th>   
                </tr> 
                <tr>
                    <th>Nombre</th>
                    <th >{{$terminal->nombre}}</th>   
                </tr>  
                 <tr>
                    <th>Direccion</th>
                    <th >{{$terminal->direccion}}</th>   
                </tr> 
                <tr>
                    <th>Laitud</th>
                    <th >{{$terminal->coordenadaX}}</th>   
                </tr> 
                <tr>
                    <th>Longitud</th>
                    <th >{{$terminal->coordenadaY}}</th>   
                </tr> 
                <tr>
                    <th>Imagen</th>
                    <th >{!! Html::image($terminal->imagen, null, array('class'=>'cat_img')) !!}</th>   
                </tr>
                @elseif ($valorEscogido==6)
                <tr>
                    <th >Codigo</th>
                    <th >{{$pesca->permisoZarpe->codigo}}</th>   
                </tr> 
                <tr>
                    <th>Embarcación</th>
                    <th >{{$pesca->embarcacion->id}} - {{$pesca->embarcacion->nombre}}</th>   
                </tr>  
                 <tr>
                    <th>Puerto</th>
                    <th >{{$pesca->puerto->id}} - {{$pesca->puerto->nombre}}</th>   
                </tr> 
                <tr>
                    <th>Latitud</th>
                    <th >{{$pesca->coordenadaX}}</th>   
                </tr> 
                <tr>
                    <th>Longitud</th>
                    <th >{{$pesca->coordenadaY}}</th>   
                </tr> 
                <tr>
                    <th>Fecha Zarpe</th>
                    <th >{{date_format(date_create($pesca->fechaZarpe),"d/m/Y") }}</th>   
                </tr>
                <tr>
                    <th>¿Arribó la Pesca?</th>
                    @if($pesca->arribo == true)
                        <th > Si </td>
                    @else
                        <th > No </td>
                    @endif 
                </tr>
              @endif

            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
          <div id="map"></div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-5">
      
        </div>
        <div class="col-sm-7">
         
               <a href="{{URL::previous()}}"> <button  type="button" class="btn btn-info">Regresar</button></a>
          
        </div>
    </div>

@stop
<script type="text/javascript">
  function myMap() {
    //var element = document.createElement("map");
    //element.appendChild(document.createTextNode('The man who mistook his wife for a hat'));
    //document.getElementById('modeloModal').appendChild(element);
    var lat1, lon1;

    
      console.log(lat1);
      var mapOptions = {
       center: {lat: parseFloat('<?php echo $latitud; ?>'), lng: parseFloat('<?php echo $longitud; ?>')},
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP};
        map = new google.maps.Map(document.getElementById("map"),mapOptions);
            var marker = new google.maps.Marker({
              position: myLatlng, 
              map: map,
              title:"Hello World!"
          });   
             marker.addListener('click', function() {
              infowindow.open(map, marker);
            });
             var infowindow = new google.maps.InfoWindow({
              content: "Localizcion"
            });
      }  
      
      var myLatlng = {lat: parseFloat('<?php echo $latitud; ?>'), lng: parseFloat('<?php echo $longitud; ?>')};

      
</script>
<style type="text/css">
  #map { height: 50%; width: 100% }
</style>
@section('javascript')





@stop