<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Agency;

$Agencies = Agency::find()->orderBy(['agency_name' => SORT_ASC])->all();
$SQL = "SELECT `agency_name` AS `name`,`website`, `description`, `membertypeid`,`address`,`geo_location`,`contact`
FROM `tbl_agency` WHERE `membertypeid`=1 GROUP BY `r_id` ORDER BY `r_id`";
$Connection = Yii::$app->db;
$Command = $Connection->createCommand($SQL);
$mAgencies = $Command->queryAll();
?>

<link rel="stylesheet" href="/leaflet/leaflet.css"

      crossorigin=""/>
<script src="/leaflet/leaflet.js"

crossorigin=""></script>

<script type="text/javascript">
    $(document).ready(function() {
        
       // var mymap = L.map('mapid').setView([24.865035, 55.042288], 13);

       //             L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        //                maxZoom: 18,
       //                 attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
       //                         '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
       //                         'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
       //                 id: 'mapbox.streets'
       //             }).addTo(mymap);

                 //   L.marker([24.865035, 55.042288]).bindPopup('Geoscience Testing Laboratory').addTo(mymap);
                 
         
       var interlab = L.layerGroup();
       var nondost = L.layerGroup();
       var dost = L.layerGroup();

                    var interthai = L.marker([13.783021, 100.549303]).bindPopup('Intertek Testing Services (Thailand) Ltd.'),
                    sgsthai    = L.marker([13.705946, 100.543918]).bindPopup('SGS Thailand Limited'),
                    interviet    = L.marker([10.804265, 106.667437]).bindPopup('Intertek Vietnam'),
                    malayan    = L.marker([3.113001, 101.710771]).bindPopup('Malayan Testing Laboratory'),
                    afm    = L.marker([-33.734326, 151.003818]).bindPopup('Australian Food Microbiology'),
                    cordina    = L.marker([-33.801715, 150.943094]).bindPopup('Cordina Farms'),
                    gtl    = L.marker([24.865035, 55.042288]).bindPopup('Geoscience Testing Laboratory'),
                    irri    = L.marker([14.180445, 121.257296]).bindPopup('International Rice Research Institute');
    
                    interlab = L.layerGroup([interthai,sgsthai,interviet,malayan,afm,cordina,gtl,irri]);
                    
                    var sgs = L.marker([14.547376, 121.015105]).bindPopup('SGS'),
                    fastcubao = L.marker([14.623046, 121.062386]).bindPopup('F.A.S.T. Laboratories-Cubao'),
                    pipac = L.marker([14.638871, 121.076784]).bindPopup('PIPAC'),
                    sentrotek = L.marker([14.591846, 121.040637]).bindPopup('Sentrotek'),
                    optimal = L.marker([13.951352, 121.156935]).bindPopup('Optimal Laboratories Inc.'),
                    jefcor = L.marker([13.951365, 121.156969]).bindPopup('Jefcor Laboratories Inc.'),
                    interphil = L.marker([14.533266, 121.022832]).bindPopup('Intertek Philippines'),
                    qualibet = L.marker([14.655494, 121.025840]).bindPopup('Qualibet'),
                    gch = L.marker([10.317810, 123.915467]).bindPopup('GCH Center for Food Safety and Quality, Inc.'),
                    ostrea = L.marker([10.329374, 123.931894]).bindPopup('OSTREA Mineral Laboratories, Inc.'),
                    cedres = L.marker([14.409012, 121.037362]).bindPopup('Center of Excellence in Drug Research, Evaluation and Studies, Inc.'),
                    mach = L.marker([14.442978, 120.996718]).bindPopup('Mach Union Water Laboratory Inc.'),
                    asts = L.marker([6.120174, 125.179945]).bindPopup('Analytical Solutions & Technical Services'),
                    fastcalamba = L.marker([14.155139, 121.137185]).bindPopup('F.A.S.T. Laboratories-Calamba Branch'),
                    sss = L.marker([14.529655, 121.071535]).bindPopup('Scientific Standards Services'),
                    nppc = L.marker([10.674940, 122.955000]).bindPopup('Negros Prawn Producers Cooperative (NPPC)'), 
                    premier = L.marker([14.571457, 121.049803]).bindPopup('Premier Physic Metrologie'),
                    xprt = L.marker([14.556099, 121.001539]).bindPopup('XPRT Analytical Services'),
                    ams = L.marker([10.346112, 123.948221]).bindPopup('Allied Metrology Specialist');
                    
                    nondost = L.layerGroup([sgs,fastcubao,pipac,sentrotek,optimal,jefcor,interphil,qualibet,gch,ostrea,cedres,mach,asts,fastcalamba,sss,nppc,premier,xprt,ams]);
                    
                    var dost1 = L.marker([16.607972, 120.315835]).bindPopup('DOST-I'),
                    dost2 = L.marker([17.652242, 121.752502]).bindPopup('DOST-II'),
                    dost3 = L.marker([15.066352, 120.657300]).bindPopup('DOST-III'),
                    dost4a = L.marker([14.172264, 121.223556]).bindPopup('DOST-IVA-L1'),
                    dost4b = L.marker([9.784145, 118.734071]).bindPopup('DOST-IVB'),
                    dost5 = L.marker([13.167125, 123.751951]).bindPopup('DOST-V'),
                    dost6 = L.marker([10.711773, 122.563898]).bindPopup('DOST-VI'),
                    dost7 = L.marker([10.326021, 123.896707]).bindPopup('DOST-VII'),
                    dost8 = L.marker([11.179108, 125.003762]).bindPopup('DOST-VIII'),
                    dost9 = L.marker([8.578809, 123.339708]).bindPopup('DOST-IX'),
                    dost10 = L.marker([8.482154, 124.627571]).bindPopup('DOST-X'),
                    dost11 = L.marker([7.100831, 125.619313]).bindPopup('DOST-XI'),
                    dost12 = L.marker([7.195893, 124.245030]).bindPopup('DOST-XII-L1'),
                    car = L.marker([16.461068, 120.588391]).bindPopup('DOST-CAR'),
                    caraga = L.marker([8.949169, 125.531068]).bindPopup('DOST-CARAGA'),
                    armm = L.marker([7.197445, 124.247228]).bindPopup('DOST-ARMM'),
                    fnri = L.marker([14.489892, 121.053114]).bindPopup('DOST-FNRI'),
                    fprdi = L.marker([14.156966, 121.235461]).bindPopup('DOST-FPRDI'),
                    itdi = L.marker([14.489730, 121.050719]).bindPopup('DOST-ITDI'),
                    mirdc = L.marker([14.486842, 121.049609]).bindPopup('DOST-MIRDC'),
                    ptri = L.marker([14.487292, 121.047867]).bindPopup('DOST-PTRI'),
                    pnri = L.marker([14.661146, 121.055715]).bindPopup('DOST-PNRI');
                    
                    dost=L.layerGroup([dost1,dost2,dost3,dost4a,dost4b,dost5,dost6,dost7,dost8,dost9,dost10,dost11,dost12,car,caraga,armm,fnri,fprdi,itdi,mirdc,pnri,ptri]);


	var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

	var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', attribution: mbAttr}),
		streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11',   attribution: mbAttr});

	var map = L.map('mapid', {
		center: [10.804265, 106.667437],
		zoom: 1,maxZoom:18,
		layers: [streets, interlab]
	});

	var baseLayers = {
		"Grayscale": grayscale,
		"Streets": streets
	};

	var overlays = {
		"International Laboratories": interlab,
                "Non-DOST Laboratories": nondost,
                "DOST Laboratories": dost
                
	};

     L.control.layers(overlays).addTo(map);
        
        

                

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

        $('#myTab > li').click(function () {
          let data = $(this).data();
          console.log(data.value);
          
//          streetlayer = L.layerGroup()
//           .addLayer(streets)
//           .addTo(map);
          switch(data.value) {
                case 'international':
                      map.eachLayer(function (layer) {
                        if(layer._leaflet_id !== 75)
                        {
                        map.removeLayer(layer);
                        console.log(layer._leaflet_id)
                      
                        }
                    });
              //      var newinter = L.layerGroup([interthai,sgsthai,interviet,malayan,afm,cordina,gtl,irri]);
                  //  L.marker.addTo(newinter);
                   // interlab.addLayer([interthai,sgsthai,interviet,malayan,afm,cordina,gtl,irri]);
                     nondost.clearLayers();
                     dost.clearLayers();
                     interlab.clearLayers();
                      var newCoord = new L.LatLng(3.113001, 101.710771)
                    map.setView(newCoord, 1);
                          
        // Tuileries: 48.864183, 2.326120
        // Champs de Mars: 48.855232, 2.299642
        // Luxembourg: 48.846958, 2.337150
//                    gardensLayerGroup = L.layerGroup()
//               //     gardensLayerGroup = L.layerGroup([interthai,sgsthai,interviet,malayan,afm,cordina,gtl,irri]);
//                    .addLayer(L.marker([ 48.864183, 2.326120 ]))
//                    .addLayer(L.marker([ 48.855232, 2.299642 ]))
//                    .addLayer(L.marker([ 48.846958, 2.337150 ]))
//                    .addTo(map);
                    
                    interlayer = L.layerGroup()
                 
                    .addLayer(L.marker([13.783021, 100.549303]).bindPopup('Intertek Testing Services (Thailand) Ltd.'))
                    .addLayer(L.marker([13.705946, 100.543918]).bindPopup('SGS Thailand Limited'))
                    .addLayer(L.marker([10.804265, 106.667437]).bindPopup('Intertek Vietnam'))
                    .addLayer(L.marker([3.113001, 101.710771]).bindPopup('Malayan Testing Laboratory'))
                    .addLayer(L.marker([-33.734326, 151.003818]).bindPopup('Australian Food Microbiology'))
                    .addLayer(L.marker([-33.801715, 150.943094]).bindPopup('Cordina Farms'))
                    .addLayer(L.marker([24.865035, 55.042288]).bindPopup('Geoscience Testing Laboratory'))
                    .addLayer(L.marker([14.180445, 121.257296]).bindPopup('International Rice Research Institute'))
                    .addTo(map);
            
            
                   
            
                  //  L.marker().addTo(nondost);
                   // var layerGroup = L.layerGroup().addTo(map);

// create markers
                  // L.marker().addTo(interlayer).ad;
               
            
                    break;
                case 'dostlab':
                      map.eachLayer(function (layer) {
                        if(layer._leaflet_id !== 75)
                        {
                        map.removeLayer(layer);
                        console.log(layer._leaflet_id)
                      
                        }
                    });
                    nondost.clearLayers();
                     dost.clearLayers();
                     interlab.clearLayers();
                     var newCoord = new L.LatLng(11.179108, 125.003762)
                    map.setView(newCoord, 6);
                  //  dost.addLayer([dost1,dost2,dost3,dost4a,dost4b,dost5,dost6,dost7,dost8,dost9,dost10,dost11,dost12,car,caraga,armm,fnri,fprdi,itdi,mirdc,pnri,ptri]);
                   // var newdost = L.layerGroup([dost1,dost2,dost3,dost4a,dost4b,dost5,dost6,dost7,dost8,dost9,dost10,dost11,dost12,car,caraga,armm,fnri,fprdi,itdi,mirdc,pnri,ptri]);
                   // L.marker().addTo(newdost);
                    
                    dostlayer = L.layerGroup()
                    .addLayer(L.marker([16.607972, 120.315835]).bindPopup('DOST-I'))
                    .addLayer(L.marker([17.652242, 121.752502]).bindPopup('DOST-II'))
                    .addLayer(L.marker([15.066352, 120.657300]).bindPopup('DOST-III'))
                    .addLayer(L.marker([14.172264, 121.223556]).bindPopup('DOST-IVA-L1'))
                    .addLayer(L.marker([9.784145, 118.734071]).bindPopup('DOST-IVB'))
                    .addLayer(L.marker([13.167125, 123.751951]).bindPopup('DOST-V'))
                    .addLayer(L.marker([10.711773, 122.563898]).bindPopup('DOST-VI'))
                    .addLayer(L.marker([10.326021, 123.896707]).bindPopup('DOST-VII'))
                    .addLayer(L.marker([11.179108, 125.003762]).bindPopup('DOST-VIII'))
                    .addLayer(L.marker([8.578809, 123.339708]).bindPopup('DOST-IX'))
                    .addLayer(L.marker([8.482154, 124.627571]).bindPopup('DOST-X'))
                    .addLayer(L.marker([7.100831, 125.619313]).bindPopup('DOST-XI'))
                    .addLayer(L.marker([7.195893, 124.245030]).bindPopup('DOST-XII-L1'))
                    .addLayer(L.marker([16.461068, 120.588391]).bindPopup('DOST-CAR'))
                    .addLayer(L.marker([8.949169, 125.531068]).bindPopup('DOST-CARAGA'))
                    .addLayer(L.marker([7.197445, 124.247228]).bindPopup('DOST-ARMM'))
                    .addLayer(L.marker([14.489892, 121.053114]).bindPopup('DOST-FNRI'))
                    .addLayer(L.marker([14.156966, 121.235461]).bindPopup('DOST-FPRDI'))
                    .addLayer(L.marker([14.489730, 121.050719]).bindPopup('DOST-ITDI'))
                    .addLayer(L.marker([14.486842, 121.049609]).bindPopup('DOST-MIRDC'))
                    .addLayer(L.marker([14.487292, 121.047867]).bindPopup('DOST-PTRI'))
                    .addLayer(L.marker([14.661146, 121.055715]).bindPopup('DOST-PNRI'))
                    .addTo(map)
            
            
                    
                    
                    
                   // nondost.addLayer([sgs,fastcubao,pipac,sentrotek,optimal,jefcor,interphil,qualibet,gch,ostrea,cedres,mach,asts,fastcalamba,sss,nppc,premier,xprt,ams]);
                   // nondost.clearLayers();
                    break;
                case 'nondost':
                     map.eachLayer(function (layer) {
                        if(layer._leaflet_id !== 75)
                        {
                        map.removeLayer(layer);
                        console.log(layer._leaflet_id)
                      
                        }
                    });
                     nondost.clearLayers();
                     dost.clearLayers();
                     interlab.clearLayers();
                     
                     var newCoord2 = new L.LatLng(10.317810, 123.915467)
                    map.setView(newCoord2, 6);
                   // console.log('10.317810, 123.915467');
//                    interlab.clearLayers();
//                    dost.clearLayers();
//                    newnondost = L.layerGroup([sgs,fastcubao,pipac,sentrotek,optimal,jefcor,interphil,qualibet,gch,ostrea,cedres,mach,asts,fastcalamba,sss,nppc,premier,xprt,ams]);
//                    L.marker().addTo(newnondost);
                   // nondost.addLayer([sgs,fastcubao,pipac,sentrotek,optimal,jefcor,interphil,qualibet,gch,ostrea,cedres,mach,asts,fastcalamba,sss,nppc,premier,xprt,ams]);
                    nondostlayer = L.layerGroup()
                   
                    .addLayer(L.marker([14.547376, 121.015105]).bindPopup('SGS'))
                    .addLayer(L.marker([14.623046, 121.062386]).bindPopup('F.A.S.T. Laboratories-Cubao'))
                    .addLayer(L.marker([14.638871, 121.076784]).bindPopup('PIPAC'))
                    .addLayer(L.marker([14.591846, 121.040637]).bindPopup('Sentrotek'))
                    .addLayer(L.marker([13.951352, 121.156935]).bindPopup('Optimal Laboratories Inc.'))
                    .addLayer(L.marker([13.951365, 121.156969]).bindPopup('Jefcor Laboratories Inc.'))
                    .addLayer(L.marker([14.533266, 121.022832]).bindPopup('Intertek Philippines'))
                    .addLayer(L.marker([14.655494, 121.025840]).bindPopup('Qualibet'))
                    .addLayer(L.marker([10.317810, 123.915467]).bindPopup('GCH Center for Food Safety and Quality, Inc.'))
                    .addLayer(L.marker([10.329374, 123.931894]).bindPopup('OSTREA Mineral Laboratories, Inc.'))
                    .addLayer(L.marker([14.409012, 121.037362]).bindPopup('Center of Excellence in Drug Research, Evaluation and Studies, Inc.'))
                    .addLayer(L.marker([14.442978, 120.996718]).bindPopup('Mach Union Water Laboratory Inc.'))
                    .addLayer(L.marker([6.120174, 125.179945]).bindPopup('Analytical Solutions & Technical Services'))
                    .addLayer(L.marker([14.155139, 121.137185]).bindPopup('F.A.S.T. Laboratories-Calamba Branch'))
                    .addLayer(L.marker([14.529655, 121.071535]).bindPopup('Scientific Standards Services'))
                    .addLayer(L.marker([10.674940, 122.955000]).bindPopup('Negros Prawn Producers Cooperative (NPPC)'))
                    .addLayer(L.marker([14.571457, 121.049803]).bindPopup('Premier Physic Metrologie'))
                    .addLayer(L.marker([14.556099, 121.001539]).bindPopup('XPRT Analytical Services'))
                    .addLayer(L.marker([10.346112, 123.948221]).bindPopup('Allied Metrology Specialist'))
                    .addTo(map);
                    break;
                    
                    
               
              }
          
        });  

        $('body').on('click', function (e) {
            $('[data-toggle=popover]').each(function () {
                // hide any open popovers when the anywhere else in the body is clicked
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });

           });

    </script>
    
    <script type="text/javascript">
        
      
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



<div class="body-content">



   <style type="text/css">
       @import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700);
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
                    width: 70px;
                    height: 70px;
                    line-height: 60px;
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
                   width: 70px;
                   height: 70px;
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
                padding-top: 50px;
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
  
    <div class="row d-flex justify-content-center">
        <div class="row">
            <div class="col-md-8">
                <div id="mapid" class="container-fluid"  style="height: 500px"/>
                <script type="text/javascript">

                    

                </script>
            </div>
        </div>    

            <div class="col-md-4">
          
                    <div class="row">
                      <div id="layercontrol" style="display:none">
                           <label><input type="checkbox" data-layer="nondost">Cities</label>
                      </div>  
                     <div id="mapid" class="container-fluid"  style="height: 500px">  
                        <div class="board">
                            
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
                                    <li data-value="dostlab"><a href="#dostlab" data-toggle="tab" title="DOST Laboratories">
                                            <span class="round-tabs three">
                                                 <div style="text-align: center;"><img src="/images/dost_small.png" class="imageresponsive"/></div>
                                            </span> </a>
                                    </li>

                                    <li data-value="nondost"><a href="#nondostlab" data-toggle="tab" title="Non-DOST Labortories">
                                            <span class="round-tabs four">
                                                 <div style="text-align: center;"><img src="/images/private.png" class="imageresponsive"/></div>
                                            </span> 
                                        </a></li>

                                    <li style="display:none"><a href="#doner" data-toggle="tab" title="completed">
                                            <span class="round-tabs five">
                                                <i class="glyphicon glyphicon-ok"></i>
                                            </span> </a>
                                    </li>

                                </ul>
                            </div>
                             
                            <style type="text/css">
        
/* General Buttons */



a,a:visited,a:hover,a:active{
  -webkit-backface-visibility:hidden;
          backface-visibility:hidden;
	position:relative;
  transition:0.5s color ease;
	text-decoration:none;
	color:#000;
        font-weight: bold;
	font-size:.95em;
}
a:hover{
	color:#066da9;
}
a.before:before,a.after:after{
  content: "";
  transition:0.5s all ease;
  -webkit-backface-visibility:hidden;
          backface-visibility:hidden;
  position:absolute;
}
a.before:before{
  top:-0.25em;
}
a.after:after{
  bottom:-0.25em;
}
a.before:before,a.after:after{
  height:5px;
  height:0.35rem;
  width:0;
  background:#066da9;
}
a.first:after{
  left:0;
}
a.second:after{
  right:0;
}
a.third:after,a.sixth:before,a.sixth:after{
  left:50%;
  -webkit-transform:translateX(-50%);
          transform:translateX(-50%);
}
a.fourth:before,a.fourth:after{
  left:0;
}
a.fifth:before,a.fifth:after{
  right:0;
}
a.seventh:before{
  right:0;
}
a.seventh:after{
  left:0;
}
a.eigth:before{
  left:0;
}
a.eigth:after{
  right:0;
}
a.before:hover:before,a.after:hover:after{
  width:100%;
}


    </style>
    
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="international">
                                     
                                  
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
                                                echo "<a  class='sixth before after' data-toggle='popover' data-placement='top' title='". $Agency->name   ."' data-html='true' data-content='" . $content_div . "'" . PHP_EOL;
                                               // echo   "Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum." ; 
                                               
                                                echo  '>'  . $Agency->agency_name .  '</a><br>' . PHP_EOL;
                                            }
                                        }
                                        ?>
                                            </ul>
                                        </div>
                                    
                                </div>
                                <div class="tab-pane fade" id="dostlab">
                                    
                                   <div id="multiColumnDost" style="margin-left:3%">
                                            <ul>
                                                <?php
                                        foreach ($Agencies as $Agency) {
                                            if ($Agency->membertab == 1) {
                                                                                             
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
                                                echo "<a  class='sixth before after' data-toggle='popover' data-placement='top' title='". $Agency->name   ."' data-html='true' data-content='" . $content_div . "'" . PHP_EOL;
                                               // echo   "Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum." ; 
                                               
                                                echo  '>'  . $Agency->agency_name .  '</a><br>' . PHP_EOL;
                                            }
                                        }
                                        ?>
                                            </ul>
                                        </div>

                                </div>
                                <div class="tab-pane fade" id="nondostlab">
                                    <div id="multiColumnNon" style="margin-left:3%">
                                            <ul>
                                                <?php
                                        foreach ($Agencies as $Agency) {
                                            if ($Agency->membertab == 2) {
                                             
                                                
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
                                                echo "<a  class='sixth before after' data-toggle='popover' data-placement='top' title='". $Agency->name   ."' data-html='true' data-content='" . $content_div . "'" . PHP_EOL;
                                               // echo   "Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum." ; 
                                               
                                                echo  '>'  . $Agency->agency_name .  '</a><br>' . PHP_EOL;
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
                                             //   echo "<li>" . PHP_EOL;
                                             //   echo '<i class="fa fa-angle-double-right" style="color:#066da9;font-size:1em;margin-right: 10px">'  . PHP_EOL;;
                                              //  echo '<div class="" style="display:inline-block;margin:4px;text-align:center;">' . PHP_EOL;
                                             //   echo '<a href="' . $Agency->website . '"' . ' title="' . $Agency->description . ' (' . $Agency->website . ') "' . ' class="hasTooltip" target="_blank">';
                                             //   echo '<label>' . $Agency->agency_name . '</label>' . PHP_EOL;
                                             //   echo '<span>' . $Agency->description . ' (' . $Agency->website . ')' . ' </span>' . PHP_EOL;
                                             //   echo '</a></div>' . PHP_EOL;
                                             //   echo "</li>" . PHP_EOL;
                                                
                                             //   $content_li = '<li>' . '<a href="'.  $ $Agency->code . '">'  . '<label>' . $Agency->code . '</label>' . '</a></li>';
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

                        </div>
                    </div> </div>
             
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




