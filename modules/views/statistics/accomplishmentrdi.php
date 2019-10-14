<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Top Management', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = ['label' => 'Statistics Dashboard', 'url' => ['/toplevel/statistics/dashboard']];
$this->params['breadcrumbs'][] = 'Accomplishment - RDIs'; // $this->title;


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
    background: #3bafda;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    text-transform: uppercase;
    border: none;
    border-top: 3px solid #3bafda;
    border-bottom: 3px solid #3bafda;
    border-radius: 0;
    overflow: hidden;
    position: relative;
    transition: all 0.3s ease 0s;
}
.tab .nav-tabs li.active a,
.tab .nav-tabs li a:hover{
    border: none;
    border-top: 3px solid #3bafda;
    border-bottom: 3px solid #3bafda;
    background: #fff;
    color: #3bafda;
}
.tab .nav-tabs li a:before{
    content: "";
    border-top: 15px solid #3bafda;
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
    border-bottom: 15px solid #3bafda;
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
    border-top: 3px solid #3bafda;
    border-bottom: 3px solid #3bafda;
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
    <div class="col-md-12">
        <div class="tab" role="tabpanel">

            <ul class="nav nav-tabs" role="tablist">
                
                <li class="">
                    <div style="margin-left: 0px;margin-right: 10px;margin-bottom: 10px;margin-top: 10px;width:200px;">
                                    <?php
                                    echo Select2::widget([
                                        'name' => 'dropYear',
                                        'id' => 'dropYear',
                                        'data' => $listYear,
                                        'addon'=>[
                                         'prepend' => [
                                                    'content' => 'Select Year :'
                                                ],
                                        ],
                                            
                                        'value' => $curYearValue,
                                      //  'options' => ['placeholder' => 'Select Year','text-align'=>'center'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        ],
                                        'pluginEvents' => [
                                            "change" => "function() {
                                                                            
                                                                           var strYear = $('#dropYear').select2('data')[0]['text'];
                                                                         //   var strHdnType = $('input[name=hdnType]:hidden').val();
                                                                         //   alert(strHdnType);
                                                                            
                                                                                $.ajax({
                                                                                    url: '" . Url::toRoute("/toplevel/statistics/subyearrdi") . "',
                                                                                 //   dataType: 'json',
                                                                                    method: 'GET',
                                                                                   data: {paramYear:strYear},

                                                                                    success: function (data, textStatus, jqXHR) {

                                                                                     $('#divAllRDI').html(data);
                                                                                    // $('#liChart').removeClass('active');
                                                                                   //  $('#liMain').addClass('active');
                                                                                   //  $('#tabSamplesTable').tab('show');
                                                                                    $('#liMain').removeClass('active');
                                                                                    $('#liChart').addClass('active');
                                                                                    $('#tabSamplesTable').tab('show');
                                                                                
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
                </li>

                <li id="liMain"><a href="#tabRDIDataTable" data-toggle="tab" aria-expanded="false">Main</a></li>
                <li class="active" id="liChart"><a href="#tabRDIChart" data-toggle="tab" aria-expanded="false">Charts</a></li>
                

            </ul>
           
            
            <div id="divAllRDI">
                    <?php Pjax::begin(); ?>
                <?php
                  echo $this->render('_subyearrdi',['dataTables'=>$dataTables,'dataBarGraph'=>$dataBarGraph,'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'listIndicator'=>$listIndicator,'listMonths'=>$listMonths,'listRDI'=>$listRDI,'CurrentIndicator'=>$CurrentIndicator,'selectedYear'=>$selectedYear,'currentRDI'=>'ITDI','monthCount'=>$monthCount]);
              ?>
                    <?php Pjax::end(); ?>
            </div>
    </div>

</div>
    
</div>