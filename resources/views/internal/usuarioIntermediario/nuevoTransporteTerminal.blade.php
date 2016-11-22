@extends('layout.usuarioIntermediario')

@section('style')

{!!Html::style('css/jquery.dataTables.min.css')!!}
@stop

@section('title')
	Nuevo Certificado de Procedencia para Terminales
@stop

@section('content')

<div class="row">
  <div class="col-sm-10">
    {!!Form::open(array('url' => 'usuarioIntermediario/transporteTerminales/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        <div class="form-group">
            <label class="col-sm-3 control-label">Fábrica</label>
            <div class="col-sm-9">
                {!! Form::select('terminal_id', $terminales_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'fabrica_id']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Frigorífico</label>
            <div class="col-sm-9">
                {!! Form::select('frigorifico_id', $frigorificos_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'frigorifico_id']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Transportista</label>
            <div class="col-sm-9">
                {!! Form::select('transportista_id', $transportistas_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'transportista_id']) !!}
            </div>
        </div>
        <div class="form-group">
          <label for="inputcumpleanos" class="col-sm-3 control-label">Fecha Transporte</label>
          <div class="col-sm-9">
            {!!Form::input('date','fechaDictada', null ,['class'=>'form-control','id'=>'fechaDictada','required'])!!}
            <div class="col-sm-9" id="firefox" style="visibility: hidden">
                Formato Año(D/M/Y)
            </div> 
          </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Notas de Ingreso</label>
            <div class="col-sm-9">
                <a  id="botonPes" class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitNotas"> Agregar Nota Ingreso</a>
            </div>
        </div>
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10">
              <table id="table-notas" class="table table-bordered table-striped ">
                  <tr>
                      <th>Codigo Nota</th>
                      <th>Especie Marina</th>
                      <th>Desembarque</th>
                      <th>Pesca</th>
                      <th>Embarcacion</th>
                      <th>Puerto</th>
                      <th>Toneladas</th>
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
      <div class="modal fade"  id="submitNotas" >
        <div class="modal-dialog" style="width:1000px;height:12000px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3>Seleccione la nota de ingreso a relacionar</h3>
              <table id="example" class="table table-bordered display" >
                  <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Especie Marina</th>
                        <th>Desembarque</th>
                        <th>Pesca</th>
                        <th>Embarcacion</th>
                        <th>Toneladas Sobrantes</th>
                        <th>Seleccionar</th>
                    </tr>
                 </thead>
                <tbody>
                  @foreach($notas as $nota)
                    <tr>
                      <td>{{$nota->id}}</td>
                      <td>{{$nota->especieMarina->nombre}}</td>
                      <td>{{$nota->desembarque->id}}</td>
                      <td>{{$nota->desembarque->pesca->id}}</td>
                      <td>{{$nota->desembarque->embarcacion->id}}</td>
                      <td>{{$nota->toneladasSobrantes}}</td>
                      <td> {!! Form::radio('not', $nota->id ,   (Input::old('pat') == $nota->id ), array('id'=>'true', 'class'=>'radio  not_id'         ,'required'   ))  !!} </td>
                    </tr>

                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Regresar</button>
                <button id="AgregarNota" type="button" class="btn btn-info" data-dismiss="modal">Agregar</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea crear el Certificado de Procedencia de Terminal?</h4>
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
{!!Html::script('js/jquery.dataTables.min.js')!!}
<script>
  $(document).ready(function() {
     $('#example').DataTable( {
         "language": {
             "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
         }
      });
     

      });
  </script>


<script type="text/javascript">
  $('#yes').click(function(){
    $('#submitModal').modal('hide');  
  });
  
</script>
<script>
//var data =[];
var listaRegistro
$('document').ready(function () {

  if(navigator.userAgent.indexOf("Firefox")>-1 ) {
    console.log("its firefox");
    document.getElementById('firefox').style.visibility='visible';
  }
})

$("#AgregarNota").on("click",function(){
  
    id_variable = $('input[name="not"]:checked').val();
    console.log(id_variable);

    //console.log("gg");
    //variable  =  $( this).val() ;
    url_base = "{{ url('/') }}";
     // Peticion ajax
    $.getJSON( url_base + "/usuarioIntermediario/nuevoTransporteTerminales/new/"+id_variable  , function(data)
      {
        console.log(data);
        //$.each( data, function( id) {


                        var tableRef = document.getElementById('table-notas').getElementsByTagName('tbody')[0];

                        // Insert a row in the table at the last row
                        var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
                        var newCell  = newRow.insertCell(0);
                        var newCell2 = newRow.insertCell(1);
                        var newCell3 = newRow.insertCell(2);
                        var newCell4 = newRow.insertCell(3);
                        var newCell5 = newRow.insertCell(4);
                        var newCell6 = newRow.insertCell(5);
                        var newCell7 = newRow.insertCell(6);
                        var newCell8 = newRow.insertCell(7);
                        // Append values to cells
                        var x = document.createElement("INPUT");
                        x.setAttribute("type", "number");
                        x.setAttribute("value", data.id);
                        x.setAttribute("name", "notas_id[]");
                        x.style.border = 'none';
                        x.style.background = 'transparent';
                        x.setAttribute("readonly","readonly");
                        x.style.width='60px';
                        x.required = true;
                        var newText2 = document.createElement("INPUT");
                        newText2.setAttribute("type", "text");
                        newText2.setAttribute("value", ""+data.especie);
                        newText2.setAttribute("name", "especies[]");
                        newText2.style.border = 'none';
                        newText2.style.background = 'transparent';
                        newText2.setAttribute("readonly","readonly");
                        newText2.style.width='120px';
                        newText2.required = true;

                        var newText3 = document.createElement("INPUT");
                        newText3.setAttribute("type", "text");
                        newText3.setAttribute("value", ""+data.desembarque);
                        newText3.setAttribute("name", "desembarques[]");
                        newText3.style.border = 'none';
                        newText3.style.background = 'transparent';
                        newText3.setAttribute("readonly","readonly");
                        newText3.style.width='15px';
                        newText3.required = true;

                        var newText4 = document.createElement("INPUT");
                        newText4.setAttribute("type", "text");
                        newText4.setAttribute("value", ""+data.pesca);
                        newText4.setAttribute("name", "pescas[]");
                        newText4.style.border = 'none';
                        newText4.style.background = 'transparent';
                        newText4.setAttribute("readonly","readonly");
                        newText4.style.width='15px';
                        newText4.required = true;

                        var newText5 = document.createElement("INPUT");
                        newText5.setAttribute("type", "text");
                        newText5.setAttribute("value", ""+data.embarcacion);
                        newText5.setAttribute("name", "embarcaciones[]");
                        newText5.style.border = 'none';
                        newText5.style.background = 'transparent';
                        newText5.setAttribute("readonly","readonly");
                        newText5.style.width='120px';
                        newText5.required = true;

                        var newText6 = document.createElement("INPUT");
                        newText6.setAttribute("type", "text");
                        newText6.setAttribute("value", ""+data.puerto);
                        newText6.setAttribute("name", "puertos[]");
                        newText6.style.border = 'none';
                        newText6.style.background = 'transparent';
                        newText6.setAttribute("readonly","readonly");
                        newText6.style.width='120px';
                        newText6.required = true;


                        var newText7 = document.createElement("INPUT");
                        newText7.setAttribute("type", "integer");
                        newText7.setAttribute("value", ""+0);
                        newText7.setAttribute("name", "toneladas[]");
                        newText7.style.border = 'none';
                        newText7.style.background = 'transparent';
                        newText7.style.width='60px'; 
                        //newText5.setAttribute("readonly","readonly");
                        newText7.required = true;

                        // buttons
                        var newDelete = document.createElement('button');
                        newDelete.className = "btn";
                        newDelete.className += " btn-info glyphicon glyphicon-remove";
                        if (newDelete.addEventListener) {  // all browsers except IE before version 9
                          newDelete.addEventListener("click", function(){deleteFunctionNota(newDelete);}, false);
                        } else {
                          if (newDelete.attachEvent) {   // IE before version 9
                            newDelete.attachEvent("click", function(){deleteFunctionNota(newDelete);});
                          }
                        }
                        newCell.appendChild(x);
                        newCell2.appendChild(newText2);
                        newCell3.appendChild(newText3);
                        newCell4.appendChild(newText4);
                        newCell5.appendChild(newText5);
                        newCell6.appendChild(newText6);
                        newCell7.appendChild(newText7);
                        newCell8.appendChild(newDelete);

                        /*var tds = document.getElementById('table-notas').getElementsByTagName('td');
                        console.log(tds.length);
                        for (var i = 0; i < tds.length; i++)
                            tds[i].style.width = '10px';
                        var tds = document.getElementById('table-notas').getElementsByTagName('th');
                        console.log(tds.length);
                        for (var i = 0; i < tds.length; i++)
                            tds[i].style.width = '10px';*/

                        console.log(tableRef);
                        
                        //document.getElementById('input-function-date')[0].value = '';

            //var result = "<tr><td>" + data[id].id +"</td> <td>" + data[id].apellidos + ", " +data[id].nombres +"</td> <td>" + data[id].dni+"</td> <td>" + newDelete + " </td> </tr>";
            //$("#table-notas").append(result);
            $('#submitNotas').modal('hide');  


       // });
            
      })

  //var result = "<tr><td>" + data.nombre +"</td> <td>xx</td> <td>xx</td> <td></td> </tr>";
  //$("#table-notas").append(result);
   //$('#subminotas').modal('hide');  
  });

    function deleteFunctionNota(btn){
      var row=btn.parentNode.parentNode.rowIndex;
      document.getElementById('table-notas') .deleteRow(row);
                
    } 

</script>  

@stop