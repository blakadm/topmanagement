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

 <?php
                    echo Highcharts::widget([
                        'id' => 'lineClusterOverall4',
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
                                'renderTo' => 'divLineClusterOverall',
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
                                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                              //  'categories' =>['2016','2017','2018','2019'], //$dataArrayYear,
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
                                    'text' => '',
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
                            'series' => [$dataLineArray[0],$dataLineArray[1],$dataLineArray[2],$dataLineArray[3],],
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

