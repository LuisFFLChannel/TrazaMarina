@extends('layout.admin')

@section('style')
  <style type="text/css">
    .form-control{  
    }
  </style>
@stop

@section('title')
	Lista de vendedores
@stop

@section('content')
        <!-- Contenido-->
        <br>
        <h5>Selecciona un departamento</h5>
        <div class="dropdown">
            <button style="background-color:#83D3C9; border-color:#83D3C9; color:white;" class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"> Lima
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Arequipa</a></li>
                <li><a href="#">Ica</a></li>
                <li><a href="#">Moquegua</a></li>
                <li><a href="#">Tacna</a></li>
            </ul>
        </div>
        
        <h5>Selecciona un distrito</h5>
        
        <div  class="dropdown">
            <button  style="background-color:#83D3C9; border-color:#83D3C9; color:white;" class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"> Chorrillos
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Pueblo Libre</a></li>
                <li><a href="#">Santa Rosa</a></li>
                <li><a href="#">Ventanilla</a></li>
                <li><a href="#">Breña</a></li>
                <li><a href="#">San Miguel</a></li>
                <li><a href="#">Jesús María</a></li>
                <li><a href="#">Magdalena del Mar</a></li>
                <li><a href="#">Lince</a></li>
                <li><a href="#">San Isidro</a></li>
            </ul>
        </div>
        <br>
        <br>

         <fieldset>
            <legend>Vendedores: </legend>
            <div style="-webkit-columns: 80px 2; display:inline-block;float:left">
              Código:  <input type="text" class="form-control" name="firstname" value="">  
              Nombre/Apellidos: <input type="text" class="form-control" name="lastname" value="">  
            </div>
             <br>   
            <a href="#" class="btn btn-info" >Buscar</a>
            <br><br><br> 
        </fieldset>


        <table class="table table-bordered table-striped">
            <tr>
                <th>Apellidos y Nombres</th>
                <th>Documento Identidad</th>
                <th>Número de Documento</th>
                <th>Telefonos</th>
                <th>Editar</th>
                <th>Detalle</th>
                <th>Eliminar</th>
                <th>Asistencia</th>
            </tr>
            <tr>
                <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
                <td>
                    <a class="btn btn-info" href="{{url('admin/salesman/1/edit')}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                </td>
                <td>
                    <a class="btn btn-info" href="#" title="Detalle" data-toggle="modal" data-target="#edit"><i class="glyphicon glyphicon-plus"></i></a>
                  </td>
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Detalle del promotor</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Nombre</h4>
                            <h4>Direccion</h4>
                            <h4>DNI</h4>
                            <h4>Telefono</h4>
                            <h4>Email</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                <td>
                     <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                 </td>
                 <td>    
                 <a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a>
                </td>
            </tr>
           <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
                <td>
                    <a class="btn btn-info" href="{{url('admin/salesman/1/edit')}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                </td>
                <td>
                    <a class="btn btn-info" href="#" title="Detalle" data-toggle="modal" data-target="#edit"><i class="glyphicon glyphicon-plus"></i></a>
                  </td>
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Detalle del promotor</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Nombre</h4>
                            <h4>Direccion</h4>
                            <h4>DNI</h4>
                            <h4>Telefono</h4>
                            <h4>Email</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                <td>
                     <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                 </td>
                 <td>    
                 <a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a>
                </td>
            </tr>
            <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
                <td>
                    <a class="btn btn-info" href="{{url('admin/salesman/1/edit')}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                </td>
                <td>
                    <a class="btn btn-info" href="#" title="Detalle" data-toggle="modal" data-target="#edit"><i class="glyphicon glyphicon-plus"></i></a>
                  </td>
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Detalle del promotor</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Nombre</h4>
                            <h4>Direccion</h4>
                            <h4>DNI</h4>
                            <h4>Telefono</h4>
                            <h4>Email</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                <td>
                     <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                 </td>
                 <td>    
                 <a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a>
                </td>
            </tr>

            </tr>
            <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
                <td>
                    <a class="btn btn-info" href="{{url('admin/salesman/1/edit')}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                </td>
                <td>
                    <a class="btn btn-info" href="#" title="Detalle" data-toggle="modal" data-target="#edit"><i class="glyphicon glyphicon-plus"></i></a>
                  </td>
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Detalle del promotor</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Nombre</h4>
                            <h4>Direccion</h4>
                            <h4>DNI</h4>
                            <h4>Telefono</h4>
                            <h4>Email</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                <td>
                     <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                 </td>
                 <td>    
                 <a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a>
                </td>
            </tr>
        </table>
        <nav>
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
@stop

@section('javascript')

@stop