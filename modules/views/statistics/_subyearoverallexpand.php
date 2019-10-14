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
                <div role="tabpanel" class="tab-pane fade in active" id="tabRDIDataTable">
                        <div id="divOverallTable">
                               <?=
                                GridView::widget([
                                    'dataProvider' => $dataTables,
                                    'summary' => "",
                                    'floatHeader' => true,
                                    'perfectScrollbar' => true,
                                    'headerRowOptions' => ['style' => 'text-align:center;'],
                                    'id' => 'gridOverall',
                                    // 'filterModel' => $searchModel,
                                    'beforeHeader' => [
                                        [
                                            'columns' => [
                                                ['content' => 'Indicator', 'options' => ['class' => 'text-center warning', 'style' => 'border-style: solid']],
                                                ['content' => 'Total', 'options' => ['colspan' => 3,'class' => 'text-center warning']],
                                                 ['content' => 'RSTLs', 'options' => ['colspan' => 19,'class' => 'text-center warning']],
                                                 ['content' => 'RDIs', 'options' => ['colspan' => 6,'class' => 'text-center warning']],
                                          //      ['content' => 'FPRDI', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
                                                
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
                                            'width' => '500px',
                                        ],
                                        [
                                            'attribute' => 'total',
                                            'label' => 'Total Accomplishments',
                                            'vAlign' => 'right',
                                            'hAlign' => 'middle',
                                            'width' => '300px',
                                        ],
                                        [
                                            'attribute' => 'totalrstl',
                                            'label' => 'RSTL',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'totalrdi',
                                            'label' => 'RDIs',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        
                                        [
                                            'attribute' => 'region1',
                                            'label' => '1',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region2',
                                            'label' => '2',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region3',
                                            'label' => '3',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region4L1',
                                            'label' => '4A L1',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region4L2',
                                            'label' => '4A L2',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region4L3',
                                            'label' => '4A L3',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region4L4',
                                            'label' => '4A L4',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region5',
                                            'label' => '5',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region6',
                                            'label' => '6',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region7',
                                            'label' => '7',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region8',
                                            'label' => '8',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region9',
                                            'label' => '9',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region10',
                                            'label' => '10',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region11',
                                            'label' => '11',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'region12L1',
                                            'label' => '12 L1',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        
                                        [
                                            'attribute' => 'region12L2',
                                            'label' => '12 L2',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'caraga',
                                            'label' => 'CARAGA',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'car',
                                            'label' => 'CAR',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        [
                                            'attribute' => 'armm',
                                            'label' => 'ARMM',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        
                                         [
                                            'attribute' => 'itdi',
                                            'label' => 'ITDI',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        
                                         [
                                            'attribute' => 'fprdi',
                                            'label' => 'FPRDI',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                         [
                                            'attribute' => 'fnri',
                                            'label' => 'FNRI',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        
                                         [
                                            'attribute' => 'mirdc',
                                            'label' => 'MIRDC',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        
                                         [
                                            'attribute' => 'pnri',
                                            'label' => 'PNRI',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        
                                         [
                                            'attribute' => 'ptri',
                                            'label' => 'PTRI',
                                            'vAlign' => 'middle',
                                            'width' => '100px',
                                        ],
                                        
                                        
                                    ]
                                ]);
                                ?>
                            </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="tabRDIChart">
               <div class="row">
                                <div class="col-md-5" style="margin-left: 0px;margin-bottom: 10px;margin-top: 0px">
                                   <?php
                                    echo Select2::widget([
                                        'name' => 'dropIndicator',
                                        'id' => 'dropIndicator',
                                        'data' => $listIndicator,
                                        'addon'=>[
                                         'prepend' => [
                                                    'content' => 'Type :'
                                                ],
                                        ],
                                            
                                     //   'value' => $curYearValue,
                                      //  'options' => ['placeholder' => 'Select Year','text-align'=>'center'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        ],
                                        
                                        'pluginEvents' => [
                                            "change" => "function() {
                                                                            
                                                                            var strYear = $('#dropYear').select2('data')[0]['text'];
                                                                            var strType = $('#dropType').select2('data')[0]['text'];
                                                                            var strIndicator = $('#dropIndicator').select2('data')[0]['text'];
                                                                            var strTurn = $(\"[name='switchExpand']:checked\").val();
                                                                            
                                                                                $.ajax({
                                                                                    url: '" . Url::toRoute("/toplevel/statistics/subcolumnpieoverall") . "',
                                                                                 //   dataType: 'json',
                                                                                    method: 'GET',
                                                                                   data: {paramYear:strYear,paramType:strType,paramIndicator:strIndicator,paramTurn:strTurn},

                                                                                    success: function (data, textStatus, jqXHR) {

                                                                                     $('#divColumnPieOverall').html(data);
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
                    <div id="divColumnPieOverall">   
                     <?php Pjax::begin(); ?>
                                    <?php
                                      echo $this->render('_subcolumnpieoverall',[ 'dataColumnOverall'=>$dataColumnOverall,'dataPieOverall'=>$dataPieOverall,'listDost'=>$listDost,'listIndicator'=>$listIndicator,'dataPieOverall'=>$dataPieOverall,'curType'=>$curType,'curYear'=>$curYear,'curIndicator'=>$curIndicator,'pTurn'=>$pTurn]);
                                  ?>
                     <?php Pjax::end(); ?>
                    </div>
                   
                   
                   
            </div>

        </div>


