@extends('layout.admin')

@section('style')

@stop

@section('title')
	Devoluciones
@stop

@section('content')
        <!-- Contenido-->
          <table class="table table-bordered table-striped">
            <tr>
              <th>Cliente</th>
              <th>Código Ticket</th>
              <th>Administrador</th>
              <th>Fecha</th>
              <th>Cantidad de Entradas</th>
              <th>Precio Individual</th>
              <th>Monto Devuelto</th>

            </tr>

            <tr>
              <td>Cliente Amargado 3</td>
              <td>011-10911873248</td>
              <td>Vip</td>
              <td>20-12-2015 00:00:00</td>
              <td>2</td>
              <td>150.00</td>
              <td>300.00</td>
            </tr>
            <tr>
              <td>Cliente Amargado 3</td>
              <td>011-10932553248</td>
              <td>Vip</td>
              <td>20-12-2015 00:00:00</td>
              <td>2</td>
              <td>150.00</td>
              <td>300.00</td>
            </tr>
            <tr>
              <td>Cliente Amargado 3</td>
              <td>081-10932873248</td>
              <td>Vip</td>
              <td>20-12-2015 00:00:00</td>
              <td>2</td>
              <td>150.00</td>
              <td>300.00</td>
            </tr>
            <tr>
              <td>Cliente Amargado 3</td>
              <td>001-10932873248</td>
              <td>Vip</td>
              <td>20-12-2015 00:00:00</td>
              <td>2</td>
              <td>150.00</td>
              <td>300.00</td>
            </tr>

            <tr>
              <td>Cliente Lagrimoso 1</td>
              <td>021-10222873248</td>
              <td>Normal</td>
              <td>20-12-2015 00:00:00</td>
              <td>3</td>
              <td>50.00</td>
              <td>150.00</td>
            </tr>

            <tr>
              <td>Cliente Amargado 4</td>
              <td>003-10442873248</td>
              <td>Haters</td>
              <td>20-12-2015 00:00:00</td>
              <td>3</td>
              <td>100.00</td>
              <td>300.00</td>
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