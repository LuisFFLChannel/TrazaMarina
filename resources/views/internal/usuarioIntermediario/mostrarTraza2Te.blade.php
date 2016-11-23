@extends('layout.usuarioIntermediario')

@section('style')

@stop

@section('title')
	Mostrar código trazabilidad Segunda Parte
@stop

@section('content')
<h3> Información de creación para el código de trazabilidad</h3>
<br>
<div class="row">
    <div class="col-sm-2">
  
    </div>
    <div class="col-sm-8">
        <table class="table table-bordered table-striped">
          <tr>
              <th >Numero de Nota de Ingreso</th>
              <th >{{$notaIngreso->id}}</th> 
          </tr> 
          <tr>
              <th >Pez Extraído</th>
              <th >{{$notaIngreso->especieMarina->nombre}}</th>   
          </tr> 
          <tr>
              <th>Embarcacion</th>
              <th >{{$notaIngreso->desembarque->embarcacion->nMatricula}} - {{$notaIngreso->desembarque->embarcacion->nombre}}</th> >    
          </tr>
          <tr>
              <th>Puerto desembarque</th>
              <th >{{$notaIngreso->desembarque->puerto->nombre}}</th>   
          </tr> 
          <tr>
              <th >Pesca</th>
              <th >{{$notaIngreso->desembarque->pesca->id}}</th>  
          </tr> 
          <tr>
              <th >Desembarque</th>
              <th >{{$notaIngreso->desembarque->id}}</th>  
          </tr> 
          <tr>
              <th >Certificado a Terminal</th>
              <th >{{$lote->certificadoTerminal->id}}</th>  
          </tr> 
          <tr>
              <th >Terminal</th>
              <th >{{$lote->certificadoTerminal->terminal->nombre}}</th>  
          </tr> 
          <tr>
              <th >Frigorifico</th>
              <th >{{$lote->certificadoTerminal->frigorifico->nombre}}</th>  
          </tr> 
          <tr>
              <th >Toneladas</th>
              <th >{{$lote->toneladas}}</th>  
          </tr> 
        </table>
    </div>
</div>
<h3> Codigo de Trazabilidad Registrado Actualmente (Segunda Parte)</h3>
<br>

    <div class="row">
      <div class="col-sm-12">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">Codigo de Trazabilidad Registrado Actualmente (Segunda Parte)</label>
            <div class="col-sm-8">
              {!!Form::input('text','antigua', $lote->codigoTraza,['class'=>'form-control','id'=>'inputEmai3', 'readonly'])!!}
            </div>
          </div>
      </div>
    </div>

<br>
<br>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a href="{{URL::previous()}}"><button type="button" class="btn btn-info">Regresar</button></a>
          </div>
        </div>
<br>
<br>
<br>


@stop

@section('javascript')
<script type="text/javascript">
  $('#yes').click(function(){
    $('#submitModal').modal('hide');  
  });
  
</script>
<script>
$('document').ready(function () {

  if(navigator.userAgent.indexOf("Firefox")>-1 ) {
    console.log("its firefox");
    document.getElementById('firefox').style.visibility='visible';
  }
})
</script>  


@stop