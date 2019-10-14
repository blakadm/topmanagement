<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;

/*
 * Project Name: Top_Management * 
 * Copyright(C)2019 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 02 11, 19 , 1:35:06 PM * 
 * Module: _target * 
 */
//echo $sampleDataTarget;
?>

<script>

    $(document).ready(function () {

        var toggle = document.getElementById("toggle");
        var content = document.getElementById("content");

        toggle.addEventListener("click", function () {
            content.classList.toggle("appear");
        });
    });

</script>

<style type="text/css">
    #content{
        /* DON'T USE DISPLAY NONE/BLOCK! Instead: */
        background: #cf5;
        padding: 10px;
        position: absolute;
        visibility: hidden;
        opacity: 0;
        transition: 0.6s;
        -webkit-transition: 0.6s;
        transform: translateX(-100%);
        -webkit-transform: translateX(-100%);
    }
    #content.appear{
        visibility: visible;
        opacity: 1;
        transform: translateX(0);
        -webkit-transform: translateX(0);

        #content{
            /* DON'T USE DISPLAY NONE/BLOCK! Instead: */
            background: #cf5;
            padding: 10px;
            position: absolute;
            visibility: hidden;
            opacity: 0;
            transition: 0.6s;
            -webkit-transition: 0.6s;
            transform: translateX(-100%);
            -webkit-transform: translateX(-100%);
        }
        #content.appear{
            visibility: visible;
            opacity: 1;
            transform: translateX(0);
            -webkit-transform: translateX(0);
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


    <div class="col-md-12">
        <div class="tab" role="tabpanel">

            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tabMainData" data-toggle="tab" aria-expanded="false">Main</a></li>
                <li class=""><a href="#tabSamplesData" data-toggle="tab" aria-expanded="false">Samples</a></li>
                <li class=""><a href="#tabTestsData" data-toggle="tab" aria-expanded="false">Tests</a></li>
                <li class=""><a href="#tabCustomersData" data-toggle="tab" aria-expanded="true">Customers</a></li>
                <li class=""><a href="#tabNewCustomersData" data-toggle="tab" aria-expanded="true">New Customers</a></li>
                <li class=""><a href="#tabFirmsData" data-toggle="tab" aria-expanded="true">Firms</a></li>
                <li class=""><a href="#tabFeesData" data-toggle="tab" aria-expanded="true">Fees</a></li>

                <li class=""><a href="#tabDock" data-toggle="tab" aria-expanded="true">Dock</a></li>

            </ul>

            <div class="tab-content tabs">

                <div role="tabpanel" class="tab-pane fade in active" id="tabMainData">

                </div>
                <div role="tabpanel" class="tab-pane" id="tabSamplesData" style="border-top: 3px none #066da9;border-bottom: 3px none #066da9;">
                    <div class="row">
                        <div class="col-md-12">

                            <div>
                                <?=
                                GridView::widget([
                                    'dataProvider' => $dataAccSamples,
                                    'summary' => "",
                                    'floatHeader' => true,
                                    'perfectScrollbar' => true,
                                    'headerRowOptions' => ['style' => 'text-align:center;'],
                                    'id' => 'gridAccSamples',
                                    // 'filterModel' => $searchModel,
                                    'beforeHeader' => [
                                        [
                                            'columns' => [
                                                ['content' => 'RSTL ID', 'options' => ['class' => 'text-center warning', 'style' => 'border-style: solid']],
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
                                        [
                                            'attribute' => 'rstl_id',
                                            'label' => '',
                                            'vAlign' => 'right',
                                            'hAlign' => 'middle',
                                            'width' => '100px',
                                        ],
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
                                        ],
                                        [
                                            'attribute' => 'micro_all',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'metro_all',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'chemmicro_all',
                                            'label' => 'Chem, Micro',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'all',
                                            'label' => 'Chem,Micro,Metro',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'janchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'janmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'janmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'febchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'febmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'febmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'marchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'marmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'marmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'aprchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'aprmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'aprmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'maychem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'maymicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'maymetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'junchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'junmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'junmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'julchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'julmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'julmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'augchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'augmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'augmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'sepchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'sepmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'sepmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'octchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'octmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'octmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'novchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'novmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'novmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'decchem',
                                            'label' => 'Chemical',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'decmicro',
                                            'label' => 'Microbiology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'decmetro',
                                            'label' => 'Metrology',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                    ]
                                ]);
                                ?>
                            </div>

                            <button type="button" id="toggle" class="btn btn-outline-primary">Show Graph</button>    
                        </div>
                        <div id="content"  style="z-index: 1000;
                             margin: 0 auto;
                             position:absolute;
                             top:0;
                             right:0;
                             left:0;
                             margin-top:100px;
                             width: 83%;
                             height: 80%;
                             background-color: #ffffff;
                             border-radius: 5px;">

                            <div class="col-md-12">

                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#tabSamplesColumnChart" data-toggle="tab" aria-expanded="false">By Region</a></li>
                                    <li class=""><a href="#tabSamplesPieChart" data-toggle="tab" aria-expanded="false">All Regions</a></li>
                                </ul>

                                <div class="tab-content tabs">
                                    <div role="tabpanel" class="tab-pane active" id="tabSamplesColumnChart">
                                        <div class="row">
                                            <div id="divColumnChartSamples" class="col-md-12" >
                                                <?php
                                                echo Highcharts::widget([
                                                    'id' => 'labColumnChart',
                                                    'scripts' => [
                                                        'modules/exporting',
                                                        'themes/grid-light',
                                                    ],
                                                    'options' => [
                                                      
                                                        'title' => [
                                                            'text' => 'Firms Assisted',
                                                        ],
                                                        'chart' => [
                                                            'renderTo' => 'divColumnChartSamples'],
                                                        'xAxis' => [
                                                            'title' => [
                                                                'text' => 'Year'
                                                            ],
                                                            'categories' => $listRstl,
                                                        ],
                                                        'yAxis' => [
                                                            'title' => [
                                                                'text' => 'No of Firms'
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
                                                        'series' => $dataGraphSamples
                                                    ]
                                                ]);
                                                ?>
                                        </div>
                                        </div>
                                        
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade in" id="tabSamplesPieChart">

                                    </div>
                                </div>


                            </div>                         
                        </div>

                    </div>
                </div>




            </div>
        </div>
    </div>


