@extends('layout.usuarioIntermediario')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Certificados de Procedencias para Terminales
@stop

@section('content')

<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">N° Documennto</th>
        <th class="text-center">Fabrica</th>   
        <th class="text-center">Transportista</th>
        <th class="text-center">Frigorifico</th>
        <!--<th>Imagen</th>-->
        <th class="text-center">Detalle</th>
        <th class="text-center">Editar</th>
        <th class="text-center">Eliminar</th>
    </tr>
    
    @foreach($transporteTerminales as $transporteTerminal)
    <tr>
      <td class="text-center">{{$transporteTerminal->id}}</td>
      <td class="text-center">{{$transporteTerminal->terminal->nombre}}</td>
      <td class="text-center">{{$transporteTerminal->transportista->nombres}} {{$transporteTerminal->transportista->nombres}}</td>
      <td class="text-center">{{$transporteTerminal->frigorifico->placa}} - {{$transporteTerminal->frigorifico->nombre}}</td>
     
      
      <!--<td>{!! Html::image($transporteTerminal->imagen, null, array('class'=>'gift_img')) !!}</td>-->
      <td class="text-center">
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$transporteTerminal->id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$transporteTerminal->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left" id="myModalLabel">Detalle del Certificado de Matricula</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          <h5 class="text-left">N° Documento: {{$transporteTerminal->id}}</h5>
                          <h5 class="text-left">Transportista: {{$transporteTerminal->transportista->nombres}} {{$transporteTerminal->transportista->apellidos}}</h5>
                          <h5 class="text-left">Terminal: {{$transporteTerminal->terminal->nombre}}</h5>
                          <h5 class="text-left">Frigorifico: {{$transporteTerminal->frigorifico->placa}} - {{$transporteTerminal->frigorifico->nombre}} </h5>
                                  
                          <h5 class="text-left">Fecha de Envio: {{date_format(date_create($transporteTerminal->fechaDictada),"d/m/Y")}} </h5>
                          @if($transporteTerminal->notasIngreso!=null)
                               <h5 class="text-left">Notas de Ingreso: </h5>
                              @foreach($transporteTerminal->notasIngreso as $not)
                                  <h6 class="text-left"> Nota: </h6> 
                                  <h6 class="text-left"> + Codigo de Nota: {{$not->nota->id}} </h6> 
                                  <h6 class="text-left"> + Nombre de la Especie: {{$not->nota->especieMarina->nombre}} </h6>
                                  <h6 class="text-left"> + Embarcacion: {{$not->nota->desembarque->embarcacion->nombre}} </h6>
                                  <h6 class="text-left"> + Toneladas: {{$not->toneladas}} </h6>
                              @endforeach 
                            
                          @else
                            <h5 class="text-left">Notas de Ingreso: No han sido resignado </h5>
                          @endif                              
                          
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          <td class="text-center">
            <a class="btn btn-info" href="{{url('usuarioIntermediario/transporteTerminales/'.$transporteTerminal->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
          </td> 
          <td class="text-center">
            <a class="btn btn-info" title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$transporteTerminal->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
          </td>
        </tr>

        <!-- MODAL -->
        <div class="modal fade"  id="deleteModal{{$transporteTerminal->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">¿Estas seguro que desea eliminar el Certificado Procedencia de Terminal?</h4>
              </div>
              <div class="modal-body">
                <h5 class="modal-title">Los cambios serán permanentes</h5>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                  <a class="btn btn-info" href="{{url('usuarioIntermediario/transporteTerminal/'.$transporteTerminal->id.'/delete')}}" title="Delete" >Sí</a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    @endforeach
    
</table>

{!!$transporteTerminales->render()!!}
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