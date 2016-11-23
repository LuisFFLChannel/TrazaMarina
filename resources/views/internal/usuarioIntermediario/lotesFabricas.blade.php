@extends('layout.usuarioIntermediario')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Lotes por Fabricas
@stop

@section('content')

<table class="table table-bordered table-striped">

    <tr>
        
        <th class="text-center">N° de Nota Ingreso</th>
        <th class="text-center">Especie Marina</th>
        <th class="text-center">Codigo Cert. Procedencia</th>
        <th class="text-center">Toneladas</th>
        <th class="text-center">Fabrica</th>
        <!--<th class="text-center">Transportista</th>
        <th class="text-center">Frigorífico</th>-->
        <th class="text-center">Detalle</th>
        <th class="text-center">Crear/Actualizar Codigo Traza.</th>
        <th class="text-center">Ver Codigo Traza.</th>
    </tr> 
    
    @foreach($lista_Fabricas as $lote)
    <tr>
      
      <td class="text-center">{{$lote->nota->id}}</td>
      <td class="text-center">{{$lote->nota->especieMarina->nombre}}</td>
      <td class="text-center">{{$lote->certificado_id}}</td>
      <td class="text-center">{{$lote->toneladas}}</td>
      <td class="text-center">{{$lote->certificado->fabrica->nombre}}</td>
      
      <!--<td class="text-center">{{$lote->nota->desembarque->id}}</td>
      <td class="text-center">{{$lote->nota->desembarque->pesca->id}}</td>-->

  
      <td class="text-center">
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$lote->nota->id}}{{$lote->certificado_id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$lote->nota->id}}{{$lote->certificado_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left" id="myModalLabel">Detalle del Lote por Fabrica</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          
                          <h5 class="text-left">N° de Nota de Ingreso: {{$lote->nota->id}} </h5>
                          <h5 class="text-left">Especie Marina: {{$lote->nota->especieMarina->id}} - {{$lote->nota->especieMarina->nombre}}</h5> 
                          <h5 class="text-left">Codigo Cert. Procedencia: {{$lote->certificado_id}}</h5>
                          <h5 class="text-left">Toneladas del Lote: {{$lote->toneladas}}</h5>
                          <h5 class="text-left">Fábrica: {{$lote->certificado->fabrica->nombre}}</h5>
                          <h5 class="text-left">Transportista: {{$lote->certificado->transportista->nombres}} {{$lote->certificado->transportista->apellidos}}</h5>
                          <h5 class="text-left">Frigorífico: {{$lote->certificado->frigorifico->nombre}}</h5>
                          <h5 class="text-left">Desembarque: {{$lote->nota->desembarque->id}}</h5>                                
                          <h5 class="text-left">Pesca: {{$lote->nota->desembarque->pesca->id}}</h5>        
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
            <a class="btn btn-info" href="{{url('usuarioIntermediario/lotesFabricas/'.$lote->nota->id.'/'.$lote->certificado_id.'/agregarTrazabilidad')}}" title="Agregar Traza" ><i class="glyphicon glyphicon-pencil"></i></a>
        </td> 
          <td class="text-center">
            <a class="btn btn-info" href="{{url('usuarioIntermediario/lotesFabricas/'.$lote->nota->id.'/'.$lote->certificado_id.'/mostrarTrazabilidad')}}" title="Mostrar Traza" ><i class="glyphicon glyphicon-plus"></i></a>
        </td> 
    </tr>
   
    @endforeach
    
</table>

{!!$lista_Fabricas ->render()!!}
@stop

@section('javascript')

 
@stop