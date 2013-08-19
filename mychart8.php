<?php
//session_start();
//include('Twitter_Login/config/dbconfig.php');
//include('webadmin/k.php');
//include('webadmin/resize-class.php');
//$obj=new KARAMJEET();
// $sql = " SELECT * FROM `recommends` WHERE recommend_post='364' AND recommend_post IN (SELECT id FROM drafts WHERE status = '1')ORDER BY id DESC";
//$res = mysql_query($sql)or die(mysql_errno());
//$numResults = mysql_num_rows($res);
////echo $numResults;
//if  ($numResults != 0)
//    {
//    $rowResult = mysql_fetch_array($res);
//        for ($i = 0;$i < $numResults; $i++)
//        {
//            //$row = $result->fetch_assoc();
//            //$rowdata = $rowResult['creation_date'];
//            //echo '<pre>';
//           // echo date('d m Y',$rowResult[$i]['creation_date']);
//            //array_push($returnArray,array(intval($row['powerWeek']) , intval($row['powerPower']) ));
//            $values[] = date('d m Y',$rowResult[$i]['creation_date']);;
//
//        }
//        //echo json_encode($returnArray); 
//    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js" ></script>
        <script src="highchart.js"></script>
        <script>
          
 $(function() {
                
$.getJSON('http://reportedly.pnf-sites.info/getData.php&callback=?', function(data) {                
    $('#container').highcharts({
            chart: {
                    type: 'column'
                },
            xAxis:
            {

               type: 'datetime',
               dateTimeLabelFormats: {
                          day: '%e of %b'
                      },
                      pointStart: Date.UTC(2013, 6, 1),
                      pointInterval: (24 * 3600 * 1000 ) + (24 * 3600 * 1000) + (24 * 3600 * 1000) + (24 * 3600 * 1000)

            },
        

            series:
            [
           {
                      name : 'Views',
                      data : data,
                      pointStart: Date.UTC(2013, 6, 1),
                      pointInterval: (24 * 3600 * 1000 ) + (24 * 3600 * 1000) + (24 * 3600 * 1000) + (24 * 3600 * 1000)
              }
            ]
              });
    });
});




//$(function() {
//
//	$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=large-dataset.json&callback=?', function(data) {
//
//		// Create a timer
//		var start = + new Date();
//
//		// Create the chart
//		$('#container').highcharts('StockChart', {
//		    chart: {
//                type: 'column',
//				events: {
//					load: function(chart) {
//						this.setTitle(null, {
//							text: 'Built chart at '+ (new Date() - start) +'ms'
//						});
//					}
//				},
//				zoomType: 'x'
//		    },
//
//		    rangeSelector: {
//		        buttons: [{
//		            type: 'day',
//		            count: 3,
//		            text: '3d'
//		        }, {
//		            type: 'week',
//		            count: 1,
//		            text: '1w'
//		        }, {
//		            type: 'month',
//		            count: 1,
//		            text: '1m'
//		        }, {
//		            type: 'month',
//		            count: 6,
//		            text: '6m'
//		        }, {
//		            type: 'year',
//		            count: 1,
//		            text: '1y'
//		        }, {
//		            type: 'all',
//		            text: 'All'
//		        }],
//		        selected: 1
//		    },
//
//			yAxis: {
//				title: {
//					text: 'Temperature (°C)'
//				}
//			},
//
//		    title: {
//				text: 'Hourly temperatures in Vik i Sogn, Norway, 2004-2010'
//			},
//
//			subtitle: {
//				text: 'Built chart at...' // dummy text to reserve space for dynamic subtitle
//			},
//
//			series: [{
//		        name: 'Temperature',
//		        data: data,
//		        pointStart: Date.UTC(2004, 3, 1),
//		        pointInterval: 3600 * 1000,
//		        tooltip: {
//		        	valueDecimals: 1,
//		        	valueSuffix: '°C'
//		        }
//		    }]
//
//		});
//	});
//});
        </script>
 </head>
    <body>
<!-- HTML -->
<div id="container" style="height: 400px; width: 500px"></div>
    </body>

    </html>
    