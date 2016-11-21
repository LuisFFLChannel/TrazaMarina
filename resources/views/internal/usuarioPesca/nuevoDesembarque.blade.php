@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
	Registrar Desembarque de una Pesca
@stop

@section('content')
<h3> Información de la Pesca </h3>
<br>
<div class="row">
    <div class="col-sm-2">
  
    </div>
    <div class="col-sm-8">
        <table class="table table-bordered table-striped">
          <tr>
              <th >Numero</th>
              <th >{{$pesca->id}}</th>   
          </tr>  
          <tr>
              <th>Embarcacion</th>
              <th >{{$pesca->embarcacion->nMatricula}} - {{$pesca->embarcacion->nombre}}</th>   
          </tr> 
          <tr>
              <th >Puerto Zarpe</th>
              <th >{{$pesca->puerto->nombre}}</th>   
          </tr> 
          <tr>
              <th>Latitud de Pesca</th>
              <th >{{$pesca->coordenadaX}}</th>   
          </tr> 
          <tr>
              <th>Longitud de Pesca</th>
              <th >{{$pesca->coordenadaY}}</th>   
          </tr> 
           <tr>
              <th>Permiso Zarpe</th>
              <th >{{$pesca->permisoZarpe->id}} - {{$pesca->permisoZarpe->nombre}}</th>   
          </tr> 
           <tr>
              <th>Fecha Zarpe</th>
              <th >{{date_format(date_create($pesca->fechaZarpe),"d/m/Y") }}</th>   
          </tr> 
        </table>
    </div>
</div>
<br>
<h3> Información del Desembarque </h3>
<br>
<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'usuarioPesca/pescas/'.$pesca->id.'/addDesembarque','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Embarcacion</label>
            <div class="col-sm-9">
                {!! Form::select('embarcacion_id', $embarcaciones_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'embarcacion_id']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Dpa</label>
            <div class="col-sm-9">
                {!! Form::select('dpa_id', $dpas_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'dpa_id']) !!}
            </div>
        </div>

        <div class="form-group">
          <label for="inputcumpleanos" class="col-sm-3 control-label">Fecha Arribo</label>
          <div class="col-sm-9">
            {!!Form::input('date','fechaLlegada', null ,['class'=>'form-control','id'=>'fechaLlegada','required'])!!}
            <div class="col-sm-9" id="firefox" style="visibility: hidden">
                Formato Año(D/M/Y)
            </div> 
          </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Puerto Arribo</label>
            <div class="col-sm-9">
                {!! Form::select('puerto_id', $puertos_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'puerto_id']) !!}
            </div>
        </div>
        <br>
      <legend>Agregar Notas de Ingreso:</legend>
        <div class="form-group">
            <label class="col-sm-3 control-label">Especie Marina</label>
            <div class="col-sm-9">
                {!! Form::select('especie_id', $especies_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'especie_id']) !!}
            </div>
        </div>
        <div class="form-group">
          <label  class="col-md-3 control-label">Toneladas</label>
          <div class="col-md-9">
              {!! Form::number('toneladas_inde','', array('class' => 'form-control','id' => 'toneladas_inde','maxlength' => 50,'min' => '0')) !!}
          </div>
        </div>
        <div class="form-group">
          <label  class="col-md-3 control-label">Talla Promedio</label>
          <div class="col-md-9">
              {!! Form::number('promedios_inde','', array('class' => 'form-control','id' => 'promedios_inde','maxlength' => 50,'min' => '0')) !!}
          </div>
        </div>
        <div class="form-group">
            
            <div class="col-sm-offset-3 col-sm-9">
                <a id="AgregarEspecie" class="btn btn-info">Agregar</a>
            </div>
        </div>
        <br>
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10">
              <table id="tabla-notas" class="table table-bordered table-striped ">
                  <tr>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Toneladas</th>
                      <th>Talla Promedios</th>
                      <th>Accion</th>
                  </tr>
              </table>
            </div>
        </div>

        <br>


      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
          <a href="{{URL::previous()}}"><button type="button" class="btn btn-info">Cancelar</button></a>
        </div>
      </div>

      <!-- MODAL -->
      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea asignar el desembarque?</h4>
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
<script>

$("#AgregarEspecie").on("click",function(){
      console.log("logre");
      if(document.getElementById('toneladas_inde').length==0 || document.getElementById('promedios_inde').length==0) return;
      especie_id = $("#especie_id").val();
      url_base = "{{ url('/') }}";
      $.getJSON(url_base+"/getEspecie/"+especie_id, function(data)
      {
        
          $.each( data, function( id) {
            
            var tableRef = document.getElementById('tabla-notas').getElementsByTagName('tbody')[0];
            var tonelada = document.getElementById('toneladas_inde').value;

            var talla = document.getElementById('promedios_inde').value;
                        // Insert a row in the table at the last row
            var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
            var newCell  = newRow.insertCell(0);
            var newCell2 = newRow.insertCell(1);
            var newCell3 = newRow.insertCell(2);
            var newCell4 = newRow.insertCell(3);
            var newCell5 = newRow.insertCell(4);
            // Append values to cells
            var x = document.createElement("INPUT");
            x.setAttribute("type", "text");
            x.setAttribute("value", data[id].id);
            x.setAttribute("name", "especies_id[]");
            x.style.border = 'none';
            x.style.background = 'transparent';
            x.setAttribute("readonly","readonly");
            x.required = true;
            var newText2 = document.createElement("INPUT");
            newText2.setAttribute("type", "text");
            newText2.setAttribute("value", ""+data[id].nombre);
            newText2.setAttribute("name", "nombres[]");
            newText2.style.border = 'none';
            newText2.style.background = 'transparent';
            newText2.setAttribute("readonly","readonly");
            newText2.required = true;

            var newText3 = document.createElement("INPUT");
            newText3.setAttribute("type", "text");
            newText3.setAttribute("value", ""+tonelada);
            newText3.setAttribute("name", "toneladas[]");
            newText3.style.border = 'none';
            newText3.style.background = 'transparent';
            newText3.setAttribute("readonly","readonly");
            newText3.required = true;

            var newText4 = document.createElement("INPUT");
            newText4.setAttribute("type", "text");
            newText4.setAttribute("value", ""+talla);
            newText4.setAttribute("name", "tallas[]");
            newText4.style.border = 'none';
            newText4.style.background = 'transparent';
            newText4.setAttribute("readonly","readonly");
            newText4.required = true;

            // buttons
            var newDelete = document.createElement('button');
            newDelete.className = "btn";
            newDelete.className += " btn-info glyphicon glyphicon-remove";
            if (newDelete.addEventListener) {  // all browsers except IE before version 9
              newDelete.addEventListener("click", function(){deleteFunctionEspecie(newDelete);}, false);
            } else {
              if (newDelete.attachEvent) {   // IE before version 9
                newDelete.attachEvent("click", function(){deleteFunctionEspecie(newDelete);});
              }
            }
            newCell.appendChild(x);
            newCell2.appendChild(newText2);
            newCell3.appendChild(newText3);
            newCell4.appendChild(newText4);
            newCell5.appendChild(newDelete);
            //document.getElementById('input-function-date')[0].value = '';

            //var result = "<tr><td>" + data[id].id +"</td> <td>" + data[id].apellidos + ", " +data[id].nombres +"</td> <td>" + data[id].dni+"</td> <td>" + newDelete + " </td> </tr>";
            //$("#tabla-notas").append(result);
            







          });

      })


  

        


})
function deleteFunctionEspecie(btn){
      var row=btn.parentNode.parentNode.rowIndex;
      document.getElementById('tabla-notas') .deleteRow(row);

                
    } 
</script>
@stop