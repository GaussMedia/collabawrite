<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js" ></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script>
            $(function () {
    $('#container').highcharts({
        chart: {
                type: 'column'
            },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
                day: '%e of %b'
            }
        },

        series: [{
            name : 'Views',
            data: [ [Date.UTC(2013, 00, 15, 11, 11, 47, 7), 10],
                    [Date.UTC(2013, 00, 19, 11, 11, 47, 17), 20],
                    [Date.UTC(2013, 00, 20, 11, 11, 47, 29), 44],
                    [Date.UTC(2013, 00, 23, 11, 11, 47, 39), 5]]
           // pointStart: Date.UTC(2013, 6, 1),
         //   pointInterval: (24 * 3600 * 1000 ) + (24 * 3600 * 1000) + (24 * 3600 * 1000) + (24 * 3600 * 1000)   // one weak
        }]
    });
});
$('#button').click(function() {
        $.get('getData.php', function(data) {
        chart.series[0].setData(data);
        chart.series[0].update({name:"Views"}, false);
        chart.redraw();
        });
    });
     $('#button1').click(function() {
        chart.series[0].update({name:"Recommends"}, false);
        chart.redraw();
    });
        </script>
    </head>
    <body>
<div id="container" style="height: 400px; width: 400px;"></div>
<button id="button">Set new data</button>
<button id="button1">Recommends</button>
    </body>
</html>
