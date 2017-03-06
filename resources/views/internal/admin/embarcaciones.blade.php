@extends('layout.admin')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Embarcaciones
@stop

@section('content')

<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">Nombre</th>
        <th class="text-center">N° Matricula</th>   
        <!--<th>Imagen</th>-->
        <th class="text-center">Detalle</th>
        <th class="text-center">Editar</th>
        <th class="text-center">Cambiar C.Matricula</th>
        <th class="text-center">Ver C.Matricula</th>
        <th class="text-center">Cambiar P.Pesca</th>
        <th class="text-center">Ver P.Pesca</th>
        <th class="text-center">Eliminar</th>
        
    </tr>
    
    @foreach($embarcaciones as $embarcacion)
    <tr>
      <td class="text-center">{{$embarcacion->nombre}}</td>
      <td class="text-center">{{$embarcacion->nMatricula}}</td>
      <!--<td>{!! Html::image($embarcacion->imagen, null, array('class'=>'gift_img')) !!}</td>-->
      <td class="text-center">
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$embarcacion->id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$embarcacion->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left" id="myModalLabel">Detalle de la Embarcacion</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          <h5 class="text-left">Nombre: {{$embarcacion->nombre}} </h5>
                          <h5 class="text-left">N° Matricula: {{$embarcacion->direccion}} </h5>                              
                          <h5 class="text-left">Dueño: {{$embarcacion->armador->nombres}} {{$embarcacion->armador->apellidos}}</h5> 
                          <h5 class="text-left">Capacidad: {{$embarcacion->capacidad}}</h5> 
                          <h5 class="text-left">Estara: {{$embarcacion->estara}}</h5> 
                          <h5 class="text-left">Manga: {{$embarcacion->manga}}</h5> 
                          <h5 class="text-left">Puntual: {{$embarcacion->puntual}}</h5> 

                          <h5 class="text-left">Imagen:</h5> 
                          <p class="text-left">{!! Html::image($embarcacion->imagen, null, array('class'=>'gift_img')) !!}</p>
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
        <a class="btn btn-info" href="{{url('admin/embarcaciones/'.$embarcacion->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" href="{{url('admin/embarcaciones/'.$embarcacion->id.'/editCertificado')}}" title="Modificar Certificado de Matricula" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" href="{{url('admin/embarcaciones/'.$embarcacion->id.'/showCertificado')}}" title="Visualizar Certificado de Matricula" ><i class="glyphicon glyphicon-plus"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" href="{{url('admin/embarcaciones/'.$embarcacion->id.'/editPermiso')}}" title="Modificar Permiso de Pesca" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" href="{{url('admin/embarcaciones/'.$embarcacion->id.'/showPermiso')}}" title="Visualizar Permiso de Pesca" ><i class="glyphicon glyphicon-plus"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$embarcacion->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
      </td>
      
    </tr>

    <!-- MODAL -->
    <div class="modal fade"  id="deleteModal{{$embarcacion->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">¿Estas seguro que desea eliminar la embarcacion?</h4>
          </div>
          <div class="modal-body">
            <h5 class="modal-title">Los cambios serán permanentes</h5>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
              <a class="btn btn-info" href="{{url('admin/embarcaciones/'.$embarcacion->id.'/delete')}}" title="Delete" >Sí</a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
   
    @endforeach
    
</table>

{!!$embarcaciones->render()!!}
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