<html>
  <head>
      <script type="text/javascript" src="FusionCharts/FusionCharts.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
<script type="text/javascript" src="FusionCharts/FusionCharts.jqueryplugin.js"></script>
      <script>
      $("#chartContainer1").insertFusionCharts({
type: "Column3D",
width: "600",
height: "300",
dataFormat: "json",
dataSource: {
   "chart":{
	  "caption":"Monthly Sales Summary",
	  "subcaption":"For the first half of 2013",
	  "xAxisName":"Month",
	  "yAxisName":"Sales",
	  "numberPrefix":"$",
	  "bgcolor":"ffffff"
   },
   "data":[
	  { "label":"January", "value":"14400" },
	  { "label":"February", "value":"19600" },
	  { "label":"March", "value":"24000" },
	  { "label":"April", "value":"15700" },
	  { "label":"May", "value":"23700" },
	  { "label":"June", "value":"22800" }
   ],
   "trendlines":[ {
		 "line":[{
			   "startValue":"17100",
			   "displayValue":"Last year's {br} average",
			   "valueOnRight":"1",
			   "color":"999999"
			}]
	  }]
	  }
});</script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          [ 'views', 'reads', 'recs'],
          [  1000,      400,     55],
          [  1170,      460,     55],
          [  660,       1120,    55],
          [  1030,      540,     55]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
    
    
    <div id="chartContainer1" style="width: 900px; height: 500px;"></div>
    
    
  </body>
</html>