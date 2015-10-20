@extends('layout.salesman')

@section('style')
    {!!Html::style('css/seats.css')!!}
@stop

@section('title')
	Nueva Venta - Entradas
@stop

@section('content')
    {!!Form::open(array('route' => 'ticket.store'))!!}
    <fieldset>
        <legend>Información del evento</legend>
        <div class="select Type"> 
            <label>
                <div style="-webkit-columns: 100px 3;">
                    <h4 class="boxy"> Codigo del Evento </h4>
                    {!! Form::text('code', '09213241', ['class' => 'form-control boxy', 'disabled']) !!}
                    {!!Form::hidden('event_id',$event['id'])!!}
                    <h4 class="boxy"> Nombre del Evento </h4>
                    {!! Form::text('event_name', 'Piaf de Pam Gems', ['class' => 'form-control boxy', 'disabled']) !!}
                    <h4 class="boxy">Entradas Disponibles</h4>
                    {!! Form::text('available', '520', ['class' => 'form-control boxy', 'disabled']) !!}  
                </div>
                <div style="-webkit-columns: 100px 3;">
                    <h4 class="boxy"> Fecha del Evento </h4>
                    {!! Form::select('date', ['18 Octubre', '19 Octubre', '20 Octubre'], null, ['class' => 'form-control boxy']) !!}
                    <h4 class="boxy"> Hora </h4>
                    {!! Form::select('hour', ['19:00', '21:00'], null, ['class' => 'form-control boxy']) !!}
                    <h4 class="boxy"> Zona del Evento </h4>
                    {!! Form::select('zone', ['VIP', 'Platea'], null, ['class' => 'form-control boxy']) !!}
                </div>
                <h4> Promoción </h4>
                {!! Form::select('promotion', ['Ninguna', 'Pre-venta', 'Visa Platinium'], null, ['class' => 'form-control']) !!}
            </label>
        </div>
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" style="widht:1px">
            <thead>
                <tr>
                    <th>Zona</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>VIP</td>  
                    <td>S/.150.00</td>
                </tr>
                <tr>
                    <td>VIP Pre-venta</td>  
                    <td>S/.135.00</td>
                </tr>
                <tr>
                    <td>Platea</td>  
                    <td>S/.70</td>
                </tr>
                <tr>
                    <td>Platea - %30 descuento con Visa Platinium</td>  
                    <td>S/.49</td>
                </tr>
            </tbody>
          </table>
        </div>
        <fieldset>
            <legend>Información del cliente</legend>
            <div style="-webkit-columns: 100px 2;">
                <h5>Ingrese Usuario</h5>
                <div class="input-group" style="width:290px">
                    {!! Form::number('number', null, ['class' => 'form-control', 'placeholder' => 'Documento de Identidad...','id'=>'user_di','min'=>0]) !!}
                </div><!-- /input-group -->
                <h5>Nombre de Cliente</h5>
                {!! Form::text('name', null, ['class' => 'form-control', 'disabled', 'id'=>'user_name']) !!}
                {!! Form::hidden('user_id', null, ['id'=>'user_id'])!!}
            </div>
            
            <br>
            <br>
        </fieldset>
        <legend>Selección de Ubicación</legend>
        <h5>Zona:</h5>
        {!! Form::text('zoneSelected', 'VIP', ['class' => 'form-control', 'disabled']) !!}
        <br>
        <div class="seats">
            <div class="demo">
                <div id="seat-map">
                    <div class="front">Escenario</div>                  
                </div>
                <br>
                <div class="booking-details">
                    <h4 style="text-decoration:underline;text-align: center;">Resumen</h4>
                    <p>Evento: <span> Piaf de Pam Gems</span></p>
                    <p>Día: <span>Octubre 13, 21:00</span></p>
                    <p>Asiento(s): </p>
                    <ul id="selected-seats"></ul>
                    <p>Tickets: <span id="counter">0</span></p>
                    <p>Total: <b>S/.<span id="total">0</span></b></p>
                    <div id="legend"></div>
                </div>
                <div style="clear:both"></div>
           </div>
        </div>
        {!!Form::hidden('seats',null, array('id'=>'seats'))!!}
        <!-- Content Row -->
        <!-- /.row -->
        <hr>
        <div class= "button-final">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#mix2" data-whatever="@mdo">Realizar Pago</button>
            <button type="button" class="btn btn-info">Cancelar Venta</button>
            <button type="button" class="btn btn-info" data-dismiss="modal" data-target="#visualizarVenta"><i class="glyphicon glyphicon-print"></i></button>

            <div class="modal fade" id="mix2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Detalle de Pago:</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Monto a Pagar</label>
                                <input type="text" class="form-control" placeholder="S/.90.00" readonly="">
                                <br>
                                <div class="form-group checkbox pay">
                                    <label><input type="checkbox" value="" id="creditCardPay">Pago con tarjeta</label>
                                    <hr>
                                    <label for="exampleInputEmail2">Número de Tarjeta</label>
                                    <input type="number" id="creditCardNumber" class="form-control" placeholder="1234 5678 9012 3456" disabled="true">
                                    <label for="exampleInputEmail2">Fecha de expiración</label>
                                    <input type="date" id="expirationDate" class="form-control" placeholder="mm/aa" disabled="true">
                                    <label for="exampleInputEmail2">Código de Seguridad</label>
                                    <input type="number" id="securityCode" class="form-control" placeholder="123" disabled="true">
                                    <label for="exampleInputEmail2">Monto a pagar con tarjeta</label>
                                    <input type="number" id="payment" class="form-control" placeholder="60" disabled="true">
                                </div>
                                <br>  
                                <div class="form-group checkbox pay">
                                    <label><input type="checkbox" value="" id="cashPay">Pago con efectivo</label>
                                    <h5>Tipo de Cambio: S/.2.90</h5>
                                    <hr>
                                    <label for="exampleInputEmail2">Monto Ingresado</label>
                                    <input type="text" id="amount" class="form-control" placeholder="S/.50.00" disabled="true">
                                    <label for="exampleInputEmail2">Vuelto</label>
                                    <input type="text" class="form-control" placeholder="S/.10.00" readonly>
                                    <br>
                                    {!!Form::submit('Pagar Entrada',array('class'=>'btn btn-info'))!!}
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </fieldset>  
    {!!Form::close()!!}


@stop

@section('javascript')
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}
    {!!Html::script('js/main.js')!!}

    <script type="text/javascript">
        var config = {
        routes: [
            { zone: "{{ URL::route('ajax.getClient') }}" }
        ]
    };
    </script>
        
@stop