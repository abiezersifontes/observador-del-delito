@extends('layout.menu')
@section('sidebar')
  <div class="container">
    <div class="row">
    </br></br>
      <div class="col-lg-11 col-md-11 col-xs-11 ">
        <div class="col-lg-12 col-md-12 col-xs-12 ">
          <form>
            <div class="col-lg-4 col-md-4 col-xs-4 ">
              <label for="desde">Año</label>
              <select id="anio" class="form-control">
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
              </select>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-4 ">
              <label for="desde">Mes</label>
              <select id="mes" class="form-control">
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
              </select>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3 ">
            </br>
              <button id="consultar" class="btn btn-success"type="button" name="button">Consultar</button>
            </div>
          </form>
        </div>
        </br></br>
        <div id="grafica_barra">
          <div id="alerta" class="hide">
          </br></br></br>
            <div class="alert alert-danger">
              Debe ingresar fechas validas
            </div>
          </div>
        </div>
        </br></br>
      </div>
    </div>
  </div>

@endsection
@section('scripts')

<script>


$('#consultar').click(function(e){
  e.preventDefault();
  var anio = $('#anio').val();
  var mes = $('#mes').val();
  cargar_grafica_barras(anio, mes);
});


function cargar_grafica_barras(anio,mes){

var options={
	 chart: {
	 	    renderTo: 'grafica_barra',
            type: 'column'
        },
        title: {
            text: 'Numero de delitos en el mes'
        },
        subtitle: {
            text: 'por: CESYC'
        },
        xAxis: {
            categories: [],
             title: {
                text: 'dias del mes'
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Delitos al dia'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +'<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Cantidad de delitos',
            data: []

        }]
}


var url = "graficar_barra1/"+anio+"/"+mes;


$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);
var totaldias=datos.totaldias;
var registrosdia=datos.registrosdia;
var i=0;

	for(i=1;i<=totaldias;i++){
	options.series[0].data.push( registrosdia[i] );
	options.xAxis.categories.push(i);
	}
  console.log(options);
 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);
});
}
</script>
@endsection
