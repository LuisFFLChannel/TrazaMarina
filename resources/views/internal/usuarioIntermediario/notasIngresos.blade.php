@extends('layout.usuarioIntermediario')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Notas de Ingreso
@stop

@section('content')

<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">Numero</th>
        <th class="text-center">Especie Marina</th>
        <th class="text-center">Desembarque</th>
        <th class="text-center">Pesca</th>  
        <th class="text-center">Toneladas</th>
        
        <!--<th>Imagen</th>-->
        <th class="text-center">Detalle</th>
        <th class="text-center">Ver Codigo Traza.</th>

        <!--<th class="text-center">Eliminar</th>-->
    </tr>
    
    @foreach($notaIngresos as $notaIngreso)
    <tr>
      <td class="text-center">{{$notaIngreso->id}}</td>
      <td class="text-center">{{$notaIngreso->especieMarina->nombre}}</td>
      <td class="text-center">{{$notaIngreso->desembarque->id}}</td>
      <td class="text-center">{{$notaIngreso->desembarque->pesca->id}}</td>
      <td class="text-center">{{$notaIngreso->toneladas}}</td>
  
      
      <td class="text-center">
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$notaIngreso->id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$notaIngreso->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left" id="myModalLabel">Detalle de la Nota</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          <h5 class="text-left">Numero: {{$notaIngreso->id}} </h5>
                          <h5 class="text-left">Especie Marina: {{$notaIngreso->especieMarina->id}} - {{$notaIngreso->especieMarina->nombre}}</h5> 
                          <h5 class="text-left">Desembarque: {{$notaIngreso->desembarque->id}}</h5>                                
                          <h5 class="text-left">Pesca: {{$notaIngreso->desembarque->pesca->id}}</h5> 
                          <h5 class="text-left">Toneladas: {{$notaIngreso->toneladas}}</h5> 
                          <h5 class="text-left">Talla Promedio: {{$notaIngreso->tallaPromedio}}</h5> 
                          <h5 class="text-left">Toneladas para Exportacion: {{$notaIngreso->toneladasExportacion}}</h5> 
                          <h5 class="text-left">Toneladas para Mercado: {{$notaIngreso->toneladasMercado}}</h5> 
                        
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
            <a class="btn btn-info" href="{{url('usuarioIntermediario/notasIngresos/'.$notaIngreso->id.'/mostrarTrazabiliadad')}}" title="Editar" ><i class="glyphicon glyphicon-plus"></i></a>
        </td> 
    </tr>
   
    @endforeach
    
</table>

{!!$notaIngresos->render()!!}
@stop

@section('javascript')

 
@stop