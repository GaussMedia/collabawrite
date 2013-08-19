<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="highchart.js"></script>

<script type="text/javascript">
$(function () {
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type : 'column'
        },
       xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
               week :'%e.' 
            },
            tickInterval: 7 * 24 * 3600 * 1000, // one week
            tickWidth: 0,
            gridLineWidth: 1,
            labels: {
                align: 'left',
                //x: 3,
               // y: -3
            }

        },

        series: [{
            name: 'Reads',
            data:
            [                
//                    [Date.UTC(2013, 06, 15), 10],
//                    [Date.UTC(2013, 06, 19), 20],
//                    [Date.UTC(2013, 06, 20), 44],
//                    [Date.UTC(2013, 06, 23), 5]
            ]
        }]
    });

$(document).ready(function() {
     var myArr = [];
    $.getJSON('getData.php', function(data) {
                chart.series[0].setData(data);
});
    $('#button1').click(function() {
        chart.series[0].update({name:"Recommends"}, false);
        chart.redraw();
    });
});
 $('#button').click(function() {
     var myArr = [];
    $.getJSON('getData.php', function(data) {
                chart.series[0].setData(data);
});
 });
 $('#button2').click(function() {
     var myArr = [];
                $.getJSON('getdataviews.php', function(data) {
                chart.series[0].setData(data);
                });
                chart.series[0].update({name:"Views"}, true);
                chart.redraw();
 });
 $('.button3').click(function() {
     var post_id = $(this).attr('id');
     var myArr = [];
                $.getJSON('getdataviewsperticular.php?post_id='+post_id, function(data) {
                chart.series[0].setData(data);
                });
                chart.series[0].update({name:"Views"}, true);
                chart.redraw();
 });
});
</script>
  </head>

  <body>
    <div id="container" style="width: 800px; height: 400px"></div>
    <button id="button">Reads</button>
    <button id="button1">Recommends</button>
    <button id="button2">Views</button>
    <?php
    session_start();
include('Twitter_Login/config/dbconfig.php');
include('webadmin/k.php');
include('webadmin/resize-class.php');
$obj = new KARAMJEET();
$session_id = $_SESSION['id'];
    $sql_post ="SELECT * FROM drafts WHERE status = '1' AND author = '$session_id' ";
    $res_post = mysql_query($sql_post);
    while($Result_post = mysql_fetch_array($res_post)){
        echo '<br><span class="button3" id="'.$Result_post['id'].'">'.$Result_post['title'].'</span>';
}
    ?>
  </body>
</html>