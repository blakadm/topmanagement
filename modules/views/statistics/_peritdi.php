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

<div id="divStackedRstl" style="height: 500px;">
                                    <?php
                                    echo Highcharts::widget([
                                        'id' => 'stackedRstl',
                                     //   'scripts' => [
                                    //        'modules/exporting',
                                    //        'themes/grid-light',
                                    //    ],
                                          'scripts' => [
                                                    'highcharts-3d',   
                                                   ],
                                        'options' => [
                                             'credits'=>false,
                                            'colors'=> ['#B71C1C','#9C27B0','#9575CD','#303F9F','#00BCD4','#4CAF50','#DCEDC8','#F06292'],
                                            'chart' => [
                                                'type' => 'column',
                                                'renderTo' => 'divStackedRstl',
                                                'options3d'=>[
                                                                        'enabled'=>true,
                                                                    'alpha'=>5,  //adjust for tilt
                                                                    'beta'=>-28,  // adjust for turn
                                                                     'depth'=>50,
                                                                  //   'viewDistance'=>35
                                                        ],
                                               // 'marginTop' => -80
                                            ],
                                            'title' => [
                                                'useHTML'=>true,
                                                'text' => '<div style="text-align:center;">' . 'Distribution by laboratories for  ' . '<br/><div class="changeColorTitle">' . $curIndicator . ' ( ' . Yii::$app->user->identity->type  .' )</div></div>',
                   
                                            ],
                                            'xAxis' => [
                                                'categories' => $dataArrayYear,
                                                'title' => [
                                                    'text' => '',
                                                    'style'=>[
                                                        'color'=>'#066da9',
                                                        'font-weight'=>'bold',
                                                        'font-size'=> 15
                                                    ],
                                                    
                                                ],
                                                'labels' => [
                                                    'overflow' => 'justify',
                                                    'style'=>[
                                                       // 'color'=>'#066da9',
                                                        'font-weight'=>'bold',
                                                        'font-size'=> 12
                                                    ],
                                                ]
                                            ],
                                            'tooltip' => [
                                                'enabled' => true,
                                                 'format' => '<b>{point.name}</b> : {point.y}',
                                            ],
                                            'yAxis' => [
                                                'min' => 0,
                                                'title' => [
                                                    'text' =>$curIndicator,
                                                    'align' => 'high',
                                                    'style'=>[
                                                        'color'=>'#066da9',
                                                        'font-weight'=>'bold',
                                                        'font-size'=> 15
                                                    ],
                                                ],
                                                'labels' => [
                                                    'overflow' => 'justify',
                                                    'style'=>[
                                                       // 'color'=>'#066da9',
                                                        'font-weight'=>'bold',
                                                        'font-size'=> 12
                                                    ],
                                                ]
                                               
                                            ],
                                            'plotOptions' => [
                                                 'column'=> [
                                                    'stacking'=>'normal',
                                                    'dataLabels'=> [
                                                        'enabled'=> false,
                                                      //  'format' => '<b>{point.name}</b> : {point.y}',
                                                        //'color'=>['orange','pink','green',],
                                                    ],
                                                    'enableMouseTracking'=> true
                                                ],
                                                
                                            ],
                                            
                                           
                                            'series'=> [
                                              $dataColumnGraph[0],$dataColumnGraph[1],$dataColumnGraph[2],
                                              $dataColumnGraph[3],$dataColumnGraph[4],$dataColumnGraph[5]
                                           ],

                                               
    

                                            
                                        ]
                                    ]);
                                    ?>
        </div>
