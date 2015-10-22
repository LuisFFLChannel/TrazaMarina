@extends('layout.admin')

@section('style')

@stop

@section('title')
	Editar punto de venta
@stop

@section('content')
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
          {!!Form::open(array('url' => 'admin/modules/'.$module->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Nombre</label>
              <div class="col-sm-10">
                {!!Form::input('text','name', $module->name ,['class'=>'form-control','id'=>'inputName','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress" class="col-sm-2 control-label">Dirección</label>
              <div class="col-sm-10">
                {!!Form::input('text','address', $module->address ,['class'=>'form-control','id'=>'inputAddress','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputDistrict" class="col-sm-2 control-label">Distrito</label>
              <div class="col-sm-10">
                {!!Form::input('text','district', $module->district ,['class'=>'form-control','id'=>'inputDistrict','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputProvince" class="col-sm-2 control-label">Provincia</label>
              <div class="col-sm-10">
                {!!Form::input('text','province', $module->province ,['class'=>'form-control','id'=>'inputProvince','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputState" class="col-sm-2 control-label">Departamento</label>
              <div class="col-sm-10">
                {!!Form::input('text','state', $module->state ,['class'=>'form-control','id'=>'inputState','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Teléfono</label>
              <div class="col-sm-10">
                {!!Form::input('number','phone', $module->phone ,['class'=>'form-control','id'=>'inputPhone','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Correo</label>
              <div class="col-sm-10">
                {!!Form::input('email','email', $module->email ,['class'=>'form-control','id'=>'inputEmai3','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputStartTime" class="col-sm-2 control-label">Hora de Apertura</label>
              <div class="col-sm-10">
                {!!Form::input('time','starTime', $module->starTime,['class'=>'form-control','id'=>'inputStartTime','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputEndTime" class="col-sm-2 control-label">Hora de Cierre</label>
              <div class="col-sm-10">
                {!!Form::input('time','endTime', $module->endTime ,['class'=>'form-control','id'=>'inputEndTime','required'])!!}
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
              <div class="col-sm-10">
                {!!Form::input('file','image', null ,['class'=>'form-control','id'=>'inputEmail3'])!!}
                {{$module->image}}
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">Guardar</button>
                <a href="{{action('ModuleController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
              </div>
            </div>
          {!!Form::close()!!}
          </div>
        </div>
@stop

@section('javascript')

@stop