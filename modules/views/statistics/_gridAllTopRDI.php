<?php
use kartik\grid\GridView;
use yii\widgets\Pjax;

use kartik\select2\Select2;
use yii\helpers\Url;
?>


<div class="row">
    <div class="col-lg-4" style="text-align: left">
        <div class="box box-default">
            <div class="box-header with-border" style="background-color: #066da9;color:white">
                            <img src="/images/icons/incometrans.png" style="width:25px">
                            <h4 class="box-title">Fees/Transactions</h4>
                        </div>
            <div class="box-body"  >
                <div class="row">
                    <div class="col-md-8">
                    <?php
                                        echo Select2::widget([
                                            'name' => 'dropIncomeTran',
                                            'id' => 'dropIncomeTran',
                                            'value'=>0,
                                            'data' => $listIncomeTran,
                                            'options' => ['placeholder' => 'Select Laboratory'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                            
                                            'pluginEvents' => [
                                                            "change" => "function() {
                                                             
                                                                $.ajax({
                                                                  url: '".Url::toRoute("/toplevel/statistics/topdataretrieverdi")."',
                                                                 //   dataType: 'json',
                                                                    method: 'GET',
                                                                   data: {paramMode:$('#dropIncomeTran :selected').text(),paramYear:$('#dropYearTop10 :selected').text(),paramType:'IncomeTrans'},
                                                                  
                                                                    success: function (data, textStatus, jqXHR) {
                                                                      $('#gridIncomeTrans').html(data);
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
                    <div class="col-md-12" style="margin-top: 10px">
                                    <?php
                                        echo $this->render('_gridIncomeTrans', [ 'dataIncomeTrans' => $dataIncomeTrans]);
                                    ?>
                                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4" style="text-align: left"> 
     <div class="box box-default">
            <div class="box-header with-border" style="background-color: #066da9;color:white">
                            
                            <img src="/images/icons/customerfirms.png" style="width:25px">    
                            <h4 class="box-title">Customer/Firms</h4>
                        </div>
            <div class="box-body"  >
                 <div class="row">
                    <div class="col-md-8">
                    <?php
                                        echo Select2::widget([
                                            'name' => 'dropCustomerFirms',
                                            'id' => 'dropCustomerFirms',
                                            'value'=>0,
                                            'data' => $listCustomerFirms,
                                            'options' => ['placeholder' => 'Select Laboratory'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                            
                                            'pluginEvents' => [
                                                            "change" => "function() {
                                                           
                                                         
                                                                $.ajax({
                                                                  url: '".Url::toRoute("/toplevel/statistics/topdataretrieverdi")."',
                                                                 //   dataType: 'json',
                                                                    method: 'GET',
                                                                    data: {paramMode:$('#dropCustomerFirms :selected').text(),paramYear:$('#dropYearTop10 :selected').text(),paramType:'CustomerFirms'},
                                                                  
                                                                    success: function (data, textStatus, jqXHR) {
                                                                      $('#gridCustomerFirms').html(data);
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
                    <div class="col-md-12" style="margin-top: 10px">
                                    <?php
                                        echo $this->render('_gridCustomerFirms', [ 'dataCustomerFirms' => $dataCustomerFirms]);
                                    ?>
                                </div>
                </div>
            </div>
        </div>
     </div>
    <div class="col-lg-4" style="text-align: left">
        <div class="box box-default">
            <div class="box-header with-border" style="background-color: #066da9;color:white">
                            <img src="/images/icons/sampletests.png" style="width:25px">    
                            <h4 class="box-title">Sample/Tests</h4>
                        </div>
            <div class="box-body"  >
                 <div class="row">
                    <div class="col-md-8">
                    <?php
                                        echo Select2::widget([
                                            'name' => 'dropSampleTests',
                                            'id' => 'dropSampleTests',
                                            'value'=>0,
                                            'data' => $listSampleTests,
                                            'options' => ['placeholder' => 'Select Laboratory'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                            
                                            'pluginEvents' => [
                                                            "change" => "function() {
                                                           
                                                         
                                                                $.ajax({
                                                                  url: '".Url::toRoute("/toplevel/statistics/topdataretrieverdi")."',
                                                                 //   dataType: 'json',
                                                                    method: 'GET',
                                                                    data: {paramMode:$('#dropSampleTests :selected').text(),paramYear:$('#dropYearTop10 :selected').text(),paramType:'SampleTests'},
                                                                  
                                                                    success: function (data, textStatus, jqXHR) {
                                                                      $('#gridSampleTests').html(data);
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
                    <div class="col-md-12" style="margin-top: 10px">
                                    <?php
                                        echo $this->render('_gridSampleTests', [ 'dataSampleTests' => $dataSampleTests]);
                                    ?>
                                </div>
                </div>
            </div>
        </div>
    </div>
</div>

