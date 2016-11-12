@extends('layout.promoter')

@section('style')
{!!Html::style('css/jquery.dataTables.min.css')!!}
@stop

@section('title')
  Nueva promoción
@stop

@section('content')
 {!!Form::open(array('url' => 'promoter/promotion/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
	<h3>Seleccione evento a relacionar</h3>
	<table id="example" class="table table-bordered display" >
	  	<thead>
	        <tr>
		        <th>Nombre</th>
		        <th>Descripción</th>
		        <th>Seleccionar</th>
		    </tr>
	   </thead>
		<tbody>
			@foreach($events as $event)
		    <tr>
		    	<td>{{$event->name}}</td>
		    	<td> {{$event->description}}</td>
		    	<td> {!! Form::radio('evento', $event->id ,   (Input::old('evento') == $event->id ), array('id'=>'true', 'class'=>'radio  evento_id'         ,'required'   ))  !!} </td>
		    </tr>

	    	@endforeach
		</tbody>
	</table>
	<hr>
	<h3>Ingrese información de promoción</h3>
	<div>
		<div style="width: 500px ;">
			<h4>Nombre</h4>
			{!! Form::text('promotionName','', array('class' => 'form-control', 'maxlength'=>'70', 'required')) !!}
		</div>
		<br>
		<div style="-webkit-columns: 100px 4;">
			<h4>Fecha Inicio</h4>
			{!! Form::date('fechaInicio',\Carbon\Carbon::now(), array('class' => 'form-control' , 'required')) !!}
              <div class="col-sm-6" id="firefox" style="visibility: hidden">
                  Formato fecha: aaaaa-mm-dd
              </div><br>			

	<h4>Hora Inicio</h4>
			{!! Form::time('timeIni','', array('class' => 'form-control', 'required')) !!}
              <div class="col-sm-6" id="firefox2" style="visibility: hidden">
                  Formato hora(24 h): hh:mm
              </div>  <br>
			<h4>Fecha Fin</h4>
			{!! Form::date('fechaFin',\Carbon\Carbon::now()->addDay(), array('class' => 'form-control', 'required')) !!}

			<h4>Hora Fin</h4>
			{!! Form::time('timeEnd','', array('class' => 'form-control', 'required')) !!}
		</div>
		<h4>Descripción</h4>
		{!! Form::textarea('description', '' ,  ['size' => '30x3', 'class' => 'form-control', 'maxlength'=>'400', 'required']) !!}
	</div>
	<hr>
	<h3>Seleccione el tipo de promoción</h3>
	<br>
	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
	        DESCUENTOS</a>
	      </h4>
	    </div>
	    <div id="collapse1" class="panel-collapse collapse">
	    	<div style="-webkit-columns: 100px 2;">
		      	<h4>Seleccione el acceso a la promocion</h4>
			     {!! Form::select('access_id',   $accessPromotion->toArray()     ,null,['class' => 'form-control']) !!}
                <h4>Descuento (%)</h4>
				{!! Form::number('discount','', array('class' => 'form-control', 'min'=>'0', 'max'=>'100', 'required')) !!}
			</div>

	    </div>
	  </div>

	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
	        OFERTAS</a>
	      </h4>
	    </div>
	    <div id="collapse2" class="panel-collapse collapse">

	<div style="-webkit-columns: 100px 2;">
		      	<h4>Lleve : </h4>
			{!! Form::number('carry','', array('class' => 'form-control' )) !!}
				<h4>Pague por : </h4>
				{!! Form::number('pay','', array('class' => 'form-control' )) !!}
			</div>


		    <div style="width: 500px ;">
				<h4>Zona</h4>
				{!! Form::select('zone', ['Seleccione Evento'],null,['class' => 'form-control'  , 'id'=>'id_zoneCombo'  ]) !!}

			</div>
	    </div>
	  </div>

	<br><br>

	<p class ="text-center"  >
		<button type="submit" class="btn btn-info btn-lg" data-toggle="modal" data-target="#end" data-whatever="@mdo">Guardar</button>
		<a href="{{url('promoter/promotion')}}"><button type="button" class="btn btn-info btn-lg">Cancelar</button></a>
	</p>
	</div>


	{!!Form::close()!!}




@stop



@section('javascript')

  {!!Html::script('js/jquery.dataTables.min.js')!!}

	<script>
	$(document).ready(function() {
	   $('#example').DataTable( {
	       "language": {
	           "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
	       }
	  	});
	 	$(".evento_id").click(function(){ // punto para michis , michis para id, id es unico
          variable  =  $( this).val() ;
      url_base = "{{ url('/') }}";
 // Peticion ajax
     $.getJSON( url_base + "/promoter/promotion/new/"+variable  , function(data)
     {
     	console.log(data);
       $("#id_zoneCombo").empty();
       $.each( data, function( id, name ) {
           $('#id_zoneCombo').append("<option value=\""+id+"\">"+name+"</option>");
     });
     })
  		});


	});
	</script>


<script>
 $(document).ready(function(){
   // Poblar sub category
   $("#category_id").change(function(){
     category_id = $("#category_id").val();
     url_base = "{{ url('/') }}";
     // Peticion ajax
     $.getJSON(url_base+"/promoter/"+category_id+"/subcategories", function(data)
     {

       $("#subcategory_id").empty();
       $.each( data, function( id, name ) {
           $('#subcategory_id').append("<option value=\""+id+"\">"+name+"</option>");
     });
     })
   });
 });
 function incrementDate(){
    var publication_date = document.getElementsByName('dateIni')[0].value;
    document.getElementsByName('dateIni')[0].stepUp();
    var publication_date_1 = document.getElementsByName('dateIni')[0].value;
    document.getElementsByName('dateIni')[0].stepDown();
    var today = new Date();
    var publicDate = new Date(document.getElementsByName('dateIni')[0].value);
    var timeToday = today.getTime();
    var timePublic = publicDate.getTime();
    var month = today.getMonth() +1;
    if(timeToday > timePublic)
      document.getElementsByName('dateEnd')[0].min = ''+today.getFullYear()+'-'+month+'-'+today.getDate();
    else
      document.getElementsByName('dateEnd')[0].min = publication_date_1;
  }
 </script>

<script>
$('document').ready(function () {

  if(navigator.userAgent.indexOf("Firefox")>-1 ) {
    console.log("its firefox");
    document.getElementById('firefox').style.visibility='visible';
    document.getElementById('firefox2').style.visibility='visible';
  }
})
</script>  

@stop