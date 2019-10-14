<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Top Management', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = ['label' => 'Statistics Dashboard', 'url' => ['/toplevel/statistics/dashboard']];
$this->params['breadcrumbs'][] = 'Accomplishment - per RSTL/RDI'; // $this->title;
//var_dump(Yii::$app->user->identity->ismanagement)
//var_dump($arraySamplesRec);
//var_dump($arrayTestsRec);
//var_dump($arrayCustomerRec);
//var_dump(Yii::$app->user->identity->type);
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

    #verticalstripes
    {
        background-color: gray;
        background-image: linear-gradient(90deg, transparent 50%, rgba(255,255,255,.5) 50%);
        background-size: 50px 50px;
    }

    .changeColorTitle {
        font-style:italic;
        color:#066da9;


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
    <br>

   

    <div class="tab-content tabs">
        <div role="tabpanel" class="tab-pane fade in active" id="tabMainIndi">
            <div class="row">
                <div class="col-md-4">
                            <?php
                            echo Select2::widget([
                                'name' => 'dropIndicator',
                                'id' => 'dropIndicator',
                                'addon' => [
                                    'prepend' => [
                                        'content' => 'Indicator :'
                                    ],
                                ],
                                'data' => $listIndicator,
                                //'value' => 5,
                                // 'options' => ['placeholder' => 'Select Indicator'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                                'pluginEvents' => [
                                    "change" => "function() {

                                                                                                       var strIndicator = $('#dropIndicator').select2('data')[0]['text'];


                                                                                                            $.ajax({
                                                                                                                url: '" . Url::toRoute("/toplevel/statistics/linecolumnperrstl") . "',
                                                                                                             //   dataType: 'json',
                                                                                                                method: 'GET',
                                                                                                               data: {paramIndicator:strIndicator},

                                                                                                                success: function (data, textStatus, jqXHR) {


                                                                                                                 $('#divColumnPerRstl').html(data);

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
                
                <div id="divColumnPerRstl">
                
             
                        <?php Pjax::begin(); ?>
                        <?php
                        echo $this->render('_linecolumnperrstl', ['dataArrayYear' => $dataArrayYear, 'arrayLineRec' => $arrayLineRec, 'dataColumnGraph' => $dataColumnGraph, 'curIndicator' => $curIndicator,'listYear'=>$listYear,'listIndicatorAcc' => $listIndicatorAcc, 'dataAccomp' => $dataAccomp, 'dataTargets' => $dataTargets]);
                        ?>
                        <?php Pjax::end(); ?>
               
                
              </div>  
                
                
            </div>
            <br/>
            
        </div>

        <div role="tabpanel" class="tab-pane fade in" id="tabComparisonIndi">  
            

        </div>
    </div>








    <br>   <br>   <br>



