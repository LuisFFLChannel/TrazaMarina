@extends('layoutExternal')

@section('style')
	
@stop

@section('title')
	Home
@stop

@section('content')
	<h5>Busqueda</h5>
        <div class="input-group" style="width:290px">
            <input type="text" class="form-control" placeholder=" ">
            <span class="input-group-btn">
                <button class="btn btn-info" type="button">Buscar</button>
            </span>
        </div>
<br><br>
         <div class="row">

            <div class="col-md-7">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="img-responsive" src="images/peppa.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/jaja.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/arctic.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/bruta.jpg" alt="">
                        </div>
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

            <div class="col-md-4">
                 
        <br>  <br>
       

            </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Eventos próximos</h3>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="images/bruta.jpg"  alt="">
                </a>
            </div>

       

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="images/peppa.jpg" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="images/jaja.jpg" alt="">
                </a>
            </div>

        </div>
        <!-- /.row -->

        <hr>
@stop

@section('javascript')

@stop