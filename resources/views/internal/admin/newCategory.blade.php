@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nueva Categoria
@stop

@section('content')
  <!-- Contenido-->
  <div class="row">
    <div class="col-sm-12">
      @if (count($errors) > 0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible alert-header" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          {{ strtoupper($error) }}
        </div>
        @endforeach
      @endif
    </div>
    <div class="col-sm-8">
      {!!Form::open(array('route' => 'categories.store','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="inputEmail3" value="{!!old('name')!!}" placeholder="" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputImage" class="col-sm-2 control-label">Imagen</label>
          <div class="col-sm-10">
            {!! Form::file('image', ['class' => 'form-control', 'id' => 'inputImage']) !!}
          </div>
        </div>  
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="description" text="{!!old('description')!!}" rows="5" id="description"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2" for="isSub">Subcategoria?</label>
          <div class="col-sm-10">
            <input id="isSub" type="checkbox" @if (old('father_id') != '') checked @endif data-toggle="collapse" data-target="#subcategoryForm">  
          </div>
        </div>
        <div id="subcategoryForm" class="collapse form-group @if (old('father_id') != '') in @endif">
          <label class="col-sm-2" for="subcategory">Elija Categoria</label>
          <div class="col-sm-10">
            {!! Form::select('father_id', array('' => '') +$categories_list->toArray(), old('father_id'), array('class' => 'form-control','id' => 'subcategory')) !!}
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-info">Guardar</button>
            <button type="button" class="btn btn-info"><a href="{{action('CategoryController@index')}}">Cancelar</a></button>
          </div>
        </div>
      </form>
    </div>
  </div>
@stop

@section('javascript')

@stop