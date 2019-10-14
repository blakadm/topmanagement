<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\helpers\Html;


?>

<style type="text/css">

    .kv-grid-wrapper {
        position: relative;
        overflow: auto;
        height: 500px;
    }
    .highcharts-container{

        min-width: 100% !important;

        width:100% !important;

        max-width:100% !important;

    }	
</style>

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


<style type="text/css">
    .changeColorTitle {
        font-style:italic;
        color:#066da9;
    }
</style>







<div class="row">
    <div class="col-md-3">

        <div class="row">
            <div id="divColumnOverall">  
                    <?php
                    echo Highcharts::widget([
                        'id' => 'columnOverall',
                        'scripts' => [
                            'modules/exporting',
                            'themes/grid-light',
                        ],
                        //  'scripts' => [
                        //   'highcharts-3d',   
                        //  ],
                        'setupOptions'=>
                            [
                            'lang'=> [
                                'thousandsSep'=>','
                                     ]
                        ],
                        'options' => [
                            'credits' => false,
                            
                            'title' => [
                                'text' => '<div style="text-align:center;">' . $curType . ' of RSTL/RDI' . '<br/><div class="changeColorTitle">' . ' For ' . $curIndicator . ' ( ' . $curYear . ' ) ' . '</div></div>',
                                'useHTML' => true,
                            ],
                            'chart' => [
                                'renderTo' => 'divColumnOverall',
                                'type' => 'column',
                            //  'options3d'=>[
                            //             'enabled'=>true,
                            //        'alpha'=>5,  //adjust for tilt
                            //        'beta'=>-28,  // adjust for turn
                            //          'depth'=>50,
                            //   'viewDistance'=>35
                            //  ],  
                            ],
                            'xAxis' => [
                                'title' => [
                                    'text' => '',
                                ],
                                //   'categories' => $listlab,
                                'categories' => [''],
                            ],
                            'yAxis' => [
                                'title' => [
                                    'text' => 'Number of ' . $curIndicator,
                                    'style' =>
                                    [
                                        'color' => '#066da9',
                                        'font-weight' => 'bold',
                                        'font-size' => 15
                                    ],
                                ],
                                'labels' => [
                                    'style' =>
                                    [
                                        // 'color'=>'#066da9',
                                        'font-weight' => 'bold',
                                        'font-size' => 12
                                    ],
                                ],
                            ],
                            'series' => $dataColumnOverall,
                            'plotOptions' => [
                                'column' => [
                                    'dataLabels' => [
                                        'enabled' => true
                                    ],
                                    'depth' => 50
                                ]
                            ],
                            'tooltip' => [
                                'enabled' => false
                            ],
                        ]
                    ]);
                    ?>
            </div>
        </div>
    </div>




    <div class="col-md-4">

        <div class="row">
            <div class="col-md-7" style="margin-left: 0px;margin-bottom: 10px;margin-top: -45px">
                    <?php
                    echo Select2::widget([
                        'name' => 'dropDost',
                        'id' => 'dropDost',
                        'data' => $listDost,
                        'addon' => [
                            'prepend' => [
                                'content' => 'RSTL/RDI :'
                            ],
                        ],
                        //   'value' => $curYearValue,
                        //  'options' => ['placeholder' => 'Select Year','text-align'=>'center'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                        'pluginEvents' => [
                            "change" => "function() {

                                                                                                var strDost = $('#dropDost').select2('data')[0]['text'];
                                                                                                var strYear = $('#dropYear').select2('data')[0]['text'];
                                                                                                var strIndicator = $('#dropIndicator').select2('data')[0]['text'];
                                                                                              //  var strType = $('#dropType').select2('data')[0]['text'];
                                                                                               // var strHdnType = $('input[name=hdnType]:hidden').val();



                                                                                                    $.ajax({
                                                                                                        url: '" . Url::toRoute("/toplevel/statistics/subpieoverall") . "',
                                                                                                     //   dataType: 'json',
                                                                                                        method: 'GET',
                                                                                                       data: {paramDost:strDost,paramYear:strYear,paramIndicator:strIndicator},

                                                                                                        success: function (data, textStatus, jqXHR) {

                                                                                                         $('#divPieOverall').html(data);

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
        <div class="row">
                <?php Pjax::begin(); ?>
                <?php
                echo $this->render('_subpieoverall', ['dataPieOverall' => $dataPieOverall, 'curType' => $curType, 'curYear' => $curYear, 'curIndicator' => $curIndicator,'dataLineArray'=>$dataLineArray,'labType'=>$labType,'listCluster'=>$listCluster]);
                ?>
                <?php Pjax::end(); ?>
        </div>
    </div>
    
    <div class="col-md-5">
      <div class="row">
            <div class="col-md-7" style="margin-left: 0px;margin-bottom: 10px;margin-top: -45px">
                <?php 
                    echo Select2::widget([
                        'name' => 'dropCluster',
                        'id' => 'dropCluster',
                        'data' => $listCluster,
                        'addon' => [
                            'prepend' => [
                                'content' => 'Cluster :'
                            ],
                        ],
                        //   'value' => $curYearValue,
                        //  'options' => ['placeholder' => 'Select Year','text-align'=>'center'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                        'pluginEvents' => [
                            "change" => "function() {

                                                                                                
                                                                                                var strIndicator = $('#dropIndicator').select2('data')[0]['text'];
                                                                                                var strCluster = $('#dropCluster').select2('data')[0]['text'];
                                                                                                var strClusterYear = $('#dropYearLine').select2('data')[0]['text'];
                                                                                              
                                                                                                    $.ajax({
                                                                                                        url: '" . Url::toRoute("/toplevel/statistics/clusterline") . "',
                                                                                                     //   dataType: 'json',
                                                                                                        method: 'GET',
                                                                                                       data: {paramCluster:strCluster,paramIndicator:strIndicator,paramClusterYear:strClusterYear},

                                                                                                        success: function (data, textStatus, jqXHR) {

                                                                                                         $('#divLineClusterOverall').html(data);

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
          <br/><br/>
      
          <div class="col-md-7" style="margin-left: 0px;margin-bottom: 10px;margin-top: -45px">
                                  <?php
                                    echo Select2::widget([
                                        'name' => 'dropYearLine',
                                        'id' => 'dropYearLine',
                                        'data' => $listYearLine,
                                        'addon'=>[
                                         'prepend' => [
                                                    'content' => 'Select Year :'
                                                ],
                                        ],
                                            
                                     //  'value' => $yearIndex,
                                      //  'options' => ['placeholder' => 'Select Year','text-align'=>'center'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        ],
                                       'pluginEvents' => [
                            "change" => "function() {

                                                                                                
                                                                                                var strIndicator = $('#dropIndicator').select2('data')[0]['text'];
                                                                                                var strCluster = $('#dropCluster').select2('data')[0]['text'];
                                                                                                var strClusterYear = $('#dropYearLine').select2('data')[0]['text'];
                                                                                                    $.ajax({
                                                                                                        url: '" . Url::toRoute("/toplevel/statistics/clusterline") . "',
                                                                                                     //   dataType: 'json',
                                                                                                        method: 'GET',
                                                                                                       data: {paramCluster:strCluster,paramIndicator:strIndicator,paramClusterYear:strClusterYear},

                                                                                                        success: function (data, textStatus, jqXHR) {

                                                                                                         $('#divLineClusterOverall').html(data);

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
         
                <?php Pjax::begin(); ?>
                <?php
                echo $this->render('_subclusterline', ['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator,'pCluster'=>'North Luzon','yearmode'=>$yearmode]);
                ?>
                <?php Pjax::end(); ?>
          
        </div>
    </div>


    

</div>







