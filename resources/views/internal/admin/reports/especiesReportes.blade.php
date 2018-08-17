@extends('layout.admin')

@section('style')

@stop

@section('title')
	Reporte de asignación
@stop

@section('content')
{!!Form::open(array('url' => 'admin/report/especies', 'id'=>'form','class'=>'form-horizontal'))!!}
    {!! csrf_field() !!}
    <div class="row">
        <div class="col-sm-5">
            <label>Rango de Fechas de Asignación</label>
            <hr style="margin:5px;">
            <div class="col-sm-6">
                <label>Desde</label>
                {!!Form::input('date','firstDate', null ,['class'=>'form-control','id'=>'fecha-ini'])!!}
                  <div class="col-sm-6" id="firefox" style="visibility: hidden">
                      Formato fecha: aaaaa-mm-dd
                  </div>                    
            </div>
            <div class="col-sm-6">
                <label>Hasta</label>
                {!!Form::input('date','lastDate', null ,['class'=>'form-control','id'=>'fecha-fin'])!!}
                  <div class="col-sm-6" id="firefox2" style="visibility: hidden">
                      Formato fecha: aaaaa-mm-dd
                  </div>                    
            </div>
        </div>
        <div class="col-sm-2">
            <br>
            <p><button class="btn btn-info" type="button" id = 'botoncito' >Buscar</button></p>
        </div>
    </div>  
    <div id="reporte-especies"></div>
 {!!Form::close()!!}
@stop

@section('javascript')

<script>
$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});

$("#botoncito").click(function () {

    
    var date1 = document.getElementById("fecha-ini");
    var date2 = document.getElementById("fecha-fin");
    var dateS1 = date1.value.toString();
    var dateS2 = date2.value.toString();
    var d1 = new Date(dateS1);
    var d2 = new Date(dateS2);
    d1.setDate(d1.getDate());
    d2.setDate(d2.getDate());
    url_base = "{{ url('/') }}";
    var _token = $('input[name="_token"]').val();
    var dataJson = [{antes: d1, despues: d2}];
    $.ajax({
        type: "POST",
        url: url_base + "/admin/report/especies",
        data: {"dates" : JSON.stringify(dataJson)},
        dataType: 'json',
        // contentType: 'application/json',
        cache: false,
        success: function(data){
            console.log(data);
            Highcharts.chart('reporte-especies', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Reporte Mensual de Pesca de Especies Marinas'
                },
                xAxis: {
                    categories: data.categories
                },
                yAxis: {
                    title: {
                        text: 'Tonaladas (T)'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: true
                    }
                },
                series: data.series
            });
        }
    });
    // $.getJSON(url_base+"/getHistorialHielo/"+especie_id+"/"+puerto_id+"/"+embarcacion_id, function(data)
    //   {
    //       console.log(data);
    //   }
    

});
</script>

<script>
$('document').ready(function () {

  if(navigator.userAgent.indexOf("Firefox")>-1 ) {
    console.log("its firefox");
    document.getElementById('firefox').style.visibility='visible';
    document.getElementById('firefox2').style.visibility='visible';
    document.getElementById('firefox3').style.visibility='visible';
    document.getElementById('firefox4').style.visibility='visible';
  }
})
</script>     

@stop