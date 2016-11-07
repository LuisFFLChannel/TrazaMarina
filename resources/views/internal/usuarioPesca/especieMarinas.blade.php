@extends('layout.usuarioPesca')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Especies Marinas
@stop

@section('content')
<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">Nombre</th>
        <th class="text-center">Nombre Cientifico</th>   
        <th class="text-center">Inicio Veda</th>
        <th class="text-center">Fin de Veda</th>
        <!--<th>Imagen</th>-->
        <th class="text-center">Detalle</th>
        <th class="text-center">Editar</th>
        <th class="text-center">Eliminar</th>
    </tr>
    
    @foreach($especies as $especie)
    <tr>
      <td class="text-center">{{$especie->nombre}}</td>
      <td class="text-center">{{$especie->nombreCientifico}}</td>
      <td class="text-center">{{date_format(date_create($especie->inicioVeda),"d/M")}}</td>
      <td class="text-center">{{date_format(date_create($especie->finVeda),"d/M")}}</td>
      <!--<td>{!! Html::image($especie->imagen, null, array('class'=>'gift_img')) !!}</td>-->
      <td class="text-center">
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$especie->id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$especie->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left" id="myModalLabel">Detalle de la Especie Marina/h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          <h5 class="text-left">Nombre: {{$especie->nombre}} </h5>
                          <h5 class="text-left">Nombre Cientifico: {{$especie->nombreCientifico}} </h5>                        
                          <h5 class="text-left">Promedio de Vida: {{$especie->promedioVida}} años </h5>        
                          <h5 class="text-left">Tamano Minimo: {{$especie->tamanoMin}}</h5> 
                          <h5 class="text-left">Tamano Maximo:  {{$especie->tamanoMax}}</h5>     
                          <h5 class="text-left">Inicio de Veda: {{date_format(date_create($especie->inicioVeda),"d/M")}} </h5>
                          <h5 class="text-left">Fin de Veda: {{date_format(date_create($especie->finVeda),"d/M")}}</h5>    
                          <h5 class="text-left">Promedio de Pesca: {{$especie->pescaPromedio}}</h5>                       
                          <hr>
                          <p class="text-left">{!! Html::image($especie->imagen, null, array('class'=>'gift_img')) !!}</p>
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
        <a class="btn btn-info" href="{{url('usuarioPesca/especieMarinas/'.$especie->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$especie->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
      </td>
    </tr>

    <!-- MODAL -->
    <div class="modal fade"  id="deleteModal{{$especie->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">¿Estas seguro que desea eliminar la Especie Marina?</h4>
          </div>
          <div class="modal-body">
            <h5 class="modal-title">Los cambios serán permanentes</h5>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
              <a class="btn btn-info" href="{{url('usuarioPesca/especiesMarina/'.$especie->id.'/delete')}}" title="Delete" >Sí</a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @endforeach
    
</table>

{!!$especies->render()!!}
@stop

@section('javascript')

@stop