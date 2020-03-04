<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Agency;

$this->title = 'OneLab Network';

$Agencies = Agency::find()->orderBy(['agency_name' => SORT_ASC])->all();
$AgenciesDost = Agency::find()->orderBy(['region_id' => SORT_ASC])->all();
$SQL = "SELECT `agency_name` AS `name`,`website`, `description`, `membertypeid`,`address`,`geo_location`,`contact`
FROM `tbl_agency` WHERE `membertypeid`=1 GROUP BY `r_id` ORDER BY `r_id`";
$Connection = Yii::$app->db;
$Command = $Connection->createCommand($SQL);
$mAgencies = $Command->queryAll();


$sql = "Select * from tbl_article_items";
$cmd = $Connection->createCommand($SQL);  
$queryArticles = $cmd->queryAll();

$ArticlesList = app\models\ArticleItems::find()->all();

//$testjson = \yii\helpers\Json::encode($bicycleRental); 
//$testjson = \yii\helpers\Json::encode($geojsonDost); 
//echo $testjson;
?>
<a href="../../models/Agency.php"></a>

<link rel="stylesheet" href="/leaflet/leaflet.css"

      crossorigin=""/>
<script src="/leaflet/leaflet.js"

crossorigin=""></script>

<script type="text/javascript">
    $(document).ready(function() {
        
       loadswap('divaustralianfoodmicro');
      var loko={"type":"FeatureCollection","features":[{"geometry":{"type":"Point","coordinates":[-104.9998241,39.7471494]},"type":"Feature","properties":{"popupContent":"This is a B-Cycle Station. Come pick up a bike and pay by the hour. What a deal!"},"id":51},{"geometry":{"type":"Point","coordinates":[-104.9983545,39.7502833]},"type":"Feature","properties":{"popupContent":"This is a B-Cycle Station. Come pick up a bike and pay by the hour. What a deal!"},"id":52}]};
       
      



// var baseballIcon = L.icon({
// 		iconUrl: 'baseball-marker.png',
// 		iconSize: [32, 37],
// 		iconAnchor: [16, 37],
// 		popupAnchor: [0, -28]
// 	});


	// var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
	// 		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
	// 		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	// 	mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

	// var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', attribution: mbAttr}),
	// 	streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11',   attribution: mbAttr});

	// var map = L.map('mapid', {
	// 	center: [10.804265, 106.667437],
	// 	zoom: 1,maxZoom:18,
	// 	// layers: [streets, interlab]
    // });
    // var map = L.map('mapid').setView([39.74739, -105], 13);

    var map = L.map('mapid').setView([13.783021, 100.549303], 2);

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		zoom: 1,maxZoom:18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	}).addTo(map);

	// var baseballIcon = L.icon({
	// 	iconUrl: 'baseball-marker.png',
	// 	iconSize: [32, 37],
	// 	iconAnchor: [16, 37],
	// 	popupAnchor: [0, -28]
	// });

	function onEachFeature(feature, layer) {
		var popupContent = feature.geometry.type;

		if (feature.properties && feature.properties.popupContent) {
			popupContent = feature.properties.popupContent;
		}

		layer.bindPopup(popupContent);
    }
    
    // geojsonLayer = L.geoJson(<?php echo \yii\helpers\Json::encode($geojsonInter) ?>, {
    //         style: defaultStyle,
    //         onEachFeature: onEachFeature
    //     });
    //     geojsonLayer.addTo(map);

    geojsonLayerDost = L.geoJSON([<?php echo \yii\helpers\Json::encode($geojsonDost) ?>], {
                        style: function (feature) {
                            return feature.properties && feature.properties.style;
                        },

                        onEachFeature: onEachFeature
                        });
    geojsonLayerNonDost = L.geoJSON([<?php echo \yii\helpers\Json::encode($geojsonNonDost) ?>], {
                        style: function (feature) {
                            return feature.properties && feature.properties.style;
                        },

                        onEachFeature: onEachFeature
                        });

        geojsonLayerInter = L.geoJSON([<?php echo \yii\helpers\Json::encode($geojsonInter) ?>], {

		style: function (feature) {
			return feature.properties && feature.properties.style;
		},

		onEachFeature: onEachFeature

		
    })
    geojsonLayerInter.addTo(map);

    // var BorIconHere = L.Icon.extend(
    // {
    //     options: {
    //         iconUrl: 'https://upload.wikimedia.org/wikipedia/commons/e/e9/6_df.png',
    //         iconSize: [17, 30]
    //     }
    // });
    // var ShigiIconHere = L.Icon.extend({
    // options: {
    //     iconUrl: 'https://upload.wikimedia.org/wikipedia/commons/f/f5/4_lmb.png',
    //     iconSize: [17, 30]
    // }
    // })

    // function showResourcesByName(resName, resIcon) {
    
    // L.marker([14.180445, 121.257296], {icon: new BorIconHere}).addTo(map).bindPopup("name");
    // }

    //.addTo(map);
 
        $('div#layercontrol input[type="checkbox"]').on('change', function() {    
            var checkbox = $(this);
         //   var layer = checkbox.data().layer; 

            // toggle the layer
           // if (checkbox).prop('checked') 
            if(checkbox.is(':checked'))
            {
           //   map.removeLayer(layer);
              
              interlab.clearLayers();
              nondost.addLayer([sgs,fastcubao,pipac,sentrotek,optimal,jefcor,interphil,qualibet,gch,ostrea,cedres,mach,asts,fastcalamba,sss,nppc,premier,xprt,ams]);
             //  map.addLayer(layer);
             //  
          // alert(checkbox.data().layer);
            } else {
            //   map.removeLayer(layer);
            //   alert('unchecked');
          //  alert(checkbox.data().layer);
            }
    });

    
// showResourcesByName("AIBorServer", BorIconHere);
// showResourcesByName("AIShigiServer", ShigiIconHere);
    
     $(function () {
                $('[data-toggle="popover"]').popover()
                })

                $('body').popover({
                                selector: '[rel=popover]',
                                trigger: "click"
                            }).on("show.bs.popover", function(e){
                                // hide all other popovers
                                $("[rel=popover]").not(e.target).popover("destroy");
                                $(".popover").remove();                    
                            });

        $('#myTab > li').click(function () 
        {
          let data = $(this).data();
          //console.log(data.value);
          
//          streetlayer = L.layerGroup()
//           .addLayer(streets)
//           .addTo(map);
          switch(data.value) {

                case 'international':

                    map.removeLayer(geojsonLayerDost);       
                    map.removeLayer(geojsonLayerNonDost);               
                    //var map = L.map('mapid').setView([], 2);
                    map.setView(new L.LatLng(16.607972,120.315835),2);
                   
                    function onEachFeature(feature, layer) {
                    var popupContent = feature.geometry.type;

                    if (feature.properties && feature.properties.popupContent) {
                        popupContent = feature.properties.popupContent;
                    }

                    layer.bindPopup(popupContent);
                }
                     geojsonLayerInter.addTo(map);
                                     break;

                case 'dostlab':

                    map.removeLayer(geojsonLayerInter);       
                    map.removeLayer(geojsonLayerNonDost);                   
                    //var map = L.map('mapid').setView([], 2);
                    map.setView(new L.LatLng(13.167125, 123.751951),6);
                   
                    function onEachFeature(feature, layer) {
                    var popupContent = feature.geometry.type;

                    if (feature.properties && feature.properties.popupContent) {
                        popupContent = feature.properties.popupContent;
                    }

                    layer.bindPopup(popupContent);
                }

              
               
                     geojsonLayerDost.addTo(map);
                     loadswap('divr4al1');
                    
                    
                 
                    break;
                case 'nondost':

                    map.removeLayer(geojsonLayerDost);       
                    map.removeLayer(geojsonLayerInter);                
                    //var map = L.map('mapid').setView([], 2);
                    map.setView(new L.LatLng(10.674940, 122.955000),6);
                   
                    function onEachFeature(feature, layer) {
                    var popupContent = feature.geometry.type;

                    if (feature.properties && feature.properties.popupContent) {
                        popupContent = feature.properties.popupContent;
                    }

                    layer.bindPopup(popupContent);
                }

                
                     geojsonLayerNonDost.addTo(map);
            
                    loadswap('divams');
                    break;
                    
                    
               
              }
          
        });  
        
        
        marker.on('click', function(e){
            map.setView(e.latlng, 13);
        });

        $('body').on('click', function (e) {
            $('[data-toggle=popover]').each(function () {
                // hide any open popovers when the anywhere else in the body is clicked
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });
        
            $(".box").click(function(){
               $('.output').append('box clicked!');
                // applies A
            });

            $(".box > a").click(function(e){
                e.stopPropagation();
                $('.output').append('anchor clicked!'); 
                // goal:applies B without applying A
            });
            
            $("#btnMap").click(function(){
            //    e.stopPropagation();
              //  alert('Clicked Button');
                 let data = $(this).data();
                //alert(data.value);
                // goal:applies B without applying A
           //   map.flyTo([13.783021, 100.549303], 18);
           //     alert(data.value);
                
             //   var layer = polygonsGroup.getLayers()[0];
              
          //      map.panTo([13.783021, 100.549303],18);
//                layer.setStyle({
//                    color: "#FFFF00",
//                    fillColor: "#FFFF7F"
//                });\
                
                map.setView([13.783021, 100.549303], 18);
                
            });
            
           
        

         


           });

    </script>
    
    <script type="text/javascript">
        function loadswap(obj)
         {
           //   let datatest = $(this).data();
           //  console.log($(this).data().layer);
        //      console.log(obj);
            $('#divswap').html('');
          //  $('#divswap').css('display')!='none';
             var tmpDiv = '.' + obj;
             var strTmp =  $(tmpDiv).html(); //$(tmpDiv).html;
          //   console.log(strTmp);
         //   $('#divswap').replaceWith($(tmpDiv).html()); 
         $('#divswap').html(strTmp);
         //    $(tmpDiv).attr("id", "divswap");
             
         };
         
         
         function changeIcon()
           {
                L.marker([13.783021, 100.549303], {icon: greenIcon}).addTo(map);
           }
         
        
         
         
         
        
      
    </script>
<style>


    .link-display {
        display: block;
        position: relative;
    }
    a {
        color: #000;
    }

    .div_ex
    {
        box-shadow: none;
        transition: .5s ease;
        background: transparent;
    }
    .div_ex:hover
    {

        box-shadow: 0 0 0 3px #3c8dbc;
        transition: .5s ease;


    }


    .hasTooltip {
        position:relative;
    }
    .hasTooltip span {
        display:none;
    }

    .hasTooltip:hover{
        color: #BEBEBE;
    }

    .hasTooltip:hover span {
        display:block;
        background-color:#3c8dbc;
        border-radius:5px;
        color:#fff;
        border:1px solid #bebebe;
        position:absolute;
        padding:5px;
        top:1.3em;
        left:0px;

        width:300px;
        z-index: 1000;
        /* I don't want the width to be too large... */
    }

    .map-responsive{

        padding-bottom:56.25%;
        position:relative;
        height:0;

    }
    .map-responsive iframe{
        left:0;

        height:100%;
        width:100%;
        position:absolute;
    }

    body {
        font-family: 'Open Sans', arial, sans-serif;
        background: 
            rgb(138, 184, 211);
    }


    .tab-content > .tab-pane {

        min-height: 100%;
        max-height: 100%;
        min-width: 100%;
        max-width: 100%;
    }

</style>

<style type="text/css">
      
/* written by riliwan balogun http://www.facebook.com/riliwan.rabo*/
                .board{
                width: 75%;
                margin: 20px auto;
                height: auto;
                background: #fff;
                margin-top:1px;
                /*box-shadow: 10px 10px #ccc,-10px 20px #ddd;*/
                }
                .board .nav-tabs {
                    position: relative;


                    margin: 40px auto;
                    margin-bottom: 0;
                    box-sizing: border-box;

                }

                .board > div.board-inner{
                    background: #fafafa ;
                    background-size: 30%;
                }

                p.narrow{
                    width: 80%;
                    margin: 10px auto;
                }

                .liner{
                    height: 2px;
                    background: #ddd;
                    position: absolute;
                    width: 80%;
                    margin: 0 auto;
                    left: 0;
                    right: 0;
                    top: 50%;
                    z-index: 1;
                }

                .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
                    color: #555555;
                    cursor: default;
                    /* background-color: #ffffff; */
                    border: 0;
                    border-bottom-color: transparent;
                }

                span.round-tabs{
                    width: 50px;
                    height: 50px;
                    line-height: 45px;
                    display: inline-block;
                    border-radius: 100px;
                    background: white;
                    z-index: 2;
                    position: absolute;
                    left: 0;
                    text-align: center;
                    font-size: 25px;
                }

                span.round-tabs.one{
                    color: rgb(34, 194, 34);border: 2px solid #0B7CBE;
                }

                li.active span.round-tabs.one{
                    background: #fff !important;
                    border: 2px solid #ddd;
                    color: rgb(34, 194, 34);
                }

                span.round-tabs.two{
                    color: #febe29;border: 2px solid #0B7CBE;
                }

                li.active span.round-tabs.two{
                    background: #fff !important;
                    border: 2px solid #ddd;
                    color: #febe29;
                }

                span.round-tabs.three{
                    color: #3e5e9a;border: 2px solid #0B7CBE;
                }

                li.active span.round-tabs.three{
                    background: #fff !important;
                    border: 2px solid #ddd;
                    color: #3e5e9a;
                }

                span.round-tabs.four{
                    color: #f1685e;border: 2px solid #0B7CBE;
                }

                li.active span.round-tabs.four{
                    background: #fff !important;
                    border: 2px solid #ddd;
                    color: #f1685e;
                }

                span.round-tabs.five{
                    color: #999;border: 2px solid #0B7CBE;
                }

                li.active span.round-tabs.five{
                    background: #fff !important;
                    border: 2px solid #ddd;
                    color: #999;
                }

                .nav-tabs > li.active > a span.round-tabs{
                    background: #fafafa;
                }
                .nav-tabs > li {
                    width: 20%;

                }
                /*li.active:before {
                    content: " ";
                    position: absolute;
                    left: 45%;
                    opacity:0;
                    margin: 0 auto;
                    bottom: -2px;
                    border: 10px solid transparent;
                    border-bottom-color: #fff;
                    z-index: 1;
                    transition:0.2s ease-in-out;
                }*/
                li:after {
                    content: " ";
                    position: absolute;
                    left: 45%;
                   opacity:0;
                    margin: 0 auto;
                    bottom: 0px;
                    border: 5px solid transparent;
                    border-bottom-color: #ddd;
                    transition:0.1s ease-in-out;

                }
                li.active:after {
                    content: " ";
                    position: absolute;
                    left: 45%;
                   opacity:1;
                    margin: 0 auto;
                    bottom: 0px;
                    border: 10px solid transparent;
                    border-bottom-color: #ddd;

                }
                .nav-tabs > li a{
                   width: 50px;
                   height: 50px;
                   margin: 20px auto;
                   border-radius: 100%;
                   padding: 0;
                   border: none;
                }



                .nav-tabs > li a:hover{
                    background: transparent;
                }

                .tab-content{
                }
                .tab-pane{
                   position: relative;
                padding-top: 0px;;
                }
                .tab-content .head{
                    font-family: 'Roboto Condensed', sans-serif;
                    font-size: 25px;
                    text-transform: uppercase;
                    padding-bottom: 10px;
                }
                .btn-outline-rounded{
                    padding: 10px 40px;
                    margin: 20px 0;
                    border: 2px solid transparent;
                    border-radius: 25px;
                }

                .btn.green{
                    background-color:#5cb85c;
                    /*border: 2px solid #5cb85c;*/
                    color: #ffffff;
                }





                @media( max-width : 585px ){

                    .board {
                width: 90%;
                height:auto !important;
                }
                    span.round-tabs {
                font-size:16px;
                width: 50px;
                height: 50px;
                line-height: 45px;
                    }
                    .tab-content .head{
                        font-size:20px;
                        }
                .nav-tabs > li a {
                width: 50px;
                height: 50px;
                line-height:50px;
                }

                li.active:after {
                content: " ";
                position: absolute;
                left: 35%;
                }

                .btn-outline-rounded {
                    padding:12px 20px;
                    }
                }

                        #mapid { 
                            height: 50vw; 
                            width: 100%;
                        }

                .nav-center {  
                  text-align: center;
                  ul.nav {
                    display: inline-block;
                    li {
                      display: inline
                      a {
                        float: left
                      }
                    }
                  }
                }

                .imgs {
                width: 100%;
                list-style: none;
                margin: auto;
                    padding:0px;
                }
                .imgs li {
                width: 24.4%;
                margin: 0px !important;
                padding: 0px !important;
                display: inline-block;
                    float: left;
                }

                div#multiColumnInter {
                    -moz-column-count: 1;
                    -moz-column-gap: 20px;
                    -webkit-column-count: 1;
                    -webkit-column-gap: 20px;
                    column-count: 1;
                    column-gap: 20px;

                }

                div#multiColumnDost {
                    -moz-column-count: 3;
                    -moz-column-gap: 20px;
                    -webkit-column-count: 3;
                    -webkit-column-gap: 20px;
                    column-count: 3;
                    column-gap: 20px;

                }

                div#multiColumnNon {
                    -moz-column-count: 2;
                    -moz-column-gap: 20px;
                    -webkit-column-count: 2;
                    -webkit-column-gap: 20px;
                    column-count: 2;
                    column-gap: 20px;

                }
    </style>

<style type="text/css">
.abrackets {
  color: #000;
  font-size:.95em;
  font-weight:bold;
  -webkit-transition: color 0.2s;
  transition: color 0.2s;
  transition: transform 0.2s;
  display: inline-block;
  text-decoration: none;
  position: relative;
 
}

.abrackets:hover {
  color: #066da9;
    text-decoration: underline; 
}

.abrackets::before,
.abrackets::after {
  position: relative;
  top: 0;
  font-weight: 100;
  font-size: 150%;
  line-height: 1;
  opacity: 0;
  -webkit-transition: opacity 0.2s, -webkit-transform 0.2s;
  transition: opacity 0.2s, transform 0.2s;
}

.abrackets::before {
  left: -0.1em;
  content: '[';
  font-weight:bold;
  height:100%;
  -webkit-transform: translateX(-100%);
  transform: translateX(-100%);
}

.abrackets::after {
  right: -0.1em;
  content: ']';
  font-weight:bold;
  -webkit-transform: translateX(100%);
  transform: translateX(100%);
}

.abrackets:hover::before,
.abrackets:hover::after {
  opacity: 1;
  -webkit-transform: translateX(0);
  transform: translateX(0);

 
}
</style>    



<div class="body-content" style="background-color: #ecf0f5">



   
  
    <div class="row d-flex justify-content-center">
        <div class="row">
            <div class="col-md-6">
                <div id="mapid" class="container-fluid"  style="height: 600px;margin:10px"/>
                <script type="text/javascript">

                    

                </script>
            </div>
        </div>    

        <div class="col-md-6">
          
                    <div class="row">
                      <div id="layercontrol" style="display:none">
                           <label style="display:none"><input type="checkbox" data-layer="nondost">Cities</label>
                           <a value="Swap" id="btnswap" onclick="loadswap('divgtl')" data-layer="divgtl" onclick="" href="#"> Swap</a>
                      </div>  
                      
                     <div id="mapid" class="container-fluid"  style="height: 90%;margin-bottom:10px">  
                        <div class="container-fluid">
                             
                           
                            <div class="board-inner">
                               
                                    <ul class="nav nav-tabs justify-content-center" id="myTab">
                                    <div class="liners"></div>
                                    <li class="active" data-value="international">
                                        <a href="#international" data-toggle="tab" title="International Laboratories">
                                            <span class="round-tabs one">
                                            <div style="text-align: center;"><img src="/images/globe_icon.png" class="imageresponsive"/></div>
                                            
                                            </span> 
                                        </a></li>

                                    <li style="display:none"><a href="#profile" data-toggle="tab" title="profile">
                                            <span class="round-tabs two">
                                                <i class="glyphicon glyphicon-user"></i>
                                            </span> 
                                        </a>
                                    </li>
                                    <li data-value="nondost"><a href="#nondostlab" data-toggle="tab" title="Non-DOST Laboratories">
                                            <span class="round-tabs four">
                                                 <div style="text-align: center;"><img src="/images/private.png" class="imageresponsive"/></div>
                                            </span> 
                                        </a></li>
                                    <li data-value="dostlab"><a href="#dostlab" data-toggle="tab" title="DOST Laboratories">
                                            <span class="round-tabs three">
                                                 <div style="text-align: center;"><img src="/images/dost_small.png" class="imageresponsive"/></div>
                                            </span> </a>
                                    </li>

                                   

                                    <li style="display:none"><a href="#doner" data-toggle="tab" title="completed">
                                            <span class="round-tabs five">
                                                <i class="glyphicon glyphicon-ok"></i>
                                            </span> </a>
                                    </li>

                                </ul>
                            </div>
                             



    
                            <div class="tab-content">
                               
                                    <div class="tab-pane fade in active" id="international">
                                        
                                    <h4>International Laboratories</h4>
                                        <div id="multiColumnInter" style="margin-left:3%">
                                            
                                                <ul>
                                                    <?php
                                            foreach ($Agencies as $Agency) {
                                                if ($Agency->membertab == 3) {
                                                //   echo "<li>" . PHP_EOL;
                                                //    echo '<div style="display:inline-block;margin:4px;text-align:center;">' . PHP_EOL;
                                                //    echo '<a class="sixth before after" href="' . $Agency->website . '"' . ' title="' . $Agency->description . ' (' . $Agency->website . ') "' . ' class="hasTooltip" target="_blank">';
                                                //    echo '<label>' . $Agency->agency_name . '</label>' . PHP_EOL;
                                                //     echo '</a></div>' . PHP_EOL;
                                                //    echo "</li>" . PHP_EOL;
                                                    //onclick="loadswap('a')"
                                                            
                                                    $content_li='<li><a  href="' . $Agency->website . '">' . $Agency->website . '</a></li>';
                                                    $content_li = $content_li .'<li>' . $Agency->address . '</li>';
                                                    $content_li = $content_li . '<li><a  href="#" onclick="plotmap();">' . $Agency->geo_location  .'</a></li>';
                                                    $content_div = '<div class="container-fluid picture">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                            <img src="/images/members/' . strtolower($Agency->code)  . '.png" class="img-responsive"/>
                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="col-sm-12" style="color:#000;font-size:small"><ul>' . $content_li .'</ul></div></div></div></div>';
                                                    
                                                
                                                // $content_div = $content_div . $content_ul;
                                                    echo "<a  class='abrackets' data-placement='top' title='". $Agency->name   ."' data-html='true'"  . PHP_EOL;
                                                // echo   "Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum." ; 
                                                
                                                    echo  " onclick=loadswap('div". strtolower($Agency->code)  . "')>"  . $Agency->name .  "</a><br>" . PHP_EOL;
                                                }
                                            }
                                            ?>
                                                </ul>
                                            </div>
                                        
                                    </div>

                                    <div class="tab-pane fade" id="dostlab">
                                        <h4>DOST Laboratories</h4>
                                    <div id="multiColumnDost" style="margin-left:3%">
                                   
                                        <ul>
                                                    <?php
                                            foreach ($AgenciesDost as $Agency) {
                                                if ($Agency->membertab == 1 ) {
                                                                                                
                                                    $content_li='<li><a  href="' . $Agency->website . '">' . $Agency->website . '</a></li>';
                                                    $content_li = $content_li .'<li>' . $Agency->address . '</li>';
                                                    $content_li = $content_li . '<li><a  href="#" onclick="plotmap();">' . $Agency->geo_location  .'</a></li>';
                                                    $content_div = '<div class="container-fluid picture">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                            <img src="/images/members/' . strtolower($Agency->code)  . '.png" class="img-responsive"/>
                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="col-sm-12" style="color:#000;font-size:small"><ul>' . $content_li .'</ul></div></div></div></div>';
                                                    
                                                
                                                // $content_div = $content_div . $content_ul;
                                                    echo "<a  class='abrackets' data-placement='top' title='". $Agency->name   ."' data-html='true'"  . PHP_EOL;
                                                // echo   "Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum." ; 
                                                
                                                    echo  " onclick=loadswap('div". strtolower($Agency->code)  . "')>"  . $Agency->name .  "</a><br>" . PHP_EOL;
                                                }
                                            }
                                            ?>
                                                </ul>
                                            </div>

                                    </div>
                                   
                                    <div class="tab-pane fade" id="nondostlab">
                                        <h4>Non-DOST Laboratories</h4>
                                        <div id="multiColumnNon" style="margin-left:3%">
                                            
                                        
                                                <ul>
                                                    <?php
                                            foreach ($Agencies as $Agency) {
                                                if ($Agency->membertab == 2 || $Agency->membertab == 4) {
                                                
                                                    
                                                    $content_li='<li><a  href="' . $Agency->website . '">' . $Agency->website . '</a></li>';
                                                    $content_li = $content_li .'<li>' . $Agency->address . '</li>';
                                                    $content_li = $content_li . '<li><a  href="#" onclick="plotmap();">' . $Agency->geo_location  .'</a></li>';
                                                    $content_div = '<div class="container-fluid picture">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                            <img src="/images/members/' . strtolower($Agency->code)  . '.png" class="img-responsive"/>
                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="col-sm-12" style="color:#000;font-size:small"><ul>' . $content_li .'</ul></div></div></div></div>';
                                                    
                                                
                                                // $content_div = $content_div . $content_ul;
                                                    echo "<a  class='abrackets' data-placement='top' title='". $Agency->name   ."' data-html='true'"  . PHP_EOL;
                                                // echo   "Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum." ; 
                                                
                                                    echo  " onclick=loadswap('div". strtolower($Agency->code)  . "')>"  . $Agency->name .  "</a><br>" . PHP_EOL;
                                                }
                                            }
                                            ?>
                                                </ul>
                                            </div>
                                    </div>

                                    <div class="tab-pane fade" id="doner">
                                        
        
                                        <div id="multiColumnNon" style="margin-left:3%">
                                                <ul>
                                                    <?php
                                            foreach ($Agencies as $Agency) {
                                                if ($Agency->membertab == 2) {
                                                
                                                    $content_li='<li><a  href="' . $Agency->website . '">TEST</a></li>';
                                                    $content_div = '<div class="container-fluid picture">
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                            <img src="/images/members/' . strtolower($Agency->code)  . '.png" class="img-responsive"/>
                                                            </div>
                                                            <div class="col-sm-7" style="color:#000;font-size:small"><ul>' . $content_li .'</ul></div></div></div>';
                                                    
                                                
                                                // $content_div = $content_div . $content_ul;
                                                    echo "<a  class='sixth before after' data-toggle='popover' data-placement='top' title='". $Agency->name   ."' data-html='true' data-content='" . $content_div . "'" . PHP_EOL;
                                                // echo   "Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum." ; 
                                                
                                                    echo  '>'  . $Agency->agency_name .  '</a><br>' . PHP_EOL;
                                                
                                                }
                                            }
                                            ?>
                                                </ul>
                                            </div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                              
                            </div>
                            <div class="row" style="border-left: #066da9 3px solid;border-right: #066da9 3px solid;border-radius: 5px;margin-right: 15px;margin-left: 10px;margin-top:10px;box-shadow: 0 1px 3px #000">
                                <div class="container-fluid" style="margin:1%;">
                                    <div class="container-fluid picture">
                                        <div id="divswap" >
                                           
                                        </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                       
                    </div> 
        </div>
                
                   
             
    </div>
</div>


<div class="row d-flex justify-content-center">

        <!--Grid column-->
       
        <!--Grid column-->

</div>



    <div class="text-center">


    </div>






    <!--Modal: Name-->
    <div class="modal fade" id="modalRSTL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

            <!--Content-->
            <div class="modal-content">

                <!--Body-->
                <div class="modal-body mb-0 p-0">

                    <!--Google map-->
                    <div id="map-container-google-18" class="container-fluid"  style="height: 400px">
                        <iframe src="https://www.google.com/maps/d/embed?mid=1MhTnQFk9wU2ntZfvyEDuOiHyyHeZYdiq&hl=en"
                                frameborder="0" style="border:0;height:100%;width:100%" allowfullscreen></iframe>
                    </div>

                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">

                    <button type="button" class="btn btn-secondary btn-md">Save location <i class="fas fa-map-marker-alt ml-1"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-md" data-dismiss="modal">Close <i class="fas fa-times ml-1"></i></button>

                </div>

            </div>
            <!--/.Content-->

        </div>
    </div>
    <!--Modal: Name-->

    <!--Modal: Name-->
    <div class="modal fade" id="modalRDI" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

            <!--Content-->
            <div class="modal-content">

                <!--Body-->
                <div class="modal-body mb-0 p-0">

                    <!--Google map-->
                    <div id="map-container-google-18" class="container-fluid"  style="height: 400px">
                        <iframe src="https://www.google.com/maps/d/embed?mid=1oBqtxy0a8YIsG9532gEThQWDfkbHE0Ny&hl=en"
                                frameborder="0" style="border:0;height:100%;width:100%" allowfullscreen></iframe>
                    </div>

                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">

                    <button type="button" class="btn btn-secondary btn-md">Save location <i class="fas fa-map-marker-alt ml-1"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-md" data-dismiss="modal">Close <i class="fas fa-times ml-1"></i></button>

                </div>

            </div>
            <!--/.Content-->

        </div>
    </div>
    <!--Modal: Name-->

    <!--Modal: Name-->
    <div class="modal fade" id="modalPrivate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

            <!--Content-->
            <div class="modal-content">

                <!--Body-->
                <div class="modal-body mb-0 p-0">

                    <!--Google map-->
                    <div id="map-container-google-18" class="container-fluid"  style="height: 400px">
                        <iframe src="https://www.google.com/maps/d/embed?mid=1PHhscR1ZDKxG4aH9KJj6iVQZjLSCe7lb&hl=en"
                                frameborder="0" style="border:0;height:100%;width:100%" allowfullscreen></iframe>
                    </div>

                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">

                    <button type="button" class="btn btn-secondary btn-md">Save location <i class="fas fa-map-marker-alt ml-1"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-md" data-dismiss="modal">Close <i class="fas fa-times ml-1"></i></button>

                </div>

            </div>
            <!--/.Content-->

        </div>
    </div>
    <!--Modal: Name-->


</div>


<div style="display: none">
    
     
     <?php
        foreach ($Agencies as $Agency) 
        {
         //  if ($Agency->membertab == 3) 
          //  {
            $fulldiv = '<div class="div' . strtolower($Agency->code)  . '">
                <div class="row">
                            <div class="col-sm-4 col-xs-4">
                                <img src="/images/members/' . strtolower($Agency->code)  . '.png" class="img-responsive"/>'
                        .  '</div>'
                        .  '<div class="col-sm-18" style="color:#000;font-size:small">'
                            . '<ul>'
                                . '<li><a target="_blank"  href="' . $Agency->website . '">' . $Agency->website . '</a></li>'
                                . '<li>' . $Agency->address . '</li>'
                                . '<li>' . $Agency->contact . '</li>'
                             //   . '<li><input type="button  href="#" onclick="plotmap();">' . $Agency->geo_location  .'</a></li>'
                            //      . '<li><input id="btnMap" click="changeIcon()" data-value="13.783021,100.549303" type="button" value="View on Map">' . '</li>'
                            . '<ul>'
                         . '</div>'
                    . '</div></div>';
            
            echo $fulldiv;
                
          //  }
        }
        ?>
</div>
<style>



.anew {
  background:
     linear-gradient(
       to right,
       var(--mainColor) 0%,
       var(--mainColor) 5px,
       transparent 5px
     );
    background-repeat: repeat-x;
    background-size: 100%;
  color: #000;
  padding-left: 10px;
  text-decoration: none;
}

.anew:hover {
  background:
     linear-gradient(
       to right,
       #ff9800 10%,
       #ff9800 5px,
       transparent
     );
}

.an {
  display: inline-block;
  padding-left:20px;
  transition: .3s;
  font-weight:bold;
  text-decoration:none;
}
.an:hover {
  -webkit-transform: scale(1.2);
  transform: scale(1.2);
}

.button-effect {
      padding: 30px 0px; 
      margin-right: 17px;
      background-color: #F28123;
}

.effect {
  text-align: center;
  display: inline-block;
  position: relative;
  text-decoration: none;
  color:red;
  text-transform: capitalize;
  /* background-color: - add your own background-color */
  
  font-family: 'Roboto', sans-serif; /* put your font-family */
  size: 18px;

  padding: 20px 0px;
  width: 150px;
  border-radius: 6px;
  overflow: hidden;
}

.effect.effect-5 {
  transition: all 0.2s linear 0s;
}
.effect.effect-5:before {
    content: ">>";
    font-family: FontAwesome;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 0;
    left: 0px;
    height: 100%;
    width: 30px;
    background-color: rgba(#fff,0.3);
    border-radius: 0 50% 50% 0;
    transform: scale(0,1);
    transform-origin: left center;
    transition: all 0.2s linear 0s;
  }
  
.effect.effect-5:hover {
    text-indent: 30px;
}
    
.effect.effect-5:before {
      transform: scale(1,1);
      text-indent: 0;
    
  }

</style>
<!-- <div class="button-effect">
    <a class="effect effect-5" href="#"> Test Me</a>
</div> -->

<div class='output'></div>





