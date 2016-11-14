@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Asociar Certificado de Arribo
@stop

@section('content')
<h3> Información del Desembarque</h3>
<br>
<div class="row">
    <div class="col-sm-2">
  
    </div>
    <div class="col-sm-8">
        <table class="table table-bordered table-striped">
          <tr>
              <th >Numeroe</th>
              <th >{{$desembarque->id}}</th>   
          </tr>  
          <tr>
              <th>Puerto desembarque</th>
              <th >{{$desembarque->puerto->nombre}}</th>   
          </tr> 
          <tr>
              <th >Dpa</th>
              <th >{{$desembarque->dpa->nombre}}</th>   
          </tr> 
          <tr>
              <th>Embarcacion</th>
              <th >{{$desembarque->embarcacion->nMatricula}} - {{$desembarque->embarcacion->nombre}}</th>   
          </tr> 
           <tr>
              <th>Fecha Arribo</th>
              <th >{{date_format(date_create($desembarque->fechaLlegada),"d/m/Y") }}</th>   
          </tr> 
           <tr>
              <th>Puerto Zarpe</th>
              <th > {{$desembarque->pesca->puerto->nombre}}</th>   
          </tr> 
           <tr>
              <th>Fecha Zarpe</th>
              <th >{{date_format(date_create($desembarque->pesca->fechaZarpe),"d/m/Y")}}</th>   
          </tr> 
        </table>
    </div>
</div>
<h3> Información del Certificado Arribo </h3>
<br>
@if($desembarque->certificadoMatricula!=null)
    <div class="row">
        <div class="col-sm-2">
      
        </div>
        <div class="col-sm-8">
            <table class="table table-bordered table-striped">
              <tr>
                  <th >Codigo</th>
                  <th >{{$desembarque->certificadoArribo->id}}</th>   
              </tr> 
              <tr>
                  <th>Nombre</th>
                  <th >{{$desembarque->certificadoArribo->nombre}}</th>   
              </tr>  
               <tr>
                  <th>Numero de Matricula</th>
                  <th >{{$desembarque->certificadoArribo->nMatricula}}</th>   
              </tr> 
              <tr>
                  <th>Toneladas</th>
                  <th >{{$desembarque->certificadoArribo->toneladas}}</th>   
              </tr> 
              <tr>
                  <th>Fecha Arribo</th>
                  <th >{{date_format(date_create($desembarque->certificadoArribo->fechaArribo),"d/m/Y") }}</th>   
              </tr> 

            </table>
        </div>
    </div>
@else
      <h4 class="text-center"> No Asociado aun</h4>
@endif
<h3> Busqueda del Certificado Actual </h3>
<br>
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'usuarioPesca/desembarques/'.$desembarque->id.'/editCertificado','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <table id="example" class="table table-bordered display" >
            <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Fecha Desembarco</th>
                  <th>Seleccionar</th>
                </tr>
             </thead>
            <tbody>
              @foreach($certificadoArribos as $certificadoArribo)
                <tr>
                  <td>{{$certificadoArribo->id}}</td>
                  <td>{{$certificadoArribo->nombre}}</td>
                  <td>{{date_format(date_create($certificadoArribo->fechaArribo),"d/m/Y")}}</td>
                  <td> {!! Form::radio('certificadoArribo', $certificadoArribo->id ,   (Input::old('certificadoArribo') == $certificadoArribo->id ), array('id'=>'true', 'class'=>'radio  certificadoArribo_id'         ,'required'   ))  !!} </td>
                </tr>

                @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @if(!$certificadoArribos->isEmpty())
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
            <a href="{{action('DesembarqueController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
          </div>
        </div>
      @else
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a href="{{action('DesembarqueController@index')}}"><button type="button" class="btn btn-info">Regresar</button></a>
          </div>
        </div>
      @endif

      <!-- MODAL -->
      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea asociar este Certificado de Arribo?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                <button id="yes" type="submit" class="btn btn-info">Si</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    {!!Form::close()!!}
  </div>
</div>
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