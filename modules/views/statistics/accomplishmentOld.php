<?php

use kartik\select2\Select2;
use yii\helpers\Url;
/*
 * Project Name: Top_Management * 
 * Copyright(C)2019 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 02 11, 19 , 8:55:33 AM * 
 * Module: accomplishment * 
 */

//$this->title = 'Samples';
$this->params['breadcrumbs'][] = ['label' => 'Top Management', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = ['label' => 'Statistics Dashboard', 'url' => ['/toplevel/data/statistics']];
$this->params['breadcrumbs'][] = 'Accomplishments and Targets'; // $this->title;

?>

<style type="text/css">

   a:hover,a:focus{
    outline: none;
    text-decoration: none;
}
.tab .nav-tabs{
    border: none;
    margin-bottom: 10px;
}
.tab .nav-tabs li a{
    padding: 10px 20px;
    margin-right: 15px;
    background: #066da9;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    text-transform: uppercase;
    border: none;
    border-top: 3px solid #066da9;
    border-bottom: 3px solid #066da9;
    border-radius: 0;
    overflow: hidden;
    position: relative;
    transition: all 0.3s ease 0s;
}
.tab .nav-tabs li.active a,
.tab .nav-tabs li a:hover{
    border: none;
    border-top: 3px solid #066da9;
    border-bottom: 3px solid #066da9;
    background: #fff;
    color: #066da9;
}
.tab .nav-tabs li a:before{
    content: "";
    border-top: 15px solid #066da9;
    border-right: 15px solid transparent;
    border-bottom: 15px solid transparent;
    position: absolute;
    top: 0;
    left: -50%;
    transition: all 0.3s ease 0s;
}
.tab .nav-tabs li a:hover:before,
.tab .nav-tabs li.active a:before{ left: 0; }
.tab .nav-tabs li a:after{
    content: "";
    border-bottom: 15px solid #066da9;
    border-left: 15px solid transparent;
    border-top: 15px solid transparent;
    position: absolute;
    bottom: 0;
    right: -50%;
    transition: all 0.3s ease 0s;
}
.tab .nav-tabs li a:hover:after,
.tab .nav-tabs li.active a:after{ right: 0; }
.tab .tab-content{
    padding: 20px 30px;
    border-top: 3px solid #066da9;
    border-bottom: 3px solid #066da9;
    font-size: 13px;
    color: #384d48;
    letter-spacing: 1px;
    line-height: 30px;
    position: relative;
}

.tab .tab-content h3{
    font-size: 24px;
    margin-top: 0;
}
@media only screen and (max-width: 479px){
    .tab .nav-tabs li{
        width: 100%;
        text-align: center;
        margin-bottom: 15px;
    }
}

</style>



<div class="row">
    <div class="col-md-1" style="text-align:center;vertical-align: middle;font-weight: bold;margin-top: 5px"> Select Year : </div>
    <div class="col-md-11" style="width: 200px;margin-left:-30px">
       <?php
        echo Select2::widget([
            'name' => 'dropYearTop10',
            'id' => 'dropYearTop10',
            'data' => $listYear,
            'value' => $curYearValue,
            'options' => ['placeholder' => 'Year'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
            'pluginEvents' => [
                "change" => "function() {
                                                            // var strYear = $('#dropYearTop10 :selected').text();
                                                           //  var strLab = $('#dropLabTop10 :selected').val();
                                                                
                                                                $.ajax({
                                                                    url: '" . Url::toRoute("/toplevel/statistics/accomplishmentalldata") . "',
                                                                 //   dataType: 'json',
                                                                    method: 'GET',
                                                                   data: {paramYear:$('#dropYearTop10 :selected').text()},
                                                                  
                                                                    success: function (data, textStatus, jqXHR) {
                                                                  
                                                                     $('#divAllAccomplishment').html(data);
                                                                   },
                                                                    beforeSend: function (xhr) {
                                                                        //alert('Please wait...');
                                                                        $('.image-loader').addClass( \"img-loader\" );
                                                                    },
                                                                    
                                                                });
                                                            }",
            ],
        ]);
        ?>
    </div>
</div>
<br>

<div class="row">
    <div id="divAllAccomplishment">
     <?php
    echo $this->render('_accomplishmentalldata', ['dataAccSamples' => $dataAccSamples,'dataAccTests'=>$dataAccTests,'dataAccCustomers'=>$dataAccCustomers,'dataAccNewCustomers'=>$dataAccNewCustomers
            ,'dataAccFirms'=>$dataAccFirms,'dataAccFees'=>$dataAccFees,'listYear'=>$listYear,'dataGraphSamples'=>$dataGraphSamples,'listRstl'=>$listRstl]);
    ?>
    </div>
</div>


<!--
<div class="row">
    <div class="col-md-12">
        <div class="tab" role="tabpanel">
           
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tabMain" data-toggle="tab" aria-expanded="false">Main</a></li>
                <li class=""><a href="#tabSamples" data-toggle="tab" aria-expanded="false">Samples</a></li>
                <li class=""><a href="#tabTests" data-toggle="tab" aria-expanded="false">Tests</a></li>
                <li class=""><a href="#tabCustomers" data-toggle="tab" aria-expanded="true">Customers</a></li>
                <li class=""><a href="#" data-toggle="tab" aria-expanded="true">New Customers</a></li>
            </ul>
            
            <div class="tab-content tabs">
                <div role="tabpanel" class="tab-pane" id="tabSamples">
                    TAB 1 Content
                </div>
               
                <div role="tabpanel" class="tab-pane fade" id="tabTests">
                    TAB 2 Content
                </div>
             
                <div role="tabpanel" class="tab-pane fade in active" id="tabCustomers">
                    TAB 3 Content
                </div>
               
            </div>
        </div>
    </div>
</div>
-->









