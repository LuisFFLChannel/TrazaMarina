@extends('layoutExternal')

@section('style')
@stop

@section('title')
	Bienvenido...
@stop

@section('content')
	<h5>Búsqueda</h5>
    <div class="input-group">
        {!! Form::text('search', '', array('class' => 'form-control','id'=>'textSearch')) !!}
        <span class="input-group-btn">
            <a href="#" class="btn btn-info" id="searchButton">Buscar</a>
        </span>
    </div>
    @if (count($destacados)>0)
    <div class="container">
         <div class="row">
            <div class="col-md-7" style="left:300px">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        @foreach ($destacados as $key=>$destacado)
                        <li data-target="#carousel-example-generic" data-slide-to={{$key}} @if($key == 0)class="active" @endif></li>
                        @endforeach
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @foreach ($destacados as $key=>$destacado)
                        <div class="item @if($key==0)active @endif">
                            <a href="event/{{$destacado->event_id}}">
                            <img class="img-responsive" src="{{$destacado->event->image}}" alt="">
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Eventos próximos</h3>
            </div>

            @foreach($upcoming as $event)

            <div class="col-sm-3 col-xs-6">
                <a href="event/{{$event->id}}">
                    {!! Html::image($event->image, null, array('class'=>'img-responsive img-hover img-related')) !!}
                    <br>
                </a>
                <div class="text-center">
                    <h3>{{$event->name}}</h3>
                    <b>Fecha de venta: </b> {{date('Y-m-d',$event->selling_date)}}<br>
                    <b>Categoria: </b> {{$event->category->name}} <br>
                    @if($event->place->row)
                        <b>Evento Numerado </b>
                    @else
                        <b>Evento No Numerado </b>
                    @endif
                </div>

            </div>

            @endforeach

        </div>
        <br>

@stop

@section('javascript')
<script type="text/javascript">
    $( document ).ready(function() {
        $('#searchButton').on('click',function(){
            var titulo = $('#textSearch').val();
            $('#searchButton').attr('href', 'event?title='+titulo);
        });
    });
</script>
@stop