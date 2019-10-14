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



<div class="tab-content tabs">
                <div role="tabpanel" class="tab-pane fade in" id="tabRDIDataTable">
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
                                                ['content' => 'Indicator', 'options' => ['class' => 'text-center warning', 'style' => 'border-style: solid']],
                                                ['content' => 'ITDI', 'options' => ['class' => 'text-left warning']],
                                                ['content' => 'FPRDI', 'options' => ['class' => 'text-left warning']],
                                                ['content' => 'FNRI', 'options' => [ 'class' => 'text-left warning']],
                                                ['content' => 'MIRDC', 'options' => ['class' => 'text-left warning']],
                                                ['content' => 'PNRI', 'options' => [ 'class' => 'text-left warning']],
                                                ['content' => 'PTRI', 'options' => ['class' => 'text-left warning']],
                                                
                                            ],
                                            'options' => ['class' => 'skip-export'] // remove this row from export
                                        ]
                                    ],
                                    'columns' =>
                                    [
                                        [
                                            'attribute' => 'indicator_desc',
                                            'label' => '',
                                            'vAlign' => 'right',
                                            'hAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'itdiall',
                                            'label' => '',
                                            'vAlign' => 'middle',
                                            'hAlign' => 'middle',
                                            'width' => '100px',
                                            
                                        ],
                                        [
                                            'attribute' => 'fpall',
                                            'label' => '',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'fnall',
                                            'label' => '',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'mirall',
                                            'label' => '',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'pnall',
                                            'label' => '',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'ptall',
                                            'label' => '',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        
                                    ]
                                ]);
                                ?>
                            </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in active" id="tabRDIChart">
                    
                    <div class="row">
                       <div class="col-md-6">
                                <?php
                                            echo Select2::widget([
                                                'name' => 'dropIndicator',
                                                'id' => 'dropIndicator',
                                                'addon'=>[
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
                                                                           var strYear = $('#dropYear').select2('data')[0]['text'];
                                                                           var strIndicator = $('#dropIndicator').select2('data')[0]['text'];
                                                                           var strRDI = $('#dropRDI').select2('data')[0]['text'];
                                                                          //  var test = $('input[name=hdnRstl]:hidden');
                                                                         //   test.val(strRstl);
                                                                            //   alert('The value of hidden input is: ' + test.val())
                                                                                

                                                                                $.ajax({
                                                                                    url: '" . Url::toRoute("/toplevel/statistics/indicatorsubyearrdi") . "',
                                                                                 //   dataType: 'json',
                                                                                    method: 'GET',
                                                                                   data: {paramYear:strYear,paramIndicator:strIndicator,paramRDI:strRDI},

                                                                                    success: function (data, textStatus, jqXHR) {
                                                                                     
                                                                                  
                                                                                     $('#divIndicator').html(data);
                                                                                    
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
                       <div class="col-md-6">
                                            <?php
                                                    echo Select2::widget([
                                                        'name' => 'dropRDI',
                                                        'id' => 'dropRDI',
                                                        'data' => $listRDI,
                                                        'addon'=>[
                                                         'prepend' => [
                                                                    'content' => "RDI's :"
                                                                ],
                                                        ],

                                                        'value' => $currentRDI,
                                                      //  'options' => ['placeholder' => 'Select Year','text-align'=>'center'],
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                        ],
                                                        'pluginEvents' => [
                                                            "change" => "function() {

                                                                                            var strYear = $('#dropYear').select2('data')[0]['text'];
                                                                                            var strIndicator = $('#dropIndicator').select2('data')[0]['text'];
                                                                                            var strRDI = $('#dropRDI').select2('data')[0]['text'];
                                                                                            
                                                                                         //   var strHdnType = $('input[name=hdnType]:hidden').val();
                                                                                         //   alert(strHdnType);

                                                                                                $.ajax({
                                                                                                    url: '" . Url::toRoute("/toplevel/statistics/subcolumnpierdi") . "',
                                                                                                 //   dataType: 'json',
                                                                                                    method: 'GET',
                                                                                                  data: {paramYear:strYear,paramIndicator:strIndicator,paramRDI:strRDI},

                                                                                                    success: function (data, textStatus, jqXHR) {

                                                                                                     $('#divColumnPieRDI').html(data);
                                                                                                   //  $('#liChart').removeClass('active');
                                                                                                   //  $('#liMain').addClass('active');
                                                                                                  //   $('#tabSamplesTable').tab('show');


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
                   
                    <div id="divIndicator">
                        <?php Pjax::begin(); ?>
                                    <?php
                                           echo $this->render('_indicatorsubyearrdi', ['dataBarGraph'=>$dataBarGraph,'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'listMonths'=>$listMonths,'listIndicator'=>$listIndicator,'CurrentIndicator'=>$CurrentIndicator,'selectedYear'=>$selectedYear,'currentRDI'=>$currentRDI,'monthCount'=>$monthCount]);
                                            ?>
                                  <?php Pjax::end(); ?>
                    </div>
                   
            </div>

        </div>


