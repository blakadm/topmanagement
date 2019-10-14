<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
 

?>




                                    <div class="row">
                                        <div class="row" style="margin-bottom:50px">
                                            <div id="divColumnGraph" style="height:400px;width:650px">
                                                <?php
                                                echo Highcharts::widget([
                                                    'id' => 'columnGraphSamples',
                                                    'scripts' => [
                                                        'modules/exporting',
                                                        'themes/grid-light',
                                                    ],
                                                    
                                                    'options' => [
                                                      'credits'=>false,
                                                     
                                                        'title' => [
                                                            'text' =>'<div style="text-align:center;">' . $CurrentIndicator .' Distribution by laboratories for '. '<br/><div class="changeColorTitle">' . $currentRDI . ' for '. $selectedYear . '</div></div>'  ,
                                                            'useHTML'=>true,
                                                        ],
                                                        'chart' => [
                                                            'renderTo' => 'divColumnGraph',
                                                            'type' => 'column',
                                                            
                                                            ],
                                                        'xAxis' => [
                                                            'title' => [
                                                                'text' => '',
                                                                
                                                            ],
                                                         //   'categories' => $listlab,
                                                            'categories'=>[$currentRDI . ' Laboratories'],
                                                             'labels'=>
                                                                [
                                                                     'style'=>[
                                                                        'color'=>'#066da9',
                                                                        'font-weight'=>'bold',
                                                                        'font-size'=> 15
                                                                    ],
                                                                ],
                                                        ],
                                                        'yAxis' => [
                                                            'title' => [
                                                                'text' => $CurrentIndicator,
                                                                 'style'=>[
                                                                        'color'=>'#066da9',
                                                                        'font-weight'=>'bold',
                                                                        'font-size'=> 15
                                                                    ],
                                                            ],
                                                            'labels'=>
                                                                [
                                                                     'style'=>[
                                                                     //   'color'=>'#066da9',
                                                                        'font-weight'=>'bold',
                                                                        'font-size'=> 12
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
                                                        'series' => $dataColumn,
                                                        'plotOptions' => [
                                                                        'column' => [
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
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row" id="divRstlMonth">
                                            <div class="col-md-4" style="margin-left: 45px;margin-bottom: 10px;margin-top: 10px">
                                               <?php
                                                echo Select2::widget([
                                                    'name' => 'dropMonths',
                                                    'id' => 'dropMonths',
                                                    'data' => $listMonths,
                                                    'value' => 'All',
                                                    'options' => ['placeholder' => 'Select Month'],
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                    ],
                                                    'pluginEvents' => [
                                                        "change" => "function() {
                                                            
                                                                           var strYear = $('#dropYear').select2('data')[0]['text'];
                                                                           var strIndicator = $('#dropIndicator').select2('data')[0]['text'];
                                                                           var strRDI = $('#dropRDI').select2('data')[0]['text'];
                                                                           var strMonth = $('#dropMonths').select2('data')[0]['text'];
                                                                           
                                                                           //  alert('The value of hidden input is: ' + strHdnRstl);
                                                                               
                                                                        //    var strYear = $('#dropYear').select2('data')[0]['text'];
                                                                        //    var strRstl = strHdnRstl; // $('#dropRstl').select2('data')[0]['text'];
                                                                        //    var strMonth = $('#dropMonths').select2('data')[0]['text'];
                                                                            
                                                                           
                                                                              //  var test = $('input[name='hdnRstl']:hidden');
                                                                               // test.val(strRstl);
                                                                              //  $('#dropRstl').val(strRstl);

                                                                                $.ajax({
                                                                                   url: '" . Url::toRoute("/toplevel/statistics/subpierdi") . "',
                                                                                 //   dataType: 'json',
                                                                                    method: 'GET',
                                                                                   data: {paramYear:strYear,paramIndicator:strIndicator,paramRDI:strRDI,paramMonth:strMonth},

                                                                                    success: function (data, textStatus, jqXHR) {
                                                                                  //   var test = $('input[name=testing]:hidden');
                                                                                   //      alert('The value of hidden input is: ' + test.val())
                                                                                     $('#divPieGraph').html(data);
                                                                                    
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
                                            <div id="DivPieRDI">
                                                <?php Pjax::begin(); ?>
                                                  <?php
                                                  echo $this->render('_subpierdi', ['dataPieGraph' => $dataPieGraph,'dataPieGraph'=>$dataPieGraph,'listMonths'=>$listMonths,'CurrentIndicator'=>$CurrentIndicator,'currentRDI'=>$currentRDI,'selectedYear'=>$selectedYear,'monthCount'=>$monthCount]);
                                                  ?>
                                                <?php Pjax::end(); ?>
                                            </div>
                                        </div>
                                    </div>
                          