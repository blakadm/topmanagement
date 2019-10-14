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



        <div class ="col-md-4">
            <div id="divLineRstl">
                                    <?php
                                    echo Highcharts::widget([
                                        'id' => 'lineRstl',
                                        'scripts' => [
                                          'modules/exporting',
                                           'themes/grid-light',
                                       ],
                                        'setupOptions'=>
                                            [
                                            'lang'=> [
                                                'thousandsSep'=>','
                                                     ]
                                        ],
                               //              'scripts' => [
                                //                    'highcharts-3d',   
                                //                   ],
                                        'options' => [
                                             'credits'=>false,
                                            'chart' => [
                                               // 'type' => 'line',
                                                'renderTo' => 'divLineRstl',
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
                                                'useHTML'=>true,
                                                'text' => '<div style="text-align:center;">' . 'Number of  ' . '<br/><div class="changeColorTitle">' . $curIndicator . ' per year ( ' . Yii::$app->user->identity->type  . ' )</div></div>',
                   
                                            ],
                                            'xAxis' => [
                                                //   'categories'=>$listRstl,
                                               // 'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                                'categories' => $dataArrayYear,
                                               'title' => [
                                                    'text' =>'YEAR',
                                                    'style'=>[
                                                        'color'=>'#066da9',
                                                        'font-weight'=>'bold',
                                                        'font-size'=> 15
                                                    ],
                                                   
                                                ],
                                                'labels' => [
                                                    'overflow' => 'bottom',
                                                   'style'=>[
                                                       // 'color'=>'#066da9',
                                                        'font-weight'=>'bold',
                                                        'font-size'=> 12
                                                    ],
                                                ]
                                            ],
                                            'tooltip' => [
                                                'enabled' => false
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
                                                 'line'=> [
                                                    'dataLabels'=> [
                                                        'enabled'=> true
                                                    ],
                                                    'enableMouseTracking'=> false
                                                ],
                                                
                                            ],
                                            'legend'=>
                                            [
                                                'enabled'=> false,
                                            ],
                                         
                                           // 'series' => $dataBarGraph
                                            'series'=>[
                                             $arrayLineRec,
                                                
                                           ]
                                            
                                        ],
                                        
                                       
                                    ]);
                                    ?>
        </div>
        </div>
        <div class ="col-md-4">
            <?php Pjax::begin(); ?>
           <?php 
       //     if( Yii::$app->user->identity->type!='ITDI' || Yii::$app->user->identity->type=='FPRDI' || Yii::$app->user->identity->type=='FNRI' || Yii::$app->user->identity->type=='MIRDC' || Yii::$app->user->identity->type=='PNRI' || Yii::$app->user->identity->type=='PTRI')
        //        {
        //                         echo $this->render('_perrstl',['dataArrayYear'=>$dataArrayYear,'curIndicator'=>$curIndicator,'dataColumnGraph'=>$dataColumnGraph]);
          //      }
           switch(Yii::$app->user->identity->type) 
           {
               case 'ITDI':
                   echo $this->render('_peritdi',['dataArrayYear'=>$dataArrayYear,'curIndicator'=>$curIndicator,'dataColumnGraph'=>$dataColumnGraph]);
                   break;
               case 'FPRDI':
                    echo $this->render('_perrstl',['dataArrayYear'=>$dataArrayYear,'curIndicator'=>$curIndicator,'dataColumnGraph'=>$dataColumnGraph]);
                    break;
               case 'FNRI':
                    echo $this->render('_perrstl',['dataArrayYear'=>$dataArrayYear,'curIndicator'=>$curIndicator,'dataColumnGraph'=>$dataColumnGraph]);
                    break;
               case 'MIRDC': // 7 columns not checked
                    echo $this->render('_permirdc',['dataArrayYear'=>$dataArrayYear,'curIndicator'=>$curIndicator,'dataColumnGraph'=>$dataColumnGraph]);
                    break;
               case 'PNRI':
                    echo $this->render('_peritdi',['dataArrayYear'=>$dataArrayYear,'curIndicator'=>$curIndicator,'dataColumnGraph'=>$dataColumnGraph]);
                    break;
               case 'PTRI':
                    echo $this->render('_perptri',['dataArrayYear'=>$dataArrayYear,'curIndicator'=>$curIndicator,'dataColumnGraph'=>$dataColumnGraph]);
                    break;
               default : 
                   echo $this->render('_perrstl',['dataArrayYear'=>$dataArrayYear,'curIndicator'=>$curIndicator,'dataColumnGraph'=>$dataColumnGraph]);
                    break;
           } 
           ?>
             <?php Pjax::end(); ?>
        </div>

        <div class="col-md-4">
                    <div class="row">
                        
                        <?php Pjax::begin(); ?>
                        <?php
                        echo $this->render('_acctargetsperrstlrdi', ['listYear'=>$listYear,'listIndicatorAcc' => $listIndicatorAcc, 'dataAccomp' => $dataAccomp, 'dataTargets' => $dataTargets,'curIndicator' => $curIndicator]);
                        ?>
                        <?php Pjax::end(); ?>       

                    </div>
        </div>
        
