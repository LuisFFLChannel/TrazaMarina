@extends('layout.admin')

@section('style')

@stop

@section('title')
  Lista de Cliente Maestro
@stop

@section('content')
        <!-- Contenido-->
        <table class="table table-bordered table-striped">
            <tr>
                <th>Apellidos y Nombres</th>
                <th>Documento Identidad</th>
                <th>Número de Documento</th>
                <th>Teléfono</th>
                <th>Detalle</th>
                <th>Desactivar</th>
            </tr>

            @foreach($clientsMaster as $clientMaster)
            <tr>
                <td>{{$clientMaster->lastname}}, {{$clientMaster->name}}</td>
                <td>@if($clientMaster->di_type == config('constants.national'))
                    DNI
                    @elseif ($clientMaster->di_type == config('constants.international'))
                    Carnet de Extranjeria
                    @else
                    Pasaporte
                    @endif</td>
                <td>{{$clientMaster->di}}</td>
                <td>{{$clientMaster->phone}}</td>
                <td><a class="btn btn-info" href="#" title="Detalles"  data-toggle="modal" data-target="#edit"><i class="glyphicon glyphicon-plus"></i></a>
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Detalle del clientMastere</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Nombre</h4>
                            {{$clientMaster->lastname}}, {{$clientMaster->name}}
                            <h4>Documento Identidad</h4>
                            @if($clientMaster->di_type == config('constants.national'))
                            DNI
                            @elseif ($clientMaster->di_type == config('constants.international'))
                            Carnet de Extranjeria
                            @else
                            Pasaporte
                            @endif
                            <h4>Número de Documento</h4>
                            {{$clientMaster->di}}
                            <h4>Teléfono</h4>
                            {{$clientMaster->phone}}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </td>
                <td>
                  <a class="btn btn-info" href="" title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$clientMaster->id}}"><i class="glyphicon glyphicon-remove"></i></a>
                  <div class="modal fade"  id="deleteModal{{$clientMaster->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">¿Estas seguro que desea desactivar clientMastere?</h4>
                        </div>
                        <div class="modal-body">
                          <h5 class="modal-title">Los cambios serán permanentes</h5>
                        </div>
                        <div class="modal-footer">
                          {!!Form::open(array('url' => 'admin/clientMaster/desactive','id'=>'form','class'=>'form-horizontal'))!!}
                            <input type="hidden" value="{{$clientMaster->id}}" name="clientMaster_id">
                            <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                            <input type="submit" class="btn btn-info" value="Si">
                          {!! Form::close() !!}
                        </div>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
                  <!--ERROR DE BORRAR clientMasterE: Habian 2 modales y se llamaba al segundo que era antiguo e iba a otra ruta-->
                </td>
            </tr>
            @endforeach
        </table>
         {!!$clientsMaster->render()!!}
@stop

@section('javascript')

@stop