@extends('layout.usuarioPesca')

@section('style')

@stop

@section('title')
  Bienvenido Usuario de Pesca
@stop

@section('content')
	<a  class="btn btn-info" href="{{url('usuarioPesca/password')}}">Restaurar contraseña</a>
@stop

@section('javascript')

@stop

@section('content')
  <!-- Contenido-->