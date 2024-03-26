<?php

// include_once('./conecction.php');

//get graph data- estados citas
include("./controllers/Datos/po_estado_grafico.php");
include("./controllers/Datos/po_marcas_carros_registrados.php");

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Dashboard</title>
  </head>
  <body>
    <div id="dashboardMainContainer" class="col-lg-12" style="padding-top: 20px;">
        <!-- include sidebar -->
        <div class="dashboard_content_container" id="dashboard_content_container">
            <!-- include top nav -->
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <div class="col50">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                        </figure>
                    </div>
                    <div class="col50">
                        <figure class="highcharts-figure">
                            <div id="containerBarChart"></div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
var graphData = <?=json_encode($results)?>;

Highcharts.chart('container', {
    colors: ['#FD7878', '#EBD38D', '#8BD494', '#baf201', '#f201ba'],  
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Estado de las citas'
    },
    tooltip: {
        valueSuffix: '%',
        pointFormatter:function(){
            var point = this,
            series = point.serie;

            return `<b>${series.name}</b>: <b>${point.y}</b>`
        }
    },

    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y}'
            },
            showInLegend: true
        }
    },
    series: [
        {
            name: 'Estado',
            colorByPoint: true,
            data: graphData
        }
    ]
});




var barGraphData = <?= json_encode($cantidad_data)?>;
var barGraphMarcas = <?= json_encode($marcas)?>

Highcharts.chart('containerBarChart', {
  chart: {
    type: 'column',
    zoomType: 'y'
  },
  title: {
    text: 'Marcas Registradas'
  },
  
  xAxis: {
    categories:barGraphMarcas,
    title: {
      text: null
    },
    accessibility: {
      description: 'Autos'
    }
  },
  yAxis: {
    min: 0,
    tickInterval: 2,
    title: {
      text: 'Cantidad Marcas Registradas'
    },
    labels: {
      overflow: 'justify',
      format: '{value}'
    }
  },
  plotOptions: {
    column: {
      dataLabels: {
        enabled: true,
        format: '{y}'
      }
    }
  },
  tooltip: {
    valueSuffix: ' ',
    stickOnContact: true,
    backgroundColor: 'rgba(255, 255, 255, 0.93)',

  },
  legend: {
    enabled: false
  },
  series: [
    {
      name: 'Registros de autos',
      data: barGraphData,
      borderColor: '#5997DE'
    }
  ]
});
</script>


  </body>
</html>