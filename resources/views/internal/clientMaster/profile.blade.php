@extends('layout.clientMaster')

@section('style')
@stop

@section('title')
Perfil
@stop

@section('content')
<div class="col-sm-3">
    <img src="{{$client->image}}" class="img-responsive user-photo" >
    <p class="text-info text-center">Foto de perfil</p>
</div>
<div class="col-sm-4">
    <p><b>Nombre</b>: {{$client->lastname}}, {{$client->name}}</p>
    <p><b>
    @if($client->di_type == 1)
        DNI
    @else
        @if($client->di_type == 2)
        Carnet de Extranjeria
        @else
        Pasaporte
        @endif
    @endif
    </b> {{$client->di}}</p>
    <p><b>Dirección: </b>{{$client->address}}</p>
    <p><b>Teléfono:</b> {{$client->phone}}</p>
    <p><b>E-mail:</b> {{$client->email}}</p>
    <p><b>Fecha nacimiento:</b> {{ date("d-M-Y",$birthday) }}</p>
</div>
<div class="col-sm-4">
    <br>
</div>
<div class="col-sm-12">
    <hr>
<p class="text-center"><a class="btn btn-info" href="{{url('clientMaster/edit')}}">Editar </a> <a  class="btn btn-info" href="{{url('clientMaster/password')}}">Restaurar contraseña</a> <a type="button" class="btn btn-info" href="{{url('clientMaster/photo')}}">Cambiar foto</a></p>
</div>
@stop

@section('javascript')

@stop