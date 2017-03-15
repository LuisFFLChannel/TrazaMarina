@extends('layout.client')

@section('style')
@stop

@section('title')
Cambia Imagen
@stop

@section('content')
  <div class="row">
    <div class="col-sm-8">
      {!!Form::open(array('files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        <div class="form-group">
          <label for="inputImage" class="col-sm-2 control-label">Imagen</label>
          <div class="col-sm-10">
            {!! Form::file('image', ['class' => 'form-control', 'id' => 'inputImage','required']) !!}
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-info">Guardar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@stop

@section('javascript')

@stop