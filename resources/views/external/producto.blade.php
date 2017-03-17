@extends('layoutExternal')

@section('style')
@stop

@section('title')
	Producto Encontrado: 
@stop

@section('content')
<script  type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoElgDQ21cdBJtVLgvpFB8ywDLqhn4cKI&callback=myMaps"></script> 
    
    {!! Form::hidden('auxData', $producto, ['aux'=>'auxData'])!!}
    {!! Form::hidden('codigo', $codigoTrazabilidad, ['cod'=>'codigo'])!!}
    {!! Form::hidden('tipoProducto', $tipoProducto, ['tipo'=>'tipoProducto'])!!}
    <h4> Codigo: {{$codigoTrazabilidad}} </h4>
    <br>
    <div class="row" id ="boxProducto">
        
            <div class="col-sm-4">
                    
                    <h4> Especie Marina Pescada: </h4>
                          <h5 class="text-left">Nombre: {{$especieMarina->nombre}} </h5>
                          <h5 class="text-left">Nombre Cientifico: {{$especieMarina->nombreCientifico}} </h5>                        
                          <h5 class="text-left">Promedio de Vida: {{$especieMarina->promedioVida}} años </h5>        
                          <h5 class="text-left">Tamano Minimo: {{$especieMarina->tamanoMin}}</h5> 
                          <h5 class="text-left">Tamano Maximo:  {{$especieMarina->tamanoMax}}</h5>     
                          <h5 class="text-left">Inicio de Veda: {{date_format(date_create($especieMarina->inicioVeda),"d/m")}} </h5>
                          <h5 class="text-left">Fin de Veda: {{date_format(date_create($especieMarina->finVeda),"d/m")}}</h5>    
                          <p class="text-left">{!! Html::image($especieMarina->imagen, null, array('class'=>'cat_img')) !!}</p>
                
            </div>
            <div class="col-sm-4">
                
                    <h4> Embarcación Utilizada: </h4>
                        <h5 class="text-left">Nombre: {{$embarcacion->nombre}} </h5>
                          <h5 class="text-left">N° Matricula: {{$embarcacion->nMatricula}} </h5>                              
                          <h5 class="text-left">Dueño: {{$embarcacion->nombreDueno}} {{$embarcacion->apellidoDueno}}</h5> 
                          <h5 class="text-left">Capacidad: {{$embarcacion->capacidad}}</h5> 
                          <h5 class="text-left">Estara: {{$embarcacion->estara}}</h5> 
                          <h5 class="text-left">Manga: {{$embarcacion->manga}}</h5> 
                          <h5 class="text-left">Puntual: {{$embarcacion->puntual}}</h5> 
                          <p class="text-left">{!! Html::image($embarcacion->imagen, null, array('class'=>'cat_img')) !!}</p>

                
            </div>   
            <div class="col-sm-4">
                  <div class="container">
                    <h4> Ubicación de la pesca: </h4>
                          <h5 class="text-left">Latitud: {{$pesca->coordenadaX}} </h5>
                          <h5 class="text-left">Longitud: {{$pesca->coordenadaY}} </h5>
                  </div>
                  <div class="container">                              
                            <div class="text-left" id="map"></div>
                  </div>

                
            </div>   
           
        
    </div>
    <br>
        <div class="row" id ="boxProducto">
            <div class="col-sm-1"></div>
            <div class="col-sm-5">
                
                    <h4> Puerto Zarpe: </h4>
                          <h5 class="text-left">Nombre: {{$puertoZ->nombre}} </h5>
                          <h5 class="text-left">Dirección: {{$puertoZ->direccion}} </h5>                        
                          <h5 class="text-left">Latitud: {{$puertoZ->coordenadaX}} </h5>        
                          <h5 class="text-left">Longitud: {{$puertoZ->coordenadaY}}</h5>     
                          <h5 class="text-left">Fecha Zarpe: {{date_format(date_create($pesca->fechaZarpe),"d/m/Y")}}</h5>                           
                          <p class="text-left">{!! Html::image($puertoZ->imagen, null, array('class'=>'cat_img')) !!}</p>
                          <div class="text-left" id="map2"></div>
                
            </div>
            <div class="col-sm-1"></div> 
            <div class="col-sm-5">
                
                    <h4> Puerto Arribo: </h4>
                          <h5 class="text-left">Nombre: {{$puertoA->nombre}} </h5>
                          <h5 class="text-left">Dirección: {{$puertoA->direccion}} </h5>                        
                          <h5 class="text-left">Latitud: {{$puertoA->coordenadaX}} </h5>        
                          <h5 class="text-left">Longitud: {{$puertoA->coordenadaY}}</h5>     
                          <h5 class="text-left">Fecha Arribo: {{date_format(date_create($desembarque->fechaLlegada),"d/m/Y")}}</h5>                           
                          <p class="text-left">{!! Html::image($puertoA->imagen, null, array('class'=>'cat_img')) !!}</p>
                          <div class="text-left" id="map3"></div>
                

                
            </div>  
            
            
           
        
    </div>
    <br>
    @if($tipoProducto!=3)
    <div class="row" id ="boxProducto">
        
            <div class="col-sm-4">
                
                    @if ($tipoProducto==1)
                    <h4> Fábrica: </h4>
                        <h5 class="text-left">Nombre: {{$producto->certificado->fabrica->nombre}} </h5>
                          <h5 class="text-left">Dirección: {{$producto->certificado->fabrica->direccion}} </h5>                        
                          <h5 class="text-left">Latitud: {{$producto->certificado->fabrica->coordenadaX}} </h5>        
                          <h5 class="text-left">Longitud: {{$producto->certificado->fabrica->coordenadaY}}</h5> 
                           <p class="text-left">{!! Html::image($producto->certificado->fabrica->imagen, null, array('class'=>'cat_img')) !!}</p>
                    @elseif ($tipoProducto==2)
                    <h4> Terminal: </h4>
                        <h5 class="text-left">Nombre: {{$producto->certificadoTerminal->terminal->nombre}} </h5>
                          <h5 class="text-left">Dirección: {{$producto->certificadoTerminal->terminal->direccion}} </h5>                        
                          <h5 class="text-left">Latitud: {{$producto->certificadoTerminal->terminal->coordenadaX}} </h5>        
                          <h5 class="text-left">Longitud: {{$producto->certificadoTerminal->terminal->coordenadaY}}</h5> 
                          <p class="text-left">{!! Html::image($producto->certificadoTerminal->terminal->imagen, null, array('class'=>'cat_img')) !!}</p>

                    @endif
                
            </div>
            <div class="col-sm-4">
                @if ($tipoProducto==1)
                    <h4> Transportista: </h4>
                        <h5 class="text-left">Nombres del Transportista: {{$producto->certificado->transportista->nombres}} </h5>
                          <h5 class="text-left">Apellidos : {{$producto->certificado->transportista->apellidos}} </h5>                              
                          <h5 class="text-left">Dni: {{$producto->certificado->transportista->dni}}<h5> 
                          <h5 class="text-left">Telefono: {{$producto->certificado->transportista->telefono}}</h5> 
                          <h5 class="text-left">Correo: {{$producto->certificado->transportista->correo}}</h5> 
                          <h5 class="text-left">Brevete: {{$producto->certificado->transportista->brevete}}</h5>

                          <h5 class="text-left">Nombre del Frigorifico: {{$producto->certificado->frigorifico->nombre}} </h5>
                          <h5 class="text-left">Placa: {{$producto->certificado->frigorifico->placa}} </h5>                              
                          <h5 class="text-left">Capacidad: {{$producto->certificado->frigorifico->capacidad}}</h5> 

                       
                    @elseif ($tipoProducto==2)
                    <h4> Transportista: </h4>
                          <h5 class="text-left">Nombres del Transportista: {{$producto->certificadoTerminal->transportista->nombres}} </h5>
                          <h5 class="text-left">Apellidos del Transportista: {{$producto->certificadoTerminal->transportista->apellidos}} </h5>                              
                          <h5 class="text-left">Dni: {{$producto->certificadoTerminal->transportista->dni}}<h5> 
                          <h5 class="text-left">Telefono: {{$producto->certificadoTerminal->transportista->telefono}}</h5> 
                          <h5 class="text-left">Correo: {{$producto->certificadoTerminal->transportista->correo}}</h5> 
                          <h5 class="text-left">Brevete: {{$producto->certificadoTerminal->transportista->brevete}}</h5> 
                          <h5 class="text-left">Nombre del Frigorifico: {{$producto->certificadoTerminal->frigorifico->nombre}} </h5>
                          <h5 class="text-left">Placa: {{$producto->certificadoTerminal->frigorifico->placa}} </h5>                              
                          <h5 class="text-left">Capacidad: {{$producto->certificadoTerminal->frigorifico->capacidad}}</h5> 

                    @endif
         


            </div>


           
        
    </div>
    @endif
    <br>
    <div class="row">
        <div class="col-sm-5">
      
        </div>
        <div class="col-sm-7">
         
               
                @if ($usuario!= null && $usuario->role_id != config('constants.client'))
                    @if ($usuario!= null && $usuario->role_id == config('constants.admin'))
                      <a href="{{url('admin/codigoTrazabilidad/documentos/'.$codigoTrazabilidad.'/'.$tipoProducto.' ')}}" title="Documentos" ><button  type="button" class="btn btn-info">Documentos</button></a>
                    @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioPesca')) 
                      <a href="{{url('usuarioPesca/codigoTrazabilidad/documentos/'.$codigoTrazabilidad.'/'.$tipoProducto.' ')}}" title="Documentos" ><button  type="button" class="btn btn-info">Documentos</button></a>
                    @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioIntermediario')) 
                      <a href="{{url('usuarioIntermediario/codigoTrazabilidad/documentos/'.$codigoTrazabilidad.'/'.$tipoProducto.' ')}}" title="Documentos" ><button  type="button" class="btn btn-info">Documentos</button></a>
                    @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioValidacion'))
                      <a href="{{url('usuarioValidacion/codigoTrazabilidad/documentos/'.$codigoTrazabilidad.'/'.$tipoProducto.' ')}}" title="Documentos" ><button  type="button" class="btn btn-info">Documentos</button></a>
                    @elseif ($usuario!= null && $usuario->role_id == config('constants.clientMaster'))
                      <a href="{{url('clientMaster/codigoTrazabilidad/documentos/'.$codigoTrazabilidad.'/'.$tipoProducto.' ')}}" title="Documentos" ><button  type="button" class="btn btn-info">Documentos</button></a>
                    @endif
                @endif
                <a href="{{URL('/')}}"> <button  type="button" class="btn btn-info">Regresar</button></a>
          
        </div>
    </div>
      

@stop

@section('javascript')
<script type="text/javascript">
  /*  $( document ).ready(function() {
        $('#searchButton').on('click',function(){
            var titulo = $('#textSearch').val();
            $('#searchButton').attr('href', 'event?title='+titulo);
        });
    });*/
</script>
<script type="text/javascript">
  function myMaps() {
    //var element = document.createElement("map");
    //element.appendChild(document.createTextNode('The man who mistook his wife for a hat'));
    //document.getElementById('modeloModal').appendChild(element);
    var lat1, lon1;

    
      console.log('<?php echo $pesca->coordenadaX; ?>');
      var mapOptions = {
       center: {lat: parseFloat('<?php echo $pesca->coordenadaX; ?>'), lng: parseFloat('<?php echo $pesca->coordenadaY; ?>')},
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
              content: "Localizacion"
            });

          console.log('<?php echo $puertoZ->coordenadaX; ?>');
          var mapOptions2 = {
           center: {lat: parseFloat('<?php echo $puertoZ->coordenadaX; ?>'), lng: parseFloat('<?php echo $puertoZ->coordenadaY; ?>')},
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP};
            map2 = new google.maps.Map(document.getElementById("map2"),mapOptions2);
                var marker2 = new google.maps.Marker({
                  position: myLatlng2, 
                  map: map2,
                  title:"Hello World!"
              });   
                 marker2.addListener('click', function() {
                  infowindow2.open(map2, marker2);
                });
                 var infowindow2 = new google.maps.InfoWindow({
                  content: "Localizacion"
                });

            console.log('<?php echo $puertoA->coordenadaX; ?>');
          var mapOptions3 = {
           center: {lat: parseFloat('<?php echo $puertoA->coordenadaX; ?>'), lng: parseFloat('<?php echo $puertoA->coordenadaY; ?>')},
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP};
            map3 = new google.maps.Map(document.getElementById("map3"),mapOptions3);
                var marker3 = new google.maps.Marker({
                  position: myLatlng3, 
                  map: map3,
                  title:"Hello World!"
              });   
                 marker3.addListener('click', function() {
                  infowindow3.open(map3, marker3);
                });
                 var infowindow3 = new google.maps.InfoWindow({
                  content: "Localizacion"
                });
           

    
      }  


      
      var myLatlng = {lat: parseFloat('<?php echo $pesca->coordenadaX; ?>'), lng: parseFloat('<?php echo $pesca->coordenadaY; ?>')};
      var myLatlng2 = {lat: parseFloat('<?php echo $puertoZ->coordenadaX; ?>'), lng: parseFloat('<?php echo $puertoZ->coordenadaY; ?>')};
      var myLatlng3 = {lat: parseFloat('<?php echo $puertoA->coordenadaX; ?>'), lng: parseFloat('<?php echo $puertoA->coordenadaY; ?>')};
      

</script>
<style type="text/css">
  #map { height: 250px; width: 250px }
  #map2 { height: 250px; width: 250px }
  #map3 { height: 250px; width: 250px }
 
  #boxProducto {border-style: solid; border-color: black; border-width:1px}
</style>
@stop