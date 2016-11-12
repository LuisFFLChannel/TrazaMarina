@extends('layout.usuarioPesca')

@section('style')

{!!Html::style('css/jquery.dataTables.min.css')!!}
@stop

@section('title')
	Nuevo Permiso de Zarpe
@stop

@section('content')

<div class="row">
  <div class="col-sm-8">
    {!!Form::open(array('url' => 'usuarioPesca/permisoZarpes/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Nombres</label>
          <div class="col-sm-9">
            {!!Form::input('text','nombre', null ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'100','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Numero de Matricula</label>
          <div class="col-sm-9">
            {!!Form::input('text','nMatricula', null ,['class'=>'form-control','id'=>'inputEmai3', 'maxlength'=>'50','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="tamanoMin" class="col-sm-3 control-label">Latitud</label>
          <div class="col-sm-9">
            {!!Form::input('number','latitud', null ,['class'=>'form-control','id'=>'latitud','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="tamanoMax" class="col-sm-3 control-label">Longitud</label>
          <div class="col-sm-9">
            {!!Form::input('number','longitud', null ,['class'=>'form-control','id'=>'longitud', 'required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputcumpleanos" class="col-sm-3 control-label">Fecha Zarpe</label>
          <div class="col-sm-9">
            {!!Form::input('date','fechaZarpe', null ,['class'=>'form-control','id'=>'fechaZarpe','required'])!!}
            <div class="col-sm-9" id="firefox" style="visibility: hidden">
                Formato Año(D/M/Y)
            </div> 
          </div>
        </div>
        <div class="form-group">
          <label for="inputcumpleanos" class="col-sm-3 control-label">Fecha Arribo</label>
          <div class="col-sm-9">
            {!!Form::input('date','fechaArribo', null ,['class'=>'form-control','id'=>'fechaArribo','required'])!!}
            <div class="col-sm-9" id="firefox" style="visibility: hidden">
                Formato Año(D/M/Y)
            </div> 
          </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Capitania</label>
            <div class="col-sm-9">
                {!! Form::select('capitania_id', $capitanias_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'capitania_id']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Puerto</label>
            <div class="col-sm-9">
                {!! Form::select('puerto_id', $puertos_lista->toArray(), null, ['class' => 'form-control','required', 'id'=>'puerto_id']) !!}
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-sm-3 control-label">Pescadores</label>
            <div class="col-sm-9">
                <a  id="botonPes" class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitPescadores"> Agregar Pescador</a>
            </div>
        </div>
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10">
              <table id="table-pescadores" class="table table-bordered table-striped ">
                  <tr>
                      <th>Codigo</th>
                      <th>Apellidos y Nombre</th>
                      <th>DNI </th>
                      <th>Accion</th>
                  </tr>
              </table>
            </div>
        </div>

        <br>
        <div class="form-group">
            <label class="col-sm-3 control-label">Patron</label>
            <div class="col-sm-9">
                <a id="botonPat" class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitPatron">Agregar Patron</a>
            </div>
        </div>
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10">
              <table id="table-patron" class="table table-bordered table-striped ">
                  <tr>
                      <th>Codigo</th>
                      <th>Apellidos y Nombre</th>
                      <th>DNI </th>
                      <th>Accion</th>
                  </tr>
              </table>
            </div>
        </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Guardar</a>
          <a href="{{action('PermisoZarpeController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
        </div>
      </div>

      <!-- MODAL -->
      <div class="modal fade"  id="submitPescadores">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3>Seleccione pescador a relacionar</h3>
              <table id="example" class="table table-bordered display" >
                  <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Seleccionar</th>
                    </tr>
                 </thead>
                <tbody>
                  @foreach($pescadores as $pescador)
                    <tr>
                      <td>{{$pescador->apellidos}}, {{$pescador->nombres}}</td>
                      <td> {{$pescador->dni}}</td>
                      <td> {!! Form::radio('pes', $pescador->id ,   (Input::old('pat') == $pescador->id ), array('id'=>'true', 'class'=>'radio  pes_id'         ,'required'   ))  !!} </td>
                    </tr>

                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                <button id="AgregarPescador" type="button" class="btn btn-info" data-dismiss="modal">Si</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <div class="modal fade"  id="submitPatron">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3>Seleccione pescador a relacionar</h3>
              <table id="examplePatron" class="table table-bordered display" >
                  <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Seleccionar</th>
                    </tr>
                 </thead>
                <tbody>
                  @foreach($patrones as $patron)
                    <tr>
                      <td>{{$patron->apellidos}}, {{$patron->nombres}}</td>
                      <td> {{$patron->dni}}</td>
                      <td> {!! Form::radio('pat', $patron->id ,   (Input::old('pat') == $patron->id ), array('id'=>'true', 'class'=>'radio  pat_id'         ,'required'   ))  !!} </td>
                    </tr>

                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                <button id="AgregarPatron" type="button" class="btn btn-info" data-dismiss="modal">Si</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea crear el Permiso de Zarpe?</h4>
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

  <script>
  $(document).ready(function() {
     $('#examplePatron').DataTable( {
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

$("#AgregarPescador").on("click",function(){
  
    id_variable = $('input[name="pes"]:checked').val();
    console.log(id_variable);

    //console.log("gg");
    //variable  =  $( this).val() ;
    url_base = "{{ url('/') }}";
     // Peticion ajax
    $.getJSON( url_base + "/usuarioPesca/nuevoPermisoZarpes/new/"+id_variable  , function(data)
      {
        console.log(data);
        $.each( data, function( id) {


                        var tableRef = document.getElementById('table-pescadores').getElementsByTagName('tbody')[0];

                        // Insert a row in the table at the last row
                        var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
                        var newCell  = newRow.insertCell(0);
                        var newCell2 = newRow.insertCell(1);
                        var newCell3 = newRow.insertCell(2);
                        var newCell4 = newRow.insertCell(3);

                        // Append values to cells
                        var x = document.createElement("INPUT");
                        x.setAttribute("type", "number");
                        x.setAttribute("value", data[id].id);
                        x.setAttribute("name", "pescadores_id[]");
                        x.style.border = 'none';
                        x.style.background = 'transparent';
                        x.setAttribute("readonly","readonly");
                        x.required = true;
                        var newText2 = document.createElement("INPUT");
                        newText2.setAttribute("type", "text");
                        newText2.setAttribute("value", ""+data[id].apellidos+", "+ data[id].nombres);
                        newText2.setAttribute("name", "apelidos/nombres[]");
                        newText2.style.border = 'none';
                        newText2.style.background = 'transparent';
                        newText2.setAttribute("readonly","readonly");
                        newText2.required = true;

                        var newText3 = document.createElement("INPUT");
                        newText3.setAttribute("type", "text");
                        newText3.setAttribute("value", ""+data[id].dni);
                        newText3.setAttribute("name", "dni[]");
                        newText3.style.border = 'none';
                        newText3.style.background = 'transparent';
                        newText3.setAttribute("readonly","readonly");
                        newText3.required = true;
                        // buttons
                        var newDelete = document.createElement('button');
                        newDelete.className = "btn";
                        newDelete.className += " btn-info glyphicon glyphicon-remove";
                        if (newDelete.addEventListener) {  // all browsers except IE before version 9
                          newDelete.addEventListener("click", function(){deleteFunctionPesca(newDelete);}, false);
                        } else {
                          if (newDelete.attachEvent) {   // IE before version 9
                            newDelete.attachEvent("click", function(){deleteFunctionPesca(newDelete);});
                          }
                        }
                        newCell.appendChild(x);
                        newCell2.appendChild(newText2);
                        newCell3.appendChild(newText3);
                        newCell4.appendChild(newDelete);
                        //document.getElementById('input-function-date')[0].value = '';

            //var result = "<tr><td>" + data[id].id +"</td> <td>" + data[id].apellidos + ", " +data[id].nombres +"</td> <td>" + data[id].dni+"</td> <td>" + newDelete + " </td> </tr>";
            //$("#table-pescadores").append(result);
            $('#submiPescadores').modal('hide');  


        });
            
      })

  //var result = "<tr><td>" + data.nombre +"</td> <td>xx</td> <td>xx</td> <td></td> </tr>";
  //$("#table-pescadores").append(result);
   //$('#submiPescadores').modal('hide');  
  });
$("#AgregarPatron").on("click",function(){
    $('#botonPat').attr("disabled", false);
    id_variable = $('input[name="pat"]:checked').val();
    console.log(id_variable);

    //console.log("gg");
    //variable  =  $( this).val() ;
    url_base = "{{ url('/') }}";
     // Peticion ajax
    $.getJSON( url_base + "/usuarioPesca/nuevoPermisoZarpes/new/"+id_variable  , function(data)
      {
        console.log(data);
        $.each( data, function( id) {

                        
                        var tableRef = document.getElementById('table-patron').getElementsByTagName('tbody')[0];

                        // Insert a row in the table at the last row
                        var newRow   = tableRef.insertRow(tableRef.rows.length);

                        // Insert a cell in the row at index 0
                        var newCell  = newRow.insertCell(0);
                        var newCell2 = newRow.insertCell(1);
                        var newCell3 = newRow.insertCell(2);
                        var newCell4 = newRow.insertCell(3);

                        // Append values to cells
                        var x = document.createElement("INPUT");
                        x.setAttribute("type", "number");
                        x.setAttribute("value", data[id].id);
                        x.setAttribute("name", "patrones_id[]");
                        x.style.border = 'none';
                        x.style.background = 'transparent';
                        x.setAttribute("readonly","readonly");
                        x.required = true;
                        var newText2 = document.createElement("INPUT");
                        newText2.setAttribute("type", "text");
                        newText2.setAttribute("value", ""+data[id].apellidos+", "+ data[id].nombres);
                        newText2.setAttribute("name", "apelidos/nombres[]");
                        newText2.style.border = 'none';
                        newText2.style.background = 'transparent';
                        newText2.setAttribute("readonly","readonly");
                        newText2.required = true;

                        var newText3 = document.createElement("INPUT");
                        newText3.setAttribute("type", "text");
                        newText3.setAttribute("value", ""+data[id].dni);
                        newText3.setAttribute("name", "dni[]");
                        newText3.style.border = 'none';
                        newText3.style.background = 'transparent';
                        newText3.setAttribute("readonly","readonly");
                        newText3.required = true;
                        // buttons
                        var newDelete = document.createElement('button');
                        newDelete.className = "btn";
                        newDelete.className += " btn-info glyphicon glyphicon-remove";
                        if (newDelete.addEventListener) {  // all browsers except IE before version 9
                          newDelete.addEventListener("click", function(){deleteFunctionPatron(newDelete);}, false);
                        } else {
                          if (newDelete.attachEvent) {   // IE before version 9
                            newDelete.attachEvent("click", function(){deleteFunctionPatron(newDelete);});
                          }
                        }
                        newCell.appendChild(x);
                        newCell2.appendChild(newText2);
                        newCell3.appendChild(newText3);
                        newCell4.appendChild(newDelete);
                        
                        //document.getElementById('input-function-date')[0].value = '';

            //var result = "<tr><td>" + data[id].id +"</td> <td>" + data[id].apellidos + ", " +data[id].nombres +"</td> <td>" + data[id].dni+"</td> <td>" + newDelete + " </td> </tr>";
            //$("#table-pescadores").append(result);
            


        });
      
            
      })
      $('#botonPat').attr("disabled", true);
      $('#submiParton').modal('hide');  
  //var result = "<tr><td>" + data.nombre +"</td> <td>xx</td> <td>xx</td> <td></td> </tr>";
  //$("#table-pescadores").append(result);
   //$('#submiPescadores').modal('hide');  
  });
    function deleteFunctionPesca(btn){
      var row=btn.parentNode.parentNode.rowIndex;
      document.getElementById('table-pescadores') .deleteRow(row);

                
    } 
    function deleteFunctionPatron(btn){
      var row=btn.parentNode.parentNode.rowIndex;
      document.getElementById('table-patron') .deleteRow(row);
      $('#botonPat').attr("disabled", false);
                
    }  

</script>  

@stop