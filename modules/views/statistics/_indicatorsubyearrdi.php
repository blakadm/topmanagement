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


 <div class="row">
                        <div class="col-md-6">
                            
                            
                            <div class="row">
                                <div id="divBarRdi" style="height: 700px">
                                    <?php
                                    echo Highcharts::widget([
                                        'id' => 'bargraphSamples',
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
                                                'renderTo' => 'divBarRdi',
                                                'marginTop' => 100
                                            ],
                                            'title' => [
                                                'useHTML'=>true,
                                                 'text' => '<div style="text-align:center;">' . 'Comparison of key performance indicators for ' . '<br/><div class="changeColorTitle">' . $CurrentIndicator .' on all RDI`s for year : ' . $selectedYear . '</div></div>',
                                            ],
                                            'xAxis' => [
                                               // 'categories'=>$listRstl,
                                               'categories' => ['Research Development Institutes'],
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
                                                        'font-size'=> 15
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
                                                    'text' => $CurrentIndicator,
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
                                                'series'=>[ 'pointPadding'=>0, 'groupPadding'=>0,'pointWidth'=>50],
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
                                            'series' => $dataBarGraph,
                                           
                                        ]
                                    ]);
                                    ?>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div id="divColumnPieGraph" class="col-md-12">
                                   <div id="divColumnPieRDI">
                                   <?php Pjax::begin(); ?>
                                    <?php
                                           echo $this->render('_subcolumnpierdi', ['dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'listMonths'=>$listMonths,'CurrentIndicator'=>$CurrentIndicator,'selectedYear'=>$selectedYear,'currentRDI'=>$currentRDI,'monthCount'=>$monthCount]);
                                            ?>
                                  <?php Pjax::end(); ?>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>




