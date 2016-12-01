@extends('layoutExternal')

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
        <th class="text-center">Información</th>
        <th class="text-center">Imagen</th>
    </tr>
    
    @foreach($especies as $especie)
    <tr>
      <td class="text-center">{{$especie->nombre}}</td>
      <td class="text-center">{{$especie->nombreCientifico}}</td>
      <td class="text-center">
          <h5 class="text-left">Promedio de Vida: {{$especie->promedioVida}} años </h5>        
          <h5 class="text-left">Tamano Minimo: {{$especie->tamanoMin}}</h5> 
          <h5 class="text-left">Tamano Maximo:  {{$especie->tamanoMax}}</h5>     
          <h5 class="text-left">Inicio de Veda: {{date_format(date_create($especie->inicioVeda),"d/M")}} </h5>
          <h5 class="text-left">Fin de Veda: {{date_format(date_create($especie->finVeda),"d/M")}}</h5>    
          <h5 class="text-left">Promedio de Pesca: {{$especie->pescaPromedio}}</h5>   
      </td>
      <td class="text-center">{!! Html::image($especie->imagen, null, array('class'=>'gift_img')) !!}</td>
      <!--<td>{!! Html::image($especie->imagen, null, array('class'=>'gift_img')) !!}</td>-->
    </tr>
    @endforeach
    
</table>

{!!$especies->render()!!}
@stop

@section('javascript')

@stop