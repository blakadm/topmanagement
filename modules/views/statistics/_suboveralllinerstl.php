<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
/* 
 * Project Name: Top_Management * 
 * Copyright(C)2019 Department of Science & Technology -IX * 

 *  * Developer: Eng'r Nolan F. Sunico  * 
 * 02 11, 19 , 1:35:06 PM * 
 * Module: _target * 
 */
//echo $sampleDataTarget;


?>
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
<div id="divLineRstlOverall">
                    <?php
                    echo Highcharts::widget([
                        'id' => 'lineRstlOverall',
                        'scripts' => [
                            'modules/exporting',
                            'themes/grid-light',
                        ],
                        //              'scripts' => [
                        //                    'highcharts-3d',   
                        //                   ],
                        'options' => [
                            'credits' => false,
                            'chart' => [
                                // 'type' => 'line',
                                'renderTo' => 'divLineRstlOverall',
                            //     'options3d'=>[
                            //                            'enabled'=>true,
                            //                         'alpha'=>5,  //adjust for tilt
                            //                         'beta'=>-28,  // adjust for turn
                            //                          'depth'=>50,
                            //   'viewDistance'=>35
                            //            ],
                            // 'marginTop' => -80
                            ],
                            'title' => [
                                'useHTML' => true,
                                'text' => '<div style="text-align:center;">' . 'Number of  ' . '<br/><div class="changeColorTitle">' . $curIndicator . ' per RSTL  </div></div>',
                            ],
                            'xAxis' => [
                                //   'categories'=>$listRstl,
                                // 'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                'categories' =>['2016','2017','2018','2019'], //$dataArrayYear,
                                'title' => [
                                    'text' => 'YEAR',
                                    'style' => [
                                        'color' => '#066da9',
                                        'font-weight' => 'bold',
                                        'font-size' => 15
                                    ],
                                ],
                                'labels' => [
                                    'overflow' => 'bottom',
                                    'style' => [
                                        // 'color'=>'#066da9',
                                        'font-weight' => 'bold',
                                        'font-size' => 12
                                    ],
                                ]
                            ],
                            'tooltip' => [
                                'enabled' => false
                            ],
                            'yAxis' => [
                                'min' => 0,
                                'title' => [
                                    'text' => '$curIndicator',
                                    'align' => 'high',
                                    'style' => [
                                        'color' => '#066da9',
                                        'font-weight' => 'bold',
                                        'font-size' => 15
                                    ],
                                ],
                                'labels' => [
                                    'overflow' => 'justify',
                                    'style' => [
                                        // 'color'=>'#066da9',
                                        'font-weight' => 'bold',
                                        'font-size' => 12
                                    ],
                                ]
                            ],
                            'plotOptions' => [
                                'line' => [
                                    'dataLabels' => [
                                        'enabled' => true
                                    ],
                                    'enableMouseTracking' => true
                                ],
                            ],
                            'legend' =>
                            [
                                'enabled' => true,
                            ],
                            // 'series' => $dataBarGraph
                            'series' => [$dataLineArray[0],$dataLineArray[1],$dataLineArray[2],$dataLineArray[3],$dataLineArray[4],$dataLineArray[5],
                                $dataLineArray[6],$dataLineArray[7],$dataLineArray[8],$dataLineArray[9],$dataLineArray[10],$dataLineArray[11],$dataLineArray[12],
                                $dataLineArray[13],$dataLineArray[14],$dataLineArray[15]],
                            'responsive'=> [
                                        'rules'=> [[
                                            'condition'=> [
                                                'maxWidth'=> 500
                                            ],
                                            'chartOptions'=> [
                                                'legend'=> [
                                                    'layout'=> 'horizontal',
                                                    'align'=> 'center',
                                                    'verticalAlign'=> 'bottom'
                                                ]
                                            ]
                                        ]]
                                    ],
                        ],
                    ]);
                    ?>
            </div>