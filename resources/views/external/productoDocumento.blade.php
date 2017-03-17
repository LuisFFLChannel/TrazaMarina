@extends('layoutExternal')

@section('style')
@stop

@section('title')
	Producto Encontrado: 
@stop

@section('content')


    
    <h4> Codigo: {{$codigoTrazabilidad}} </h4>
    <br>
    <div class="row" id ="boxProducto">
            <h4> Certificado de Matricula </h4>
            @if ($certificadoMatricula!= null)
                <table class="table table-bordered table-striped">
                  <tr>

                      <th class="text-center">Código</th>
                      <th class="text-center">Información</th>
                      <th class="text-center">Documento</th>   
                
                  </tr>
                  
                 
                  <tr>
                    <td class="text-center">
                      <h5 class="text-center">{{$certificadoMatricula->codigo}}</h5>

                    </td>
                    <td class="text-center">
                              <h5 class="text-left">Libro: {{$certificadoMatricula->libro}}</h5>
                              <h5 class="text-left">Folio: {{$certificadoMatricula->folio}}</h5>
                              <h5 class="text-left">Nombre Dueño: {{$certificadoMatricula->nombreDueno}} {{$certificadoMatricula->apellidosDueno}}</h5>
                              <h5 class="text-left">DNI Dueño: {{$certificadoMatricula->dniDueno}}</h5>
                              <h5 class="text-left">Numero de Matricula: {{$certificadoMatricula->nMatricula}} </h5>

                    </td>
                    <td class="text-center">
                        @if ($usuario!= null && $usuario->role_id == config('constants.admin'))
                          <a class="btn btn-info" href="{{url('admin/codigoTrazabilidad/documentos/certificadoMatriculas/'.$certificadoMatricula->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioPesca')) 
                          <a class="btn btn-info" href="{{url('usuarioPesca/codigoTrazabilidad/documentos/certificadoMatriculas/'.$certificadoMatricula->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioIntermediario')) 
                          <a class="btn btn-info" href="{{url('usuarioIntermediario/codigoTrazabilidad/documentos/certificadoMatriculas/'.$certificadoMatricula->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioValidacion'))
                          <a class="btn btn-info" href="{{url('usuarioValidacion/codigoTrazabilidad/documentos/certificadoMatriculas/'.$certificadoMatricula->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.clientMaster'))
                          <a class="btn btn-info" href="{{url('clientMaster/codigoTrazabilidad/documentos/certificadoMatriculas/'.$certificadoMatricula->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @endif
                        
                    </td>
                  </tr>   
              </table>
            @else 
              <h5> No ha sido asociado </h5>
            @endif
           
        
    </div>
    <br>
    <div class="row" id ="boxProducto">
            <h4> Permiso Pesca </h4>
            @if ($permisoPesca!= null)
                <table class="table table-bordered table-striped">
                  <tr>

                      <th class="text-center">Código</th>
                      <th class="text-center">Información</th>
                      <th class="text-center">Documento</th>   
                
                  </tr>
                  
                 
                  <tr>
                    <td class="text-center">
                      <h5 class="text-center">{{$permisoPesca->codigo}}</h5>

                    </td>
                    <td class="text-center">
                              <h5 class="text-left">Numero de Matricula: {{$permisoPesca->nMatricula}} </h5>
                              <h5 class="text-left">Fecha Vigencia: {{date_format(date_create($permisoPesca->fechaVigencia),"d/m/Y")}} </h5>

                    </td>
                    <td class="text-center">
                        @if ($usuario!= null && $usuario->role_id == config('constants.admin'))
                          <a class="btn btn-info" href="{{url('admin/codigoTrazabilidad/documentos/permisoPescas/'.$permisoPesca->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioPesca')) 
                          <a class="btn btn-info" href="{{url('usuarioPesca/codigoTrazabilidad/documentos/permisoPescas/'.$permisoPesca->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioIntermediario')) 
                          <a class="btn btn-info" href="{{url('usuarioIntermediario/codigoTrazabilidad/documentos/permisoPescas/'.$permisoPesca->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioValidacion'))
                          <a class="btn btn-info" href="{{url('usuarioValidacion/codigoTrazabilidad/documentos/permisoPescas/'.$permisoPesca->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.clientMaster'))
                          <a class="btn btn-info" href="{{url('clientMaster/codigoTrazabilidad/documentos/permisoPescas/'.$permisoPesca->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @endif
                        
                    </td>   
                  </tr>
              </table>
            @else 
              <h5> No ha sido asociado </h5>
            @endif
           
        
    </div>
    <br>
    <div class="row" id ="boxProducto">
            <h4> Permiso Zarpe </h4>

            @if ($permisoZarpe!= null)
                <table class="table table-bordered table-striped">
                  <tr>

                      <th class="text-center">Código</th>
                      <th class="text-center">Información</th>
                      <th class="text-center">Documento</th>   
                
                  </tr>
                  
                 
                  <tr>
                    <td class="text-center">
                      <h5 class="text-center">{{$permisoZarpe->codigo}}</h5>

                    </td>
                    <td class="text-center">
                          <h5 class="text-left">N° Documento: {{$permisoZarpe->codigo}}</h5>
                          <h5 class="text-left">Nombre Embarcacion: {{$permisoZarpe->embarcacion->nombre}}</h5>
                          <h5 class="text-left">Numero de Matricula: {{$permisoZarpe->embarcacion->nMatricula}} </h5>
                          <h5 class="text-left">Fecha Zarpe: {{date_format(date_create($permisoZarpe->fechaZarpe),"d/m/Y")}} </h5>
                          <h5 class="text-left">Fecha Arribo: {{date_format(date_create($permisoZarpe->fechaArribo),"d/m/Y")}} </h5>
                          <h5 class="text-left">Capitania Asociada: {{$permisoZarpe->capitania->id}} - {{$permisoZarpe->capitania->nombre}} </h5>
                          <h5 class="text-left">Puerto de Zarpe: {{$permisoZarpe->puerto->id}} - {{$permisoZarpe->puerto->nombre}} </h5>
                          <h5 class="text-left">Patron: </h5>
                          @if($permisoZarpe->patron!=null)
                              @foreach($permisoZarpe->patron as $pes)
                                  <h6 class="text-center">DNI - Nombre: {{$pes->dni}} - {{$pes->apellidos}}, {{$pes->nombres}}</h5> 
                              @endforeach
                          @endif 
                          <h5 class="text-left">Pescadores: </h5>
                          @if($permisoZarpe->marineros!=null)
                              @foreach($permisoZarpe->marineros as $pes)
                                  <h6 class="text-center">DNI - Nombre: {{$pes->dni}} - {{$pes->apellidos}}, {{$pes->nombres}}</h5> 
                              @endforeach                    
                          @endif 

                    </td>
                    <td class="text-center">
                        @if ($usuario!= null && $usuario->role_id == config('constants.admin'))
                          <a class="btn btn-info" href="{{url('admin/codigoTrazabilidad/documentos/permisoZarpes/'.$permisoZarpe->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioPesca')) 
                          <a class="btn btn-info" href="{{url('usuarioPesca/codigoTrazabilidad/documentos/permisoZarpes/'.$permisoZarpe->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioIntermediario')) 
                          <a class="btn btn-info" href="{{url('usuarioIntermediario/codigoTrazabilidad/documentos/permisoZarpes/'.$permisoZarpe->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.usuarioValidacion'))
                          <a class="btn btn-info" href="{{url('usuarioValidacion/codigoTrazabilidad/documentos/permisoZarpes/'.$permisoZarpe->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @elseif ($usuario!= null && $usuario->role_id == config('constants.clientMaster'))
                          <a class="btn btn-info" href="{{url('clientMaster/codigoTrazabilidad/documentos/permisoZarpes/'.$permisoZarpe->id.'/showPDF')}}" title="Descargar" ><i class="glyphicon glyphicon-download-alt"></i></a>
                        @endif
                        
                    </td>   
                  </tr>
              </table>
            @else 
              <h5> No ha sido asociado </h5>
            @endif
            
           
        
    </div>
    <br>
    <div class="row" id ="boxProducto">
            <h4> Certificado Arribo </h4>
            
           @if ($certificadoArribo!= null)
             
                  
                    <table class="table table-bordered table-striped">
                  <tr>

                      <th class="text-center">Código</th>
                      <th class="text-center">Información</th>
                      <!--<th class="text-center">Documento</th>   -->
                
                  </tr>
                  <tr>
                    <td class="text-center">
                      <h5 class="text-center">{{$certificadoArribo->codigo}}</h5>

                    </td>
                    <td class="text-center">
                          <h5 class="text-left">Numero de Matricula: {{$certificadoArribo->nMatricula}} </h5>
                          <h5 class="text-left">Fecha de Arribo: {{date_format(date_create($certificadoArribo->fechaArribo),"d/m/Y")}} </h5>

                    </td>

                  </tr>
              </table>
            @else 
              <h5> No ha sido asociado </h5>
            @endif
        
    </div>
    <br>
    @if($tipoProducto==1)
      <div class="row" id ="boxProducto">
              <h4> Certificado Procedencia a Fábrica </h4>

              @if ($certificadoProcedencia!= null)
             
                  
                    <table class="table table-bordered table-striped">
                  <tr>

                      <th class="text-center">Código</th>
                      <th class="text-center">Información</th>
                      <!--<th class="text-center">Documento</th>   -->
                
                  </tr>
                  <tr>
                    <td class="text-center">
                      <h5 class="text-center">{{$certificadoProcedencia->codigo}}</h5>

                    </td>
                    <td class="text-center">
                          <h5 class="text-left">Transportista: {{$certificadoProcedencia->transportista->nombres}} {{$certificadoProcedencia->transportista->apellidos}}</h5>
                          <h5 class="text-left">Fabrica: {{$certificadoProcedencia->fabrica->nombre}}</h5>
                          <h5 class="text-left">Frigorifico: {{$certificadoProcedencia->frigorifico->placa}} - {{$certificadoProcedencia->frigorifico->nombre}} </h5>
                          <h5 class="text-left">Empresario: {{$certificadoProcedencia->empresarioComercializador->nombres}} {{$certificadoProcedencia->transportista->apellidos}}</h5>
                          <h5 class="text-left">Fecha de Envio: {{date_format(date_create($certificadoProcedencia->fechaDictada),"d/m/Y")}} </h5>
                          @if($certificadoProcedencia->notasIngreso!=null)
                               <h5 class="text-left">Notas de Ingreso: </h5>
                              @foreach($certificadoProcedencia->notasIngreso as $not)
                                  <h6 class="text-left"> Nota: </h6> 
                                  <h6 class="text-left"> + Codigo de Nota: {{$not->nota->id}} </h6> 
                                  <h6 class="text-left"> + Nombre de la Especie: {{$not->nota->especieMarina->nombre}} </h6>
                                  <h6 class="text-left"> + Embarcacion: {{$not->nota->desembarque->embarcacion->nombre}} </h6>
                                  <h6 class="text-left"> + Toneladas: {{$not->toneladas}} </h6>
                              @endforeach 
                            
                          @else
                            <h5 class="text-left">Notas de Ingreso: No han sido resignado </h5>
                          @endif      

                    </td>

                  </tr>
              </table>
            @else 
              <h5> No ha sido asociado </h5>
            @endif
              
          
      </div>
        
 
    @elseif ($tipoProducto==2)
    <div class="row" id ="boxProducto">
            <h4> Certificado Procedencia a Terminal </h4> 

            @if ($certificadoTerminal!= null)
             
                  
                    <table class="table table-bordered table-striped">
                  <tr>

                      <th class="text-center">Código</th>
                      <th class="text-center">Información</th>
                      <!--<th class="text-center">Documento</th>   -->
                
                  </tr>
                  <tr>
                    <td class="text-center">
                      <h5 class="text-center">{{$certificadoTerminal->codigo}}</h5>

                    </td>
                    <td class="text-center">
                          <h5 class="text-left">Transportista: {{$certificadoTerminal->transportista->nombres}} {{$certificadoTerminal->transportista->apellidos}}</h5>
                          <h5 class="text-left">Terminal: {{$certificadoTerminal->terminal->nombre}}</h5>
                          <h5 class="text-left">Frigorifico: {{$certificadoTerminal->frigorifico->placa}} - {{$certificadoTerminal->frigorifico->nombre}} </h5>
                                  
                          <h5 class="text-left">Fecha de Envio: {{date_format(date_create($certificadoTerminal->fechaDictada),"d/m/Y")}} </h5>
                          @if($certificadoTerminal->notasIngreso!=null)
                               <h5 class="text-left">Notas de Ingreso: </h5>
                              @foreach($certificadoTerminal->notasIngreso as $not)
                                  <h6 class="text-left"> Nota: </h6> 
                                  <h6 class="text-left"> + Codigo de Nota: {{$not->nota->id}} </h6> 
                                  <h6 class="text-left"> + Nombre de la Especie: {{$not->nota->especieMarina->nombre}} </h6>
                                  <h6 class="text-left"> + Embarcacion: {{$not->nota->desembarque->embarcacion->nombre}} </h6>
                                  <h6 class="text-left"> + Toneladas: {{$not->toneladas}} </h6>
                              @endforeach 
                            
                          @else
                            <h5 class="text-left">Notas de Ingreso: No han sido resignado </h5>
                          @endif  

                    </td>

                  </tr>
              </table>
            @else 
              <h5> No ha sido asociado </h5>
            @endif
           
           
        
    </div>                 


           
        
    
    @endif
    <br>
    <div class="row">
        <div class="col-sm-5">
      
        </div>
        <div class="col-sm-7">
         
               
                <!--<a href="{{URL::previous()}}"> <button  type="button" class="btn btn-info">Información General</button></a>-->
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
 

</script>
<style type="text/css">
  
 
  #boxProducto {}
</style>
@stop