@extends('layout.usuarioIntermediario')

@section('style')

@stop

@section('title')
  Bienvenido Usuario de Intermediario
@stop

@section('content')
	<a  class="btn btn-info" href="{{url('usuarioIntermediario/password')}}">Restaurar contraseña</a>
@stop

@section('javascript')

@stop

@section('content')
  <!-- Contenido-->