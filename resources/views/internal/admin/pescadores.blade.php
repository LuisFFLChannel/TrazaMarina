@extends('layout.admin')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Pescadores
@stop

@section('content')

<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">Nombres</th>
        <th class="text-center">Apellidos</th>   
        <th class="text-center">DNI</th>
        <th class="text-center">Detalle</th>
        <th class="text-center">Editar</th>
        <th class="text-center">Cambiar P.Marinero</th>
        <th class="text-center">Ver P.Marinero</th>
        <th class="text-center">Cambiar P.Patron</th>
        <th class="text-center">Ver P.Patron</th>
        <th class="text-center">Eliminar</th>
        
    </tr>
    
    @foreach($pescadores as $pescador)
    <tr>
      <td class="text-center">{{$pescador->nombres}}</td>
      <td class="text-center">{{$pescador->apellidos}}</td>
      <td class="text-center">{{$pescador->dni}}</td>
      <td class="text-center">
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$pescador->id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$pescador->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detalle del pescador</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          <h5>Nombres: {{$pescador->nombres}} </h5>
                          <h5>Apellidos: {{$pescador->apellidos}} </h5>                              
                          <h5>Dni: {{$pescador->dni}}<h5> 
                          <h5>Telefono: {{$pescador->telefono}}</h5> 
                          <h5>Correo: {{$pescador->correo}}</h5> 
                          <h5>Cumpleaños: {{date_format(date_create($pescador->cumpleanos),"d/m/Y")}}</h5> 
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
        <a class="btn btn-info" href="{{url('admin/pescadores/'.$pescador->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td class="text-center"> 
        <a class="btn btn-info" href="{{url('admin/pescadores/'.$pescador->id.'/editPermisoMarinero')}}" title="Modificar Permiso de Marinero" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" href="{{url('admin/pescadores/'.$pescador->id.'/showPermisoMarinero')}}" title="Visualizar Permiso de Marinero" ><i class="glyphicon glyphicon-plus"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" href="{{url('admin/pescadores/'.$pescador->id.'/editPermisoPatron')}}" title="Modificar Permiso de Patron" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" href="{{url('admin/pescadores/'.$pescador->id.'/showPermisoPatron')}}" title="Visualizar Permiso de Patron" ><i class="glyphicon glyphicon-plus"></i></a>
      </td> 
      <td class="text-center"> 
        <a class="btn btn-info" title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$pescador->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
      </td>
      
    </tr>

    <!-- MODAL -->
    <div class="modal fade"  id="deleteModal{{$pescador->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">¿Estas seguro que desea eliminar al pescador?</h4>
          </div>
          <div class="modal-body">
            <h5 class="modal-title">Los cambios serán permanentes</h5>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
              <a class="btn btn-info" href="{{url('admin/pescadores/'.$pescador->id.'/delete')}}" title="Delete" >Sí</a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
   
    @endforeach
    
</table>

{!!$pescadores->render()!!}
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