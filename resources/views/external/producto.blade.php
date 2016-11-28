@extends('layoutExternal')

@section('style')
@stop

@section('title')
	Producto Encontrado: 
@stop

@section('content')
   
    <h3> Codigo: {{$codigoTrazabilidad}} </h3>
    <br>
    <div class="row">
        
            <div class="col-sm-6">
                <div class="col-sm-6">
                    <h4> Especie Marina Pescada: </h4>
                          <h5 class="text-left">Nombre: {{$producto->nota->especieMarina->nombre}} </h5>
                          <h5 class="text-left">Nombre Cientifico: {{$producto->nota->especieMarina->nombreCientifico}} </h5>                        
                          <h5 class="text-left">Promedio de Vida: {{$producto->nota->especieMarina->promedioVida}} años </h5>        
                          <h5 class="text-left">Tamano Minimo: {{$producto->nota->especieMarina->tamanoMin}}</h5> 
                          <h5 class="text-left">Tamano Maximo:  {{$producto->nota->especieMarina->tamanoMax}}</h5>     
                          <h5 class="text-left">Inicio de Veda: {{date_format(date_create($producto->nota->especieMarina->inicioVeda),"d/m")}} </h5>
                          <h5 class="text-left">Fin de Veda: {{date_format(date_create($producto->nota->especieMarina->finVeda),"d/m")}}</h5>    
                          <h5 class="text-left">Promedio de Pesca: {{$producto->nota->especieMarina->pescaPromedio}}</h5>                         
                          <p class="text-left">{!! Html::image($producto->nota->especieMarina->imagen, null, array('class'=>'gift_img')) !!}</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-6">
                    <h4> Embarcación Utilizada: </h4>
                        <h5 class="text-left">Nombre: {{$producto->nota->desembarque->pesca->embarcacion->nombre}} </h5>
                          <h5 class="text-left">N° Matricula: {{$producto->nota->desembarque->pesca->embarcacion->nMatricula}} </h5>                              
                          <h5 class="text-left">Dueño: {{$producto->nota->desembarque->pesca->embarcacion->nombreDueno}} {{$producto->nota->desembarque->pesca->embarcacion->apellidoDueno}}</h5> 
                          <h5 class="text-left">Capacidad: {{$producto->nota->desembarque->pesca->embarcacion->capacidad}}</h5> 
                          <h5 class="text-left">Estara: {{$producto->nota->desembarque->pesca->embarcacion->estara}}</h5> 
                          <h5 class="text-left">Manga: {{$producto->nota->desembarque->pesca->embarcacion->manga}}</h5> 
                          <h5 class="text-left">Puntual: {{$producto->nota->desembarque->pesca->embarcacion->puntual}}</h5> 
                          <p class="text-left">{!! Html::image($producto->nota->desembarque->pesca->embarcacion->imagen, null, array('class'=>'gift_img')) !!}</p>

                </div>
            </div>   
           
        
    </div>
    <br>
    <div class="row">
        
            <div class="col-sm-6">
                <div class="col-sm-6">
                    <h4> Especie Marina Pescada: </h4>
                    @if($tipoProducto==1)
                         
                    @elseif ($tipoProducto==2)

                    @elseif ($tipoProducto==3)

                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-6">
                    <h4> Embarcación Utilizada: </h4>
                </div>
            </div>   
           
        
    </div>
    <br>
    <div class="row">
        <div class="col-sm-5">
      
        </div>
        <div class="col-sm-7">
         
               <a href="{{URL::previous()}}"> <button  type="button" class="btn btn-info">Regresar</button></a>
          
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
@stop