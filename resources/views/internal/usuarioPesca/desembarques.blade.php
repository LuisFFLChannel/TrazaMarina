@extends('layout.usuarioPesca')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Desembarques
@stop

@section('content')

<table class="table table-bordered table-striped">
    <tr>
        <th class="text-center">Numero</th>
        <th class="text-center">Embarcacion</th>
        <th class="text-center">Puerto Arribo</th>   
        <th class="text-center">DPA</th>
        <th class="text-center">Pesca</th>
        <!--<th>Imagen</th>-->
        <th class="text-center">Detalle</th>
        <th class="text-center">Editar</th>
        <th class="text-center">Ver C.Arribo</th>
        <th class="text-center">Mostrar C.Arribo</th>
        <!--<th class="text-center">Eliminar</th>-->
    </tr>
    
    @foreach($desembarques as $desembarque)
    <tr>
      <td class="text-center">{{$desembarque->id}}</td>
      <td class="text-center">{{$desembarque->embarcacion->nMatricula}} - {{$desembarque->embarcacion->nombre}}</td>
      <td class="text-center">{{$desembarque->puerto->nombre}}</td>
      <td class="text-center">{{$desembarque->dpa->nombre}}</td>
      <td class="text-center">{{$desembarque->pesca->id}}</td>
  
      
      <td class="text-center">
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$desembarque->id}}"><i class="glyphicon glyphicon-plus"></i></a>
            <div class="modal fade" id="edit{{$desembarque->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-left" id="myModalLabel">Detalle del Desembarque</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                          <h5 class="text-left">Numero: {{$desembarque->id}} </h5>
                          <h5 class="text-left">Embarcacion: {{$desembarque->embarcacion->nMatricula}} - {{$desembarque->embarcacion->nombre}}</h5> 
                          <h5 class="text-left">Puerto de Arribo: {{$desembarque->puerto->nombre}}</h5>                                
                          <h5 class="text-left">Dpa: {{$desembarque->dpa->nombre}}</h5> 
                          <h5 class="text-left">Fecha de Arribo: {{date_format(date_create($desembarque->fechaLlegada),"d/m/Y") }}</h5> 
                          <h5 class="text-left">Numero de Pesca: {{$desembarque->pesca->id}}</h5> 
                          <h5 class="text-left">Fecha Zarpe: {{date_format(date_create($desembarque->pesca->fechaZarpe),"d/m/Y")}}</h5> 
                          <h5 class="text-left">Puerto Zarpe: {{$desembarque->pesca->puerto->nombre}}</h5> 
                          @if($desembarque->certificadoArribo!=null)
                            <h5 class="text-left">Certificado Arribo: {{$desembarque->certificadoArribo->nombre}}</h5> 
                          @else
                            <h5 class="text-left">Certificado Arribo: No Esta asociado aun</h5>
                          @endif  
                        
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
        <a class="btn btn-info" href="{{url('usuarioPesca/desembarques/'.$desembarque->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" href="{{url('usuarioPesca/desembarques/'.$desembarque->id.'/editCertificado')}}" title="Modificar Certificado de Arribo" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td class="text-center">
        <a class="btn btn-info" href="{{url('usuarioPesca/desembarques/'.$desembarque->id.'/showCertificado')}}" title="Visualizar Certificado de Arribo" ><i class="glyphicon glyphicon-plus"></i></a>
      </td> 
      
      <!--<td class="text-center">
        <a class="btn btn-info" title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$desembarque->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
      </td>-->
    
    </tr>

    <!-- MODAL -->
    <!--<div class="modal fade"  id="deleteModal{{$desembarque->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">¿Estas seguro que desea eliminar el desembarque ?</h4>
          </div>
          <div class="modal-body">
            <h5 class="modal-title">Los cambios serán permanentes</h5>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
              <a class="btn btn-info" href="{{url('usuarioDesembarque/desembarques/'.$desembarque->id.'/delete')}}" title="Delete" >Sí</a>
          </div>
        </div>
      </div>
    </div>-->
   
    @endforeach
    
</table>

{!!$desembarques->render()!!}
@stop

@section('javascript')

 
@stop