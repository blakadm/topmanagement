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


        <div id="divColumnPerRstlAcc">
                <?php
                echo Highcharts::widget([
                    'id' => 'columnGraphSamples',
                    'scripts' => [
                        'modules/exporting',
                        'themes/grid-light',
                    ],
                    'options' => [
                        'credits' => false,
                        'lang' => [
                            'thousandsSep' => ','
                        ],
                        'title' => [
                            'text' => '<div style="text-align:center;">' . ' Accomplishments and targets for ' . '<br/><div class="changeColorTitle">' . $curIndicator . '</div></div>',
                            'useHTML' => true,
                        ],
                        'chart' => [
                            'renderTo' => 'divColumnPerRstlAcc',
                            'type' => 'column',
                        ],
                        'xAxis' => [
                            'title' => [
                                'text' => '',
                                'style' => [
                                    'color' => '#066da9',
                                    'font-weight' => 'bold',
                                    'font-size' => 15
                                ],
                            ],
                            'labels' => [
                                'style' => [
                                    'color' => '#066da9',
                                    'font-weight' => 'bold',
                                    'font-size' => 15
                                ],
                            ],
                            //    'categories' => $listlab,
                            'categories' => ['2016', '2017', '2018', '2019'],
                        ],
                        'yAxis' => [
                            'title' => [
                                'text' =>'',// '$currentType',
                                'style' => [
                                    'color' => '#066da9',
                                    'font-weight' => 'bold',
                                    'font-size' => 15
                                ],
                            ],
                            'labels' => [
                                'style' => [
                                    // 'color'=>'#066da9',
                                    'font-weight' => 'bold',
                                    'font-size' => 12
                                ],
                            ],
                        ],
                        'labels' => [
                            'items' => [
                                [
                                    'style' => [
                                        'left' => '50px',
                                        'top' => '18px',
                                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                                    ],
                                ],
                            ],
                        ],
                        'series' => [
                            $dataAccomp[0], $dataTargets[0]
                        ],
                        'plotOptions' => [
                            'column' => [
                                'grouping' => false,
                                'dataLabels' => [
                                    'enabled' => true
                                ]
                            ]
                        ],
                        'tooltip' => [
                            'enabled' => false
                        ],
                    ]
                ]);
                ?>
        </div>
 
