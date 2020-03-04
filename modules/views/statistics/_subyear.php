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

<style type="text/css">

        .kv-grid-wrapper {
            position: relative;
            overflow: auto;
            height: 500px;
        }
        .highcharts-container{

            min-width: 100% !important;

            width:100% !important;

            max-width:100% !important;

        }	
    </style>
 
 <style type="text/css">

   a:hover,a:focus{
    outline: none;
    text-decoration: none;
}
.tab .nav-tabs{
    border: none;
    margin-bottom: 10px;
}
.tab .nav-tabs li a{
    padding: 10px 20px;
    margin-right: 15px;
    background: #3bafda;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    text-transform: uppercase;
    border: none;
    border-top: 3px solid #3bafda;
    border-bottom: 3px solid #3bafda;
    border-radius: 0;
    overflow: hidden;
    position: relative;
    transition: all 0.3s ease 0s;
}
.tab .nav-tabs li.active a,
.tab .nav-tabs li a:hover{
    border: none;
    border-top: 3px solid #3bafda;
    border-bottom: 3px solid #3bafda;
    background: #fff;
    color: #3bafda;
}
.tab .nav-tabs li a:before{
    content: "";
    border-top: 15px solid #3bafda;
    border-right: 15px solid transparent;
    border-bottom: 15px solid transparent;
    position: absolute;
    top: 0;
    left: -50%;
    transition: all 0.3s ease 0s;
}
.tab .nav-tabs li a:hover:before,
.tab .nav-tabs li.active a:before{ left: 0; }
.tab .nav-tabs li a:after{
    content: "";
    border-bottom: 15px solid #3bafda;
    border-left: 15px solid transparent;
    border-top: 15px solid transparent;
    position: absolute;
    bottom: 0;
    right: -50%;
    transition: all 0.3s ease 0s;
}
.tab .nav-tabs li a:hover:after,
.tab .nav-tabs li.active a:after{ right: 0; }
.tab .tab-content{
    padding: 20px 30px;
    border-top: 3px solid #3bafda;
    border-bottom: 3px solid #3bafda;
    font-size: 13px;
    color: #384d48;
    letter-spacing: 1px;
    line-height: 30px;
    position: relative;
}

.tab .tab-content h3{
    font-size: 24px;
    margin-top: 0;
}
@media only screen and (max-width: 479px){
    .tab .nav-tabs li{
        width: 100%;
        text-align: center;
        margin-bottom: 15px;
    }
}

</style>

 
    <style type="text/css">
    .changeColorTitle {
    font-style:italic;
    color:#066da9;
}
</style>

<input type="hidden" name="hdnRstl" value="<?= $initialRegion ?>">
<input type="hidden" name="hdnType" value="<?= $currentType ?>">

<div class="tab-content tabs">
                <div role="tabpanel" class="tab-pane fade in" id="tabSamplesTable">
                        <div id="divSamplesTable">
                                <?=
                                GridView::widget([
                                    'dataProvider' => $dataTables,
                                    'summary' => "",
                                    'floatHeader' => true,
                                    'perfectScrollbar' => true,
                                    'headerRowOptions' => ['style' => 'text-align:center;'],
                                    'id' => 'gridAccSamples',
                                    // 'filterModel' => $searchModel,
                                    'beforeHeader' => [
                                        [
                                            'columns' => [
                                           //     ['content' => 'RSTL ID', 'options' => ['class' => 'text-center warning', 'style' => 'border-style: solid']],
                                                ['content' => 'REGION', 'options' => ['class' => 'text-center warning']],
                                                ['content' => 'OVERALL', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'OVERALL', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                                                ['content' => 'OVERALL', 'options' => ['colspan' => 1, 'class' => 'text-center warning']],
                                                ['content' => 'JANUARY', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'FEBRUARY', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'MARCH', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'APRIL', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'MAY', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'JUNE', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'JULY', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'AUGUST', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'SEPTEMBER', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'OCTOBER', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'NOVEMBER', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                ['content' => 'DECEMBER', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                            ],
                                            'options' => ['class' => 'skip-export'] // remove this row from export
                                        ]
                                    ],
                                    'columns' =>
                                    [
                                     //   [
                                    //        'attribute' => 'rstl_id',
                                    //        'label' => '',
                                     //       'vAlign' => 'right',
                                    //        'hAlign' => 'middle',
                                    //        'width' => '100px',
                                    //    ],
                                        [
                                            'attribute' => 'region',
                                            'label' => '',
                                            'vAlign' => 'right',
                                            'hAlign' => 'middle',
                                            'width' => '100px',
                                            
                                            
                                        ],
                                        [
                                            'attribute' => 'chem_all',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                            // 'format' => ['decimal',0]
                                     
                                        ],
                                        [
                                            'attribute' => 'micro_all',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'metro_all',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'chemmicro_all',
                                            'label' => 'Chem, Micro',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'all',
                                            'label' => 'Chem,Micro,Metro',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'janchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'janmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'janmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'febchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'febmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'febmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'marchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'marmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'marmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'aprchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'aprmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'aprmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'maychem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'maymicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'maymetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'junchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'junmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'junmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'julchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'julmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'julmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'augchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'augmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'augmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'sepchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'sepmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'sepmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'octchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'octmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'octmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'novchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'novmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'novmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'decchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'decmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                        [
                                            'attribute' => 'decmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px', // 'format' => ['decimal',0],
                                        ],
                                    ]
                                ]);
                                ?>
                            </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in active" id="tabSamplesChart">
                    <div class="row">
                        <div class="col-md-12">
                         <div id="divBarChartSamples" style="height: 90%">
                                  <?php
                                    echo Highcharts::widget([
                                        'id' => 'columnRstlAccomplishment',
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
                                        'options' => [
                                            'credits'=>false,
                                            'chart' => [
                                                'type' => 'column',
                                                'renderTo' => 'divBarChartSamples',
                                                'marginTop' => 100
                                            ],
                                            'title' => [
                                                'useHTML'=>true,
                                                'text' => '<div style="text-align:center;">' . 'Accomplishments for ' . '<br/><div class="changeColorTitle">' . $currentType .' on all regions for ' .$selectedYear . '</div></div>',
                   
                                            ],
                                            'xAxis' => [
                                               // 'categories'=>$listRstl,
                                               'categories' => ['Regional Standards Testing Laboratories'],
                                                'tickInterval'=>50,
                                            //   'type'=>'category',
                                                'title' => [
                                                    'text' => ''
                                                ],
                                                'labels'=>
                                                [
                                                     'style'=>[
                                                        'color'=>'#066da9',
                                                        'font-weight'=>'bold',
                                                        'font-size'=> 11
                                                    ],
                                                    // 'rotation'=> 45,
                                                ],
                                            ],
                                            'tooltip' => [
                                                'enabled' => false
                                            ],
                                            'yAxis' => [
                                                'min' => 0,
                                                'tickInterval'=>50,
                                                'title' => [
                                                    'text' => $currentType,
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
                                                'series'=>[ 'pointPadding'=>0, 
                                                            'groupPadding'=>0,
                                                            'pointWidth'=>50,
                                                            //'cursor'=>'pointer',
                                                           // 'point'=>
                                                            //          'events'=>[
                                                            //                    'click'=>new \yii\web\JsExpression("function(e){ alert('test'); }")
                                                            //                   ],   
                                                            //        ],
                                                          ],
                                                'column' => [
                                                    'dataLabels' => [
                                                        'enabled' => true,
                                                         'rotation'=> 0,
                                                          'formatter' => new JsExpression('function(){ return this.series.name; }'),
                                                          'pointWidth'=>10,
                                                      //  'categories' => $listRstl,
                                                  //      'formatter' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                                                    ]
                                                ]
                                            ],
                                             'legend' => [
                                                'enabled'=> false
                                            ],
                                            'series' => $dataBar,
                                           
                                        ]
                                    ]);
                                    ?>
                                </div>
                            
                           
                            
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <?php Pjax::begin(); ?>
                                    <?php
                                            echo $this->render('_subcolumnpie', ['listYear'=>$listYear,'listRstl'=>$listRstl,'listlab'=>$listlab,
                                                'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'listMonths'=>$listMonths,
                                                'initialRegion'=>$initialRegion,'curYearValue'=> $curYearValue,'selectedYear'=>$selectedYear,'currentType'=>$currentType,'monthCount'=>$monthCount]);
                                            ?>
                        <?php Pjax::end(); ?>
                       
                    </div>
            </div>

        </div>


