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


<div id="divTreeMapIndustry" style="height: 90%">hello
                                  <?php
                                    echo Highcharts::widget([
                                        'id' => 'industryMap',
                                        'scripts' => [
                                            'modules/exporting',
                                            'themes/grid-light',
                                        ],
                                        
                                        'options' => [
                                            'credits'=>false,
                                            'chart' => [
                                                'series'=>
                                                        [
                                                            'type' => 'treemap',
                                                            'renderTo' => 'divTreeMapIndustry',

                                                            'layoutAlgorithm'=> 'stripes',
                                                            'alternateStartingDirection'=> true,
                                                            'levels'=> 
                                                                            [
                                                                                    [
                                                                                    'level'=> 1,
                                                                                    'layoutAlgorithm'=> 'sliceAndDice',
                                                                                    'dataLabels'=> 
                                                                                            [
                                                                                            'enabled'=> true,
                                                                                            'align'=> 'left',
                                                                                            'verticalAlign'=> 'top',
                                                                                            'style'=> [
                                                                                                    'fontSize'=> '15px',
                                                                                                    'fontWeight'=> 'bold'
                                                                                                             ]
                                                                                            ]
                                                                                    ]
                                                                            ],
                                                            'data'=> [[
                                                                    'id'=> 'A',
                                                                    'name'=> 'Apples',
                                                                    'color'=> '#EC2500'
                                                                ], [
                                                                    'id'=> 'B',
                                                                    'name'=> 'Bananas',
                                                                    'color'=> '#ECE100'
                                                                ], [
                                                                    'id'=> 'O',
                                                                    'name'=> 'Oranges',
                                                                    'color'=> '#EC9800'
                                                                ], [
                                                                    'name'=> 'Anne',
                                                                    'parent'=> 'A',
                                                                    'value'=> 5
                                                                ], [
                                                                    'name'=> 'Rick',
                                                                    'parent'=> 'A',
                                                                    'value'=> 3
                                                                ], [
                                                                    'name'=> 'Peter',
                                                                    'parent'=> 'A',
                                                                    'value'=> 4
                                                                ], [
                                                                    'name'=> 'Anne',
                                                                    'parent'=> 'B',
                                                                    'value'=> 4
                                                                ], [
                                                                    'name'=> 'Rick',
                                                                    'parent'=> 'B',
                                                                    'value'=> 10
                                                                ], [
                                                                    'name'=> 'Peter',
                                                                    'parent'=> 'B',
                                                                    'value'=> 1
                                                                ], [
                                                                    'name'=> 'Anne',
                                                                    'parent'=> 'O',
                                                                    'value'=> 1
                                                                ], [
                                                                    'name'=> 'Rick',
                                                                    'parent'=> 'O',
                                                                    'value'=> 3
                                                                ], [
                                                                    'name'=> 'Peter',
                                                                    'parent'=> 'O',
                                                                    'value'=> 3
                                                                ], [
                                                                    'name'=> 'Susanne',
                                                                    'parent'=> 'Kiwi',
                                                                    'value'=> 2,
                                                                    'color'=> '#9EDE00'
                                                                ]]

                                                        ],
                                                ]
                                            
                                          
                                       
                                          
                                           
                                           
                                        ]
                                    ]);
                                    ?>
                                </div>