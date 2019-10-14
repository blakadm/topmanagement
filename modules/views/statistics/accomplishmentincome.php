<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;


$this->params['breadcrumbs'][] = ['label' => 'Top Management', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = ['label' => 'Statistics Dashboard', 'url' => ['/toplevel/data/statistics']];
$this->params['breadcrumbs'][] = 'Accomplishments - Income'; // $this->title;

?>

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
    background: #066da9;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    text-transform: uppercase;
    border: none;
    border-top: 3px solid #066da9;
    border-bottom: 3px solid #066da9;
    border-radius: 0;
    overflow: hidden;
    position: relative;
    transition: all 0.3s ease 0s;
}
.tab .nav-tabs li.active a,
.tab .nav-tabs li a:hover{
    border: none;
    border-top: 3px solid #066da9;
    border-bottom: 3px solid #066da9;
    background: #fff;
    color: #066da9;
}
.tab .nav-tabs li a:before{
    content: "";
    border-top: 15px solid #066da9;
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
    border-bottom: 15px solid #066da9;
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
    border-top: 3px solid #066da9;
    border-bottom: 3px solid #066da9;
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
        .tab .tab-content {
    padding: 20px 30px;
    /* border-top: 3px solid #066da9; */
    /* border-bottom: 3px solid #066da9; */
    font-size: 13px;
    color: #384d48;
    letter-spacing: 1px;
    line-height: 30px;
    position: relative;
}
    </style>
    
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
    
    
    <div class="row">
        <div class="col-md-12">
        <div class="tab" role="tabpanel">

            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tabSamplesTable" data-toggle="tab" aria-expanded="false">Main</a></li>
                <li class=""><a href="#tabSamplesColumn" data-toggle="tab" aria-expanded="false">By Region</a></li>
                <li class=""><a href="#tabSamplesPie" data-toggle="tab" aria-expanded="false">All Regions</a></li>
                

            </ul>
            <div class="tab-content tabs">

                <div role="tabpanel" class="tab-pane fade in active" id="tabSamplesTable">
                     <?=
                                      GridView::widget([
                                        'dataProvider' => $dataAccFees,
                                        'summary' => "",
                                       'floatHeader'=>true,
                                     
                                        'perfectScrollbar'=>true,
                                         'headerRowOptions' => ['style' => 'text-align:center;'],
                                        'id'=>'gridAccFees',
                                        // 'filterModel' => $searchModel,
                                            'beforeHeader'=>[
                                                [
                                                    'columns'=>[
                                                        ['content'=>'RSTL ID', 'options'=>['class'=>'text-center warning']], 
                                                        ['content'=>'REGION', 'options'=>[ 'class'=>'text-center warning']], 
                                                        ['content'=>'OVERALL', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
                                                        ['content'=>'OVERALL', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
                                                        ['content'=>'OVERALL', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
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
                                                'attribute' => 'chem_all', 
                                                'label'=>'Chemical',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'micro_all', 
                                                'label'=>'Microbiology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'metro_all', 
                                                'label'=>'Metrology',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                             [
                                                'attribute' => 'chemmicro_all', 
                                                'label'=>'Chem, Micro',
                                                'vAlign' => 'middle',
                                                'width' => '100px',
                                            ],
                                            [
                                                'attribute' => 'all', 
                                                'label'=>'Chem,Micro,Metro',
                                                'vAlign' => 'middle',
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
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="tabSamplesColumn">
                      <div class="row">
                    <div id="divColumnChartFees" class="col-md-12" >
                                                <?php
                                                echo Highcharts::widget([
                                                    'id' => 'labColumnChart',
                                                    'scripts' => [
                                                        'modules/exporting',
                                                        'themes/grid-light',
                                                    ],
                                                    'options' => [
                                                      'lang'=> [
                                                    'thousandsSep'=>','
                                                             ],
                                                        'title' => [
                                                            'text' => 'Income',
                                                        ],
                                                        'chart' => [
                                                            'renderTo' => 'divColumnChartFees'],
                                                        'xAxis' => [
                                                            'title' => [
                                                                'text' => 'Year'
                                                            ],
                                                            'categories' => $listRstl,
                                                        ],
                                                        'yAxis' => [
                                                            'title' => [
                                                                'text' => 'Amount'
                                                            ]
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
                                                        'series' => $dataGraphFees
                                                    ]
                                                ]);
                                                ?>
                                        </div>
                          </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="tabSamplesPie">
                    <div class="row">
                    <div id="divPieChart" class="col-md-10">        
                                                            <?php
                                                            echo Highcharts::widget([
                                                                'id' => 'samplesPieChart',
                                                                'scripts' => [
                                                                    'modules/exporting',
                                                                    'themes/grid-light',
                                                                ],
                                                                
                                                                'options' => [
                                                                    'chart' => [
                                                                        'type' => 'pie',
                                                                     'renderTo'=>'divPieChart',
                                                                    ],
                                                                    'title' => [
                                                                        'text' => 'Testing/Calibration Services Rendered by Lab - ' . 2018,
                                                                    ],
                                                                    'credits' => false,
                                                                    'legend'=> [
                                                                            'layout'=> 'vertical',
                                                                            'align'=> 'right',
                                                                            'verticalAlign'=> 'top',
                                                                            'x'=> -100,
                                                                            'y'=> 40,
                                                                            'floating'=> true,
                                                                            'borderWidth'=> 1,
                                                                        
                                                                         ],
                                                                    'labels' => [
                                                                        'items' => [
                                                                            [
                                                                                'html' => '',
                                                                                'style' => [
                                                                                    'left' => '50px',
                                                                                    'top' => '18px',
                                                                                    'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                                                                                ],
                                                                            ],
                                                                        ],
                                                                    ],
                                                                    'series' => [
                                                                        [
                                                                            'name' => 'Total consumption',
                                                                            'data' => $dataGraphPie,
                                                                            'size' => '100%',
                                                                            'showInLegend' => true,
                                                                            'dataLabels' => [
                                                                                'enabled' => false,
                                                                                'format'=> '<b>{point.name}</b> : {point.y}',
                                                                                'useHTML'=> true,
                                                                            ],
                                                                        ],
                                                                    ],
                                                                ]
                                                            ]);
                                                            ?>  
                                                            </div>
                     </div>
                </div>
                
                
            </div>
            
        </div>
            
        </div>
    </div>