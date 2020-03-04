<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
$this->title = 'Be A Member';

//$this->title = 'Services';
//$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
ol {
  list-style: none;
  counter-reset: my-awesome-counter;
  display: flex;
  flex-wrap: wrap;
  margin: 0;
  padding: 0;
}
ol li {
  counter-increment: my-awesome-counter;
  display: flex;
  width: 50%;
  font-size: 0.8rem;
  margin-bottom: 0.5rem;
}
ol li::before {
  content: "0" counter(my-awesome-counter);
  font-weight: bold;
  font-size: 3rem;
  margin-right: 0.5rem;
  font-family: 'Abril Fatface', serif;
  line-height: 1;
}

.tile {
	border-style: solid;
	padding: 10px;
	border-width: 3px;
	color: black;
	display: inline-block;
	height: 130px;
	list-style-type: none;
	margin: 10px 40px 10px 20px;
	position: relative;
	text-align: center;
	width: 130px;
	border-radius: 25px;
    border-color:#000;
	box-shadow: 10px 10px 5px #888888;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #3c8dbc), color-stop(1, #066da9 ));
	background-image: linear-gradient(-28deg, #3c8dbc 0%, #066da9  100%);
    vertical-align: center;
	text-align: center;
   
    color:#fff;
    font-weight:bold;
}



</style>



<div class="body-content" style="background-color: #ecf0f5">
    <div class="container">

        <br>
    
        
  

        <div class="row" style="padding-bottom: 30px">
            <br>
            <div style="margin-bottom: 1%;margin-left: 1%;height:30px;background-image:linear-gradient(40deg, #3c8dbc  40%,transparent 5%);border-bottom: #3c8dbc medium solid;">
                <p style='color:white;font-size:1.5rem;font-weight: bold;padding-top:.5%;padding-left: 1%'>Member Benefits</p>
                <div class="row" style="text-align:center">
                    <div class="center">
                        <div class="col-md-2 col-xs-3 tile" style="padding-top:30px;font-size:1.4em">New<br>Customers</div>
                        <div class="col-md-2 col-xs-3 tile" style="padding-top:20px;font-size:1.2em">Free advertisement of Services</div>
                        <div class="col-md-2 col-xs-3 tile" style="padding-top:10px;font-size:1.1em">Networking and learning from other Member laboratories</div>
                        <div class="col-md-2 col-xs-3 tile" style="padding-top:15px;font-size:1.2em">Opportunity for benchmarking</div>
                    <div class="col-md-2 c col-xs-3 tile" style="padding-top:15px;font-size:1.2em">Enhancement of methods and competence</div>
                    <div class="col-md-2 col-xs-3 tile" style="padding-top:15px;font-size:1.2em">Glimpse of the business environment needs</div>
                    </div>
                </div>
                

            </div>
        </div>
        
        <div class="row" style="padding-bottom: 30px">
        <br>
            <div style="margin-bottom: 1%;margin-left: 1%;height:30px;background-image:linear-gradient(40deg, #3c8dbc  60%,transparent 5%);border-bottom: #3c8dbc medium solid;">
                <p style='color:white;font-size:1.5rem;font-weight: bold;padding-top:.5%;padding-left: 1%'>Member Requirements</p>
                <div class="row">
                    <div class="col-md-12 col-xs-12" style="font-size:1.2em"><i class="fa fa-dot-circle-o" style="color:#066da9;font-size:1.5em;"></i>&nbsp&nbsp&nbspThe laboratory should be an ISO/IEC 17025:2017 “General Requirements for the Competence of Testing and Calibration Laboratories” accredited.

                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12" style="font-size:1.2em"><i class="fa fa-dot-circle-o" style="color:#066da9;font-size:1.5em;"></i>&nbsp&nbsp&nbspMembership in the network is valid for five (5) years
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-12 col-xs-12" style="font-size:1.2em"><i class="fa fa-dot-circle-o" style="color:#066da9;font-size:1.5em;"></i>&nbsp&nbsp&nbspMembership can be renewed upon submission of a Letter of Intent addressed to OneLab Project Leaders.
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="padding-bottom: 30px">
        <br>
            <div style="margin-bottom: 1%;margin-left: 1%;height:30px;background-image:linear-gradient(40deg, #3c8dbc  70%,transparent 5%);border-bottom: #3c8dbc medium solid;">
                <p style='color:white;font-size:1.5rem;font-weight: bold;padding-top:.5%;padding-left: 1%'>IT System and Hardware Requirements
</p>
            <div class="row">
                   
                   <div class="col-md-12 col-xs-12" style="font-size:1.2em"><i class="fa fa-dot-circle-o" style="color:#066da9;font-size:1.5em;"></i>&nbsp&nbsp&nbspThe member-laboratories are required to adopt the Referral System Module of OneLab.
                    </div>
             
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12" style="font-size:1.2em"><i class="fa fa-dot-circle-o" style="color:#066da9;font-size:1.5em;"></i>&nbsp&nbsp&nbspThe DOST IX-developed Enhanced Unified Laboratory Information System (eULIMS) may be used by any member free of charge.
                        </div>
                   
                </div>
                <div class="row">
                   
                    <div class="col-md-12 col-xs-12" style="font-size:1.2em"><i class="fa fa-dot-circle-o" style="color:#066da9;font-size:1.5em;"></i>&nbsp&nbsp&nbspMember-laboratories having their own laboratory information system are not be obliged to use or migrate to the OneLab 
     eULIMS.

                    </div>
              
                </div>
               
                <div class="row">
                   <br><br>
                   <div class="col-md-12 col-xs-12" style="font-size:1em"><i class="fa fa-asterisk" style="color:#066da9;font-size:1em;"></i>&nbsp&nbsp&nbsp If you want to be part of this global network, please send a letter of intent to the OneLab Project leaders :
                  <br><strong style="color: #024a74;"> 
                  <br>Rosemarie S. Salazar</strong>
                  <br> Assistant Regional Director
                  <br>Finance, Administrative Support and Technical Services(FASTS)
                   <br>DOST Region - IX
                   <br>Pettit Barracks, Zamboanga City
                   <br>(062) 991-1024 
                   <br>rosemarie.salazar@gmail.com
                   <br> <br>
                   or
                   <br>

                   <strong style="color: #024a74;"> <br>Dr. Annebelle V. Briones, Ph.D</strong>
                   <br> Director
                  <br> DOST - Industrial Technology Development Institute (ITDI)
                   <br>DOST Building, General Santos Avenue
                   <br>Bicutan, Taguig City
                   <br>(632) 837-3167, 837-2071 to 82 loc. 2218, 2215
                    <br>avbriones2003@yahoo.com,avbriones@itdi.dost.gov.ph


                   </div>
             
               </div>

            </div>
        </div>
        

    </div>
</div>
