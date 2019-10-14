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


<div id="divPieGraph" style="max-width: 600px">
                                       <?php
                                            echo Highcharts::widget([
                                               
                                                'id' => 'samplesPieChart',
                                                'scripts' => [
                                                    'highcharts-3d',     
                                                    'themes/grid-light',
                                                   ],
                                               
                                                'options' => [
                                                   // 'tooltip'=>[
                                                   //     'enabled'=>false,
                                                   // ],
                                                    'chart' => [
                                                        'credits'=>false,
                                                        'type' => 'pie',
                                                        'renderTo' => 'divPieGraph',
                                                       'plotBorderWidth'=>0,
                                                        'plotBackgroundColor'=>null,
                                                        'plotShadow'=> false,
                                                        'options3d'=>[
                                                            'enabled'=>true,
                                                        'alpha'=>45,  //adjust for tilt
                                                        'beta'=>0,  // adjust for turn
                                                         'depth'=>35,
                                                         'viewDistance'=>35
                                                        ]  
                                                    ],
                                                     'title' => [
                                                        'useHTML'=>true,
                                                        'text' => '<div style="text-align:center;">' . $CurrentIndicator .' distribution per Month for '. '<br/><div class="changeColorTitle">' . $currentRDI . ' for ' . $selectedYear  . $monthCount .'</div></div>',
                                                  
                                                    ],
                                                    'credits' => false,
                                                  //  'legend' => [
                                                  //      'layout' => 'vertical',
                                                  //      'align' => 'bottom',
                                                   //     'verticalAlign' => 'bottom',
                                                  //      'x' => 60,
                                                  //      'y' => 50,
                                                  //      'floating' => true,
                                                  //      'borderWidth' => 0,
                                                       // 'height'=>100,
                                                //    ],
                                                    'labels' => [
                                                        'items' => [
                                                            [
                                                                'html' => '',
                                                                'style' => [
                                                                    'left' => '50px',
                                                                    'top' => '18px',
                                                                  //  'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                    
                                                    'series' => [
                                                        [
                                                            'name'=>$CurrentIndicator,
                                                            'data' => $dataPieGraph,
                                                         //   'size' => '100%',
                                                            'showInLegend' => true,
                                                            'dataLabels' => [
                                                                'enabled' => true,
                                                                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
                                                                'useHTML' => true,
                                                            ],
                                                        ],
                                                    ],
                                                    
                                                    'plotOptions'=>
                                                    [
                                                        'pie'=>[
                                                            'allowPointSelect'=>true,
                                                            'depth'=>50,
                                                            'innerSize'=>50
                                                        ]
                                                    ]
                                                    
                                                    
                                                ]
                                            ]);
                                            ?>  
                     
                                            
                                      
                                    </div>






