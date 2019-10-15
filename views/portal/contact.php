<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Contact Us';
?>
 <style>
      #map {
        height: 300px;
        width: 100%;
       }
    .onelab-content
    {
        max-height: 500px;

    }

    .link-display {
        display: block;
        position: relative;
    }
    a {
        color: #000;
    }
    </style>
    <div class="site-about">
        <div class="content-items">
            <div class="note-box rounded" style=''>
                <div title="Important Notes" class="info-tab note-icon">&nbsp;</div>
                <h3 class="alert alert-info">Contact Us</h3>
                <div class="row">
                    <div class="col-lg-4 col-xs-10" style="margin-left: 20px"><strong>
                             <div id="div_about" style="border-radius: 20px">
                                <a href="mailto:support@onelab.ph" target="_blank" >
                                <i style="color:#00c0ef;text-shadow: 1px 1px 1px #ccc;font-size: 1.5em;" class="fa fa-map-marker"></i></a>
                                   <span class="contact-details">DOST Building, Gen. Santos Avenue Bicutan, Taguig City Metro Manila</span>
                            </div><br>
                            <!-- small box -->
                            <div id="div_about" style="border-radius: 20px">
                                <a href="https://www.facebook.com/DOST-OneLab-1625160847800347/?ref=br_rs" target="_blank" >
                                    <i style="color:#00c0ef;text-shadow: 1px 1px 1px #ccc;font-size: 1.5em;" class="fa fa-facebook-square"></i></a>
                                    <span class="contact-details">DOST OneLab</span>
                            </div><br>
                            <div id="div_about" style="border-radius: 20px">
                                <i style="color:#00c0ef;text-shadow: 1px 1px 1px #ccc;font-size: 1.5em;" class="fa fa-phone"></i>
                                <span class="contact-details">(+632) 837-2071  Local : 2188 / 2189 / 2198</span>
                                <span class="contact-details"></span>
                            </div><br>
                            <div id="div_about" style="border-radius: 20px">
                                <i style="color:#00c0ef;text-shadow: 1px 1px 1px #ccc;font-size: 1.5em;" class="fa fa-fax"></i>
                                <span class="contact-details">837-0032</span>
                            </div><br>
                            <div id="div_about" style="border-radius: 20px">
                                <a href="mailto:support@onelab.ph" target="_blank" >
                                <i style="color:#00c0ef;text-shadow: 1px 1px 1px #ccc;font-size: 1.5em;" class="fa fa-envelope"></i></a>
                                   <span class="contact-details">support@onelab.ph</span>
                            </div>

                             </strong>
                        <br>
                    </div>
                    <div class="col-lg-7 col-xs-10" style="margin-left: 20px">
                        <!-- small box -->
                        <div id="div_services" class="small-box bg-aqua " style="border-radius: 20px">
                            <div id="map"></div>
                            <script>
                              function initMap() {
                                var uluru = {lat: 14.491750, lng: 121.048152};
                                var map = new google.maps.Map(document.getElementById('map'), {
                                  zoom: 16,
                                        center: uluru
                                    });
                                    var marker = new google.maps.Marker({
                                        position: uluru,
                                        map: map
                                    });
                                }
                            </script>
                            <script async defer
                                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGejWJC72zowvCl_MvMMsua3sQZmjoy5o&callback=initMap">
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
