<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\helpers\Html;
use kartik\widgets\SwitchInput;

$this->params['breadcrumbs'][] = ['label' => 'Top Management', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = ['label' => 'Statistics Dashboard', 'url' => ['/toplevel/statistics/dashboard']];
$this->params['breadcrumbs'][] = 'Overall Accomplishment'; // $this->title;


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

</style>




<div class="row">
    <div class="col-md-12">
        <div class="tab" role="tabpanel">

            <ul class="nav nav-tabs" role="tablist">
                
                
                <li class="">  
                    <div style="margin-left: 0px;margin-right: 10px;margin-bottom: 10px;margin-top: 10px;width:200px;">
                                  <?php
                                    echo Select2::widget([
                                        'name' => 'dropYear',
                                        'id' => 'dropYear',
                                        'data' => $listYear,
                                        'addon'=>[
                                         'prepend' => [
                                                    'content' => 'Select Year :'
                                                ],
                                        ],
                                            
                                       'value' => $yearIndex,
                                      //  'options' => ['placeholder' => 'Select Year','text-align'=>'center'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        ],
                                        'pluginEvents' => [
                                            "change" => "function() {
                                                                            
                                                                            var strYear = $('#dropYear').select2('data')[0]['text'];
                                                                          //  var strHdnType = $('input[name=hdnType]:hidden').val();
                                                                        //    var strType = $('#dropType').select2('data')[0]['text'];
                                                                            var strTurn = $(\"[name='switchExpand']:checked\").val();
                                                                            
                                                                                $.ajax({
                                                                                    url: '" . Url::toRoute("/toplevel/statistics/subyearoverall") . "',
                                                                                 //   dataType: 'json',
                                                                                    method: 'GET',
                                                                                   data: {paramYear:strYear,paramTurn:strTurn},

                                                                                    success: function (data, textStatus, jqXHR) {

                                                                                     $('#divAllOverall').html(data);
                                                                                     $('#liChart').removeClass('active');
                                                                                     $('#liMain').addClass('active');
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
                </li>

                <li class="" id="liMain"><a href="#tabRDIDataTable" data-toggle="tab" aria-expanded="false">Main</a></li>
                <li class="active" id="liChart"><a href="#tabRDIChart" data-toggle="tab" aria-expanded="false">Charts</a></li>
                
                <li class="">
                    <label class="control-label" style="font-size:12px">Expand/Group (Region 4A/12)</label>
                    <?php
                     echo SwitchInput::widget([
                        'name' => 'switchExpand',
                     //   'type' => SwitchInput::CHECKBOX,
                        'pluginOptions' => [
                            'onText' => 'Expand',
                            'offText' => 'Group',
                            'animate' => false,
                            'size' => 'mini',
                            'onColor' => 'success',
                            'offColor' => 'success',
                        ],
                         'pluginEvents'=> [
                             'switchChange.bootstrapSwitch' => "function() {
                                                                            
                                                                            var strYear = $('#dropYear').select2('data')[0]['text'];
                                                                          //  var strType = $('#dropType').select2('data')[0]['text'];
                                                                            var strTurn = $(\"[name='switchExpand']:checked\").val();
                                                                            
                                                                                $.ajax({
                                                                                    url: '" . Url::toRoute("/toplevel/statistics/subyearoverall") . "',
                                                                                 //   dataType: 'json',
                                                                                    method: 'GET',
                                                                                   data: {paramYear:strYear,paramTurn:strTurn},

                                                                                    success: function (data, textStatus, jqXHR) {

                                                                                     $('#divAllOverall').html(data);
                                                                                     $('#liChart').removeClass('active');
                                                                                     $('#liMain').addClass('active');
                                                                                  //   $('#tabSamplesTable').tab('show');
                                                                                     
                                                                                   },
                                                                                    beforeSend: function (xhr) {
                                                                                        //alert('Please wait...');
                                                                                        $('.image-loader').addClass( \"img-loader\" );
                                                                                    },

                                                                                });
                                                                            }",
                             ]
                    ]);
                    ?>
                   
                </li>
            </ul>
           
             
            <div id="divAllOverall">
                    <?php Pjax::begin(); ?>
                <?php
                  echo $this->render('_subyearoverall',['dataTables'=>$dataTables,'dataColumnOverall'=>$dataColumnOverall,'dataPieOverall'=>$dataPieOverall,'listDost'=>$listDost,'listIndicator'=>$listIndicator,'curType'=>$curType,'curYear'=>$curYear,'curIndicator'=>$curIndicator,'pTurn'=>$pTurn,'dataLineArray'=>$dataLineArray,'labType'=>$labType,'listCluster'=>$listCluster,'pCluster'=>'North Luzon','listYearLine'=>$listYearLine,'yearmode'=>$yearmode]);
              ?>
                    <?php Pjax::end(); ?>
            </div>
    </div>

</div>
    
</div>