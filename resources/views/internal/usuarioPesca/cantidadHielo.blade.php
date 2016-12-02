@extends('layout.admin')

@section('style')

@stop

@section('title')
	Cantidad de Hielo
@stop

@section('content')
  {!!Form::open(array('url' => 'usuarioPesca/cantidadHielo','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}

    <div class="form-group">
        <label class="col-sm-3 control-label">Puerto Zarpe</label>
        <div class="col-sm-9">
            {!! Form::select('puerto_id', $puertos_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'puerto_id']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Embarcacion</label>
        <div class="col-sm-9">
            {!! Form::select('embarcacion_id', $embarcaciones_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'embarcacion_id']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Especie Marina</label>
        <div class="col-sm-9">
            {!! Form::select('especie_id', $especies_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'especie_id']) !!}
        </div>
    </div>
    <div class="form-group">
            
        <div class="col-sm-offset-3 col-sm-9">
            <a id="BuscarHielo" class="btn btn-info">Buscar Data Historica</a>
        </div>
    </div>

    <br>
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10">
              <table id="tabla-hielo" class="table table-bordered table-striped">
                  <tr>
                      <th>Mes</th>
                      <th>Año</th>
                      <th>Toneladas Promedio</th>
                      <th>Cantidad de hielo</th>
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
              <h4 class="modal-title">¿Estas seguro que desea guardar el indice actual de hielo?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                <button id="yes" type="submit" class="btn btn-info">Si</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
  {!!Form::close()!!}


@stop

@section('javascript')
<script>

$("#AgregarEspecie").on("click",function(){
      console.log("logre");
      //if(document.getElementById('toneladas_inde').length==0 || document.getElementById('promedios_inde').length==0) return;
      especie_id = $("#especie_id").val();
      puerto_id = $("#puerto_id").val();
      embarcacion_id = $("#embarcacion_id").val();
      url_base = "{{ url('/') }}";
      $.getJSON(url_base+"/getHistorialHielo/"+especie_id+"/"+puerto_id+"/"+embarcacion_id, function(data)
      {
        
          $.each( data, function( id) {
            
            var tableRef = document.getElementById('tabla-hielo').getElementsByTagName('tbody')[0];
            document.getElementById('tabla-hielo').clear();
                        // Insert a row in the table at the last row
            var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
            var newCell  = newRow.insertCell(0);
            var newCell2 = newRow.insertCell(1);
            var newCell3 = newRow.insertCell(2);
            var newCell4 = newRow.insertCell(3);

            // Append values to cells
            var x = document.createElement("INPUT");
            x.setAttribute("type", "text");
            x.setAttribute("value", data[id].mes);
            x.setAttribute("name", "meses[]");
            x.style.border = 'none';
            x.style.background = 'transparent';
            x.setAttribute("readonly","readonly");
            x.required = true;
            var newText2 = document.createElement("INPUT");
            newText2.setAttribute("type", "text");
            newText2.setAttribute("value", ""+data[id].anho);
            newText2.setAttribute("name", "anhos[]");
            newText2.style.border = 'none';
            newText2.style.background = 'transparent';
            newText2.setAttribute("readonly","readonly");
            newText2.required = true;

            var newText3 = document.createElement("INPUT");
            newText3.setAttribute("type", "text");
            newText3.setAttribute("value", ""+data[id].toneladaPromedio);
            newText3.setAttribute("name", "toneladas[]");
            newText3.style.border = 'none';
            newText3.style.background = 'transparent';
            newText3.setAttribute("readonly","readonly");
            newText3.required = true;

            var newText4 = document.createElement("INPUT");
            newText4.setAttribute("type", "text");
            newText4.setAttribute("value", ""+data[id].hieloPromedio);
            newText4.setAttribute("name", "hielos[]");
            newText4.style.border = 'none';
            newText4.style.background = 'transparent';
            newText4.setAttribute("readonly","readonly");
            newText4.required = true;

            // buttons

            newCell.appendChild(x);
            newCell2.appendChild(newText2);
            newCell3.appendChild(newText3);
            newCell4.appendChild(newText4);
            
            //document.getElementById('input-function-date')[0].value = '';

            //var result = "<tr><td>" + data[id].id +"</td> <td>" + data[id].apellidos + ", " +data[id].nombres +"</td> <td>" + data[id].dni+"</td> <td>" + newDelete + " </td> </tr>";
            //$("#tabla-hielo").append(result);
            







          });

      })


  

        


})
function deleteFunctionEspecie(btn){
      var row=btn.parentNode.parentNode.rowIndex;
      document.getElementById('tabla-hielo') .deleteRow(row);

                
    } 
</script>
@stop