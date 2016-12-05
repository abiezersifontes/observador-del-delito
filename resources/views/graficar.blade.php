@extends('layout.menu')
@section('sidebar')
  <div class="container">
    <div class="row">
      <div class="col-lg-11 col-md-11 col-xs-11 ">
        </br></br>
        <div class="col-lg-12 col-md-12 col-xs-12 ">
          <form>
            <div class="col-lg-4 col-md-4 col-xs-4 ">
              <label for="desde">Desde</label>
              <input type="date" name="desde" id="desde" class="form-control">
            </div>
            <div class="col-lg-4 col-md-4 col-xs-4 ">
              <label for="desde">Hasta</label>
              <input type="date" name="hasta" id="hasta" class="form-control">
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3 ">
            </br>
              <button id="consultar" class="btn btn-success"type="button" name="button">Consultar</button>
            </div>
          </form>
        </div>
        </br></br>
        <div id="grafica">
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
  var desde = $('#desde').val();
  var hasta = $('#hasta').val();
  if(hasta.length==0 || hasta.length==0){
    $('#alerta').attr('class','show');
  }else {
    $('#alerta').attr('class','hide');
      cargar_grafica_pie(desde,hasta);
  }

});


function cargar_grafica_pie(desde,hasta){

var options={
     // Build the chart

            chart: {
                renderTo: 'grafica',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Grafica de Sucesos'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Delitos',
                colorByPoint: true,
                data: []
            }]

}



var url = "graficar1/"+desde+"/"+hasta;


$.get(url,function(result){
/*
  var delitos_all = new Array('Asesinato', 'Robo', 'Extorsion', 'Violacion', 'Trafico_de_drogas', 'Indefinido', 'No_delito');

  var delitos1 = result[0][0];

  for(k=0;k<delitos1.length;k++){
    console.log(delitos1[k].delito);
    for (o=0;o<delitos_all.length;o++) {
      if(delitos_all[o] === delitos1[k].delito){
        console.log(delitos_all[o]+" <--> "+delitos1[k].delito);
        delitos_all.splice(o,o);
      }
    }
    var prueba = delitos_all[$k].localeCompare(delitos1[0].delito);
    if(!prueba){
      console.log(delitos_all[$k]+" <--> "+delitos1[0].delito);
      console.log('eliminados');
      delitos_all.splice($k,$k);
    }
  }

  for(r=0;r<delitos_all.length;r++){
    var indice = indexOf(delitos_all[r]);
    texto = "- "+indice+"<br/>"+delitos_all[r];
    console.log(texto);
  }

  var cant_delitos = result[0][1];


  var tipos=['Robo','Violacion','Asesinato'];
  var totattipos=cant_delitos.length;
  var numeropublicaciones=[2,3,1];

      for(i=0;i<=totattipos-1;i++){
        var objeto= {name: delitos[i].delito, y:cant_delitos[i] };
        options.series[0].data.push( objeto );
      }
   //options.title.text="aqui e podria cambiar el titulo dinamicamente";
   chart = new Highcharts.Chart(options);
*/

  var delitos = result[0][0];
  var cant_delitos = result[0][1];
  //var tipos=['Robo','Violacion','Asesinato'];
  var totattipos=cant_delitos.length;
  var numeropublicaciones=[2,3,1];
      for(i=0;i<=totattipos-1;i++){
        var objeto= {name: delitos[i].delito, y:cant_delitos[i] };
        options.series[0].data.push( objeto );
      }
   //options.title.text="aqui e podria cambiar el titulo dinamicamente";
   chart = new Highcharts.Chart(options);

});

}

</script>
@endsection
