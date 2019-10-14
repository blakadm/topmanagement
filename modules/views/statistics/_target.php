<?php
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* 
 * Project Name: Top_Management * 
 * Copyright(C)2019 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 02 11, 19 , 1:35:06 PM * 
 * Module: _target * 
 */
echo $sampleDataTarget;
?>


 <?=
                                    GridView::widget([
                                        'dataProvider' => $dataIncomeTrans,
                                        'summary' => "",
                                        'id'=>'gridIncomeTrans',
                                        // 'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                       //     'year',
                                            'name',
                                            'topcount'
                                        ],
                                    ]);
                                    ?>