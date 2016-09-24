@extends('layout.admin')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Especies Marinas
@stop

@section('content')
<table class="table table-bordered table-striped">
    <tr>
        <th>Nombre</th>
        <th>Nombre Cientifico</th>   
        <th>Inicio Veda</th>
        <th>Fin de Veda</th>
        <!--<th>Imagen</th>-->
        <th>Detalle</th>
        <th>Editar</th>
        <th>Eliminar</th>
    </tr>
    
    @foreach($especies as $especie)
    <tr>
      <td>{{$especie->nombre}}</td>
      <td>{{$especie->nombreCientifico}}</td>
      <td>{{date_format(date_create($especie->inicioVeda),"d/M")}}</td>
      <td>{{date_format(date_create($especie->finVeda),"d/M")}}</td>
      <!--<td>{!! Html::image($especie->imagen, null, array('class'=>'gift_img')) !!}</td>-->
      <td>
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$especie->id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$especie->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detalle de la Especie Marina/h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          <h5>Nombre: {{$especie->nombre}} </h5>
                          <h5>Nombre Cientifico: {{$especie->nombreCientifico}} </h5>                        
                          <h5>Promedio de Vida: {{$especie->promedioVida}} años </h5>        
                          <h5>Tamano Minimo: {{$especie->tamanoMin}}</h5> 
                          <h5>Tamano Maximo:  {{$especie->tamanoMax}}</h5>     
                          <h5>Inicio de Veda: {{date_format(date_create($especie->inicioVeda),"d/M")}} </h5>
                          <h5>Fin de Veda: {{date_format(date_create($especie->finVeda),"d/M")}}</h5>    
                          <h5>Promedio de Pesca: {{$especie->pescaPromedio}}</h5>                       
                          <hr>
                          <p>{!! Html::image($especie->imagen, null, array('class'=>'gift_img')) !!}</p>
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
      <td>
        <a class="btn btn-info" href="{{url('admin/especieMarinas/'.$especie->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td>
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
              <a class="btn btn-info" href="{{url('admin/especiesMarina/'.$especie->id.'/delete')}}" title="Delete" >Sí</a>
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