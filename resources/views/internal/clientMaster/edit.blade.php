@extends('layout.clientMaster')

@section('style')
@stop

@section('title')
Actualizar información
@stop

@section('content')
@include('errors.list')
{!! Form::model($obj, [ 'method' => 'POST', 'url' => 'clientMaster/update','id'=>'form','class'=>'form-horizontal']) !!}
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('name', 'Nombre:', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('lastname', 'Apellidos:', ['class' => 'control-label']) !!}
            {!! Form::text('lastname', null, ['class' => 'form-control','required']) !!}
        </div>
        <div class="form-group">
          <label for="input3" class="control-label">N° Doc.</label>
            {!! Form::number('di', null, array('class' => 'form-control', 'id' => 'input3', 'required')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('address', 'Dirección', ['class' => 'control-label']) !!}
            {!! Form::text('address', null, ['class' => 'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'E-mail', ['class' => 'control-label']) !!}
            {!! Form::text('email', null, ['class' => 'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('phone', 'Telefono', ['class' => 'control-label']) !!}
            {!! Form::text('phone', null, ['class' => 'form-control','required']) !!}
        </div>
    </div>
    <div class="col-sm-7">
        <div class="col-sm-12 text-right">
            {!! Form::submit('Actualizar', ['class' => 'btn btn-info']) !!}
            <a href="{{ url('client') }}" class="btn btn-info">Cancelar</a>
        </div>
    </div>
{!! Form::close() !!}

<style type="text/css">
.form-group {
margin-bottom: 0px;
}
</style>

@stop

@section('javascript')

@stop