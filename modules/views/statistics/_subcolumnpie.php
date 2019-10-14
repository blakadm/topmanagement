<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
 
//var_dump('SUBCOLUMNPIE - ' . $currentType);
?>

 <div class="col-md-6">
    <div class="row">
        <div class="col-md-4" style="margin-left: 45px;margin-bottom: 10px;margin-top: 10px">
                                            <?php
                                            echo Select2::widget([
                                                'name' => 'dropRstl',
                                                'id' => 'dropRstl',
                                                'data' => $listRstl,
                                                //'value' => 5,
                                                'options' => ['placeholder' => 'Select RSTL'],
                                                'pluginOptions' => [
                                                    'allowClear' => true,
                                                ],
                                                'pluginEvents' => [
                                                    "change" => "function() {
                                                                            var strYear = $('#dropYear').select2('data')[0]['text'];
                                                                            var strRstl = $('#dropRstl').select2('data')[0]['text'];
                                                                            var test = $('input[name=hdnRstl]:hidden');
                                                                            test.val(strRstl);
                                                                            //   alert('The value of hidden input is: ' + test.val())
                                                                                

                                                                                $.ajax({
                                                                                    url: '" . Url::toRoute("/toplevel/statistics/subcolumnpie?type=") . $currentType . "',
                                                                                 //   dataType: 'json',
                                                                                    method: 'GET',
                                                                                   data: {paramYear:strYear,paramRstl:strRstl},

                                                                                    success: function (data, textStatus, jqXHR) {
                                                                                     
                                                                                    // 
                                                                                     $('#divColumnGraph').html(data);
                                                                                    // $('#dropRstl').val('3').trigger('change');
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
        <div class="row" style="margin-bottom:50px">
           <div id="divColumnGraph" >
                                                <?php
                                                echo Highcharts::widget([
                                                    'id' => 'columnGraphSamples',
                                                    'scripts' => [
                                                        'modules/exporting',
                                                        'themes/grid-light',
                                                    ],
                                                    
                                                    
                                                    
                                                    'options' => [
                                                         'credits'=>false,
                                                         'defs'=>[
                                                                    'patterns'=>[      
                                                                      'id'=>'testpattern',
                                                                      'path'=>[
                                                                           'd'=> 'M 0 0 L 10 10 M 9 -1 L 11 1 M -1 9 L 1 11',
                                                                          'stroke'=> 'rgb(1,151,214)',
                                                                     ' strokeWidth'=> 2,
                                                                    'fill'=> 'rgba(1,151,214, 0.3)'
                                                                      ],
                                                                    ],
                                                                    ],
                                                     
                                                      
                                                      'lang'=> [
                                                    'thousandsSep'=>','
                                                             ],
                                                        'title' => [
                                                            'text' =>'<div style="text-align:center;">' . $currentType .' Distribution by laboratories for '. '<br/><div class="changeColorTitle">' . $initialRegion . ' for '. $selectedYear . '</div></div>'  ,
                                                            'useHTML'=>true,
                                                        ],
                                                        'chart' => [
                                                            'renderTo' => 'divColumnGraph',
                                                            'type' => 'column',
                                                            
                                                            ],
                                                        'xAxis' => [
                                                            'title' => [
                                                                'text' => '',
                                                                 'style'=>[
                                                                    'color'=>'#066da9',
                                                                    'font-weight'=>'bold',
                                                                    'font-size'=> 15
                                                                ],
                                                            ],
                                                            'labels'=>[
                                                                 'style'=>[
                                                        'color'=>'#066da9',
                                                        'font-weight'=>'bold',
                                                        'font-size'=> 15
                                                    ],
                                                            ],
                                                      //    'categories' => $listlab,
                                                           'categories'=>[$initialRegion . ' Laboratories'],
                                                        ],
                                                        'yAxis' => [
                                                            'title' => [
                                                                'text' =>  $currentType,
                                                         'style'=>[
                                                        'color'=>'#066da9',
                                                        'font-weight'=>'bold',
                                                        'font-size'=> 15
                                                    ],
                                                            ],
                                                            'labels'=>[
                                                                 'style'=>[
                                                       // 'color'=>'#066da9',
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


<div class="col-md-6">
    <div class="row">
        <div id="divRstlMonth">
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
                                                            
                                                                            var strHdnRstl = $('input[name=hdnRstl]:hidden').val();
                                                                             
                                                                           //  alert('The value of hidden input is: ' + strHdnRstl);
                                                                               
                                                                            var strYear = $('#dropYear').select2('data')[0]['text'];
                                                                            var strRstl = strHdnRstl; // $('#dropRstl').select2('data')[0]['text'];
                                                                            var strMonth = $('#dropMonths').select2('data')[0]['text'];
                                                                            
                                                                           
                                                                              //  var test = $('input[name='hdnRstl']:hidden');
                                                                               // test.val(strRstl);
                                                                              //  $('#dropRstl').val(strRstl);

                                                                                $.ajax({
                                                                                   url: '" . Url::toRoute("/toplevel/statistics/subpie?type=") . $currentType . "',
                                                                                 //   dataType: 'json',
                                                                                    method: 'GET',
                                                                                   data: {paramMonth:strMonth,paramRstl:strRstl,paramYear:strYear},

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
    </div>

    <div class="row">
        <?php Pjax::begin(); ?>
                                            <?php
                                            echo $this->render('_subpie', ['dataPieGraph' => $dataPieGraph,'selectedYear'=>$selectedYear,'initialRegion'=>$initialRegion,'currentType'=>$currentType,'monthCount'=>$monthCount]);
                                            ?>
                                             <?php Pjax::end(); ?>
    </div>
                           
</div>