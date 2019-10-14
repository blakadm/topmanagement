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
//echo $sampleDataTarget;

 
?>
<style type="text/css">
   
    .kv-grid-wrapper {
    position: relative;
    overflow: auto;
    height: 600px;
}
    </style>



  <?=
                                      GridView::widget([
                                        'dataProvider' => $dataAccTests,
                                        'summary' => "",
                                       'floatHeader'=>true,
                                     
                                        'perfectScrollbar'=>true,
                                         'headerRowOptions' => ['style' => 'text-align:center;'],
                                        'id'=>'gridAccTests',
                                        // 'filterModel' => $searchModel,
                                            'beforeHeader'=>[
                                                [
                                                    'columns'=>[
                                                        ['content'=>'RSTL ID', 'options'=>['class'=>'text-center warning']], 
                                                        ['content'=>'REGION', 'options'=>[ 'class'=>'text-center warning']], 
                                                        ['content'=>'JANUARY', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
                                                        ['content'=>'FEBRUARY', 'options'=>['colspan'=>3,  'class'=>'text-center warning']], 
                                                        ['content'=>'MARCH', 'options'=>['colspan'=>3,  'class'=>'text-center warning']], 
                                                        ['content'=>'APRIL', 'options'=>['colspan'=>3,  'class'=>'text-center warning']], 
                                                        ['content'=>'MAY', 'options'=>['colspan'=>3,  'class'=>'text-center warning']], 
                                                        ['content'=>'JUNE', 'options'=>['colspan'=>3,  'class'=>'text-center warning']], 
                                                        ['content'=>'JULY', 'options'=>['colspan'=>3,  'class'=>'text-center warning']], 
                                                        ['content'=>'AUGUST', 'options'=>['colspan'=>3,  'class'=>'text-center warning']], 
                                                        ['content'=>'SEPTEMBER', 'options'=>['colspan'=>3,  'class'=>'text-center warning']], 
                                                        ['content'=>'OCTOBER', 'options'=>['colspan'=>3,  'class'=>'text-center warning']], 
                                                        ['content'=>'NOVEMBER', 'options'=>['colspan'=>3,  'class'=>'text-center warning']], 
                                                        ['content'=>'DECEMBER', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
                                                    ],
                                                    'options'=>['class'=>'skip-export'] // remove this row from export
                                                ]
                                            ],
                                        'columns' => 
                                        [
                                            [
                                                'attribute' => 'rstl_id', 
                                                'label'=>'',
                                                'vAlign' => 'right',
                                                'hAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'region', 
                                                'label'=>'',
                                                'vAlign' => 'right',
                                                'hAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'janchem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'janmicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'janmetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            
                                            [
                                                'attribute' => 'febchem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'febmicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'febmetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            
                                             [
                                                'attribute' => 'marchem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'marmicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'marmetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            
                                             [
                                                'attribute' => 'aprchem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'aprmicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'aprmetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            
                                             [
                                                'attribute' => 'maychem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'maymicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'maymetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            
                                             [
                                                'attribute' => 'junchem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'junmicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'junmetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            
                                             [
                                                'attribute' => 'julchem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'julmicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'julmetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            
                                             [
                                                'attribute' => 'augchem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'augmicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'augmetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            
                                             [
                                                'attribute' => 'sepchem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'sepmicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'sepmetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            
                                             [
                                                'attribute' => 'octchem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'octmicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'octmetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            
                                             [
                                                'attribute' => 'novchem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'novmicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'novmetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            
                                             [
                                                'attribute' => 'decchem', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'decmicro', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'decmetro', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                        ]
                                    ]);
                                    ?>

    
