<?php
use kartik\grid\GridView;
/* 
 * Project Name: Top_Management * 
 * Copyright(C)2019 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 02 11, 19 , 11:02:12 AM * 
 * Module: _peragency * 
 */


//echo $dataAccSamples;
?>

 <?=
                                    GridView::widget([
                                        'dataProvider' => $dataAccSamples,
                                        'summary' => "",
                                        'id'=>'gridAccSamples',
                                        // 'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                       //     'year',
                                            'rstl_id',
                                            'janchem',
                                            'janmicro',
                                            'janmetro',
                                            'febchem',
                                            'febmicro',
                                            'febmetro'
                                            
                                        ],
                                    ]);
                                    ?>

