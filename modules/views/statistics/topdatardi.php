<?php

use kartik\select2\Select2;
use yii\helpers\Url;

/*
 * Project Name: Top_Management * 
 * Copyright(C)2019 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 01 30, 19 , 1:21:40 PM * 
 * Module: topdata * 
 */
$this->title = 'Ranking ( RDIs )';
$this->params['breadcrumbs'][] = ['label' => 'Top Management', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = ['label' => 'Statistics Dashboard', 'url' => ['/toplevel/statistics/dashboard']];
$this->params['breadcrumbs'][] = 'Ranking ( RDIs )'; // $this->title;

?>
<div class="row" style="padding-top:10px">
    <div class="col-md-1" style="text-align:center;vertical-align: middle;font-weight: bold;margin-top: 5px"> Select Year : </div>
    <div class="col-md-11" style="width: 200px;margin-left:-30px">
       <?php
        echo Select2::widget([
            'name' => 'dropYearTop10',
            'id' => 'dropYearTop10',
            'data' => $listYear,
            'value' => $curYearValue,
            'options' => ['placeholder' => 'Year'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
            'pluginEvents' => [
                "change" => "function() {
                                                            // var strYear = $('#dropYearTop10 :selected').text();
                                                           //  var strLab = $('#dropLabTop10 :selected').val();
                                                                
                                                                $.ajax({
                                                                    url: '" . Url::toRoute("/toplevel/statistics/topdatareloadrdi") . "',
                                                                 //   dataType: 'json',
                                                                    method: 'GET',
                                                                   data: {paramYear:$('#dropYearTop10 :selected').text()},
                                                                  
                                                                    success: function (data, textStatus, jqXHR) {
                                                                  //  alert(data.length);
                                                                    // var newD=data.split(", ");
                                                                    // $('#gridIncomeTrans').html([]);
                                                                    //  $('#gridIncomeTrans').html(newD[7]);
                                                                      // $('#gridCustomerFirms').html(data[7]);
                                                                      //    $('#gridSampleTests').html(data[8]);
                                                                        $('#divAllTopRDI').html(data);
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

    <!--
    <div class="col-md-8">
    <?php
    echo Select2::widget([
        'name' => 'dropLabTop10',
        'id' => 'dropLabTop10',
        'value' => 0,
        'data' => $listLab,
        'options' => ['placeholder' => 'Select Laboratory'],
        'pluginOptions' => [
            //     'templateResult' => new JsExpression('format'),
            //      'templateSelection' => new JsExpression('format'),
            //       'escapeMarkup' => $escape,
            'allowClear' => true
        ],
        'pluginEvents' => [
            "change" => "function() {
                                                             var strYear = $('#dropYearTop10 :selected').text();
                                                             var strLab = $('#dropLabTop10 :selected').val();
                                                           //    alert(strYear);
                                                           //    alert(strLab);
                                                                $.ajax({
                                                                    url: '" . Url::toRoute("/site/datatop") . "',
                                                                 //   dataType: 'json',
                                                                    method: 'GET',
                                                                   data: {syear:strYear,slab:strLab},
                                                                  
                                                                    success: function (data, textStatus, jqXHR) {
                                                                      $('#gridTop').html(data);
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
    
    -->

</div>

<br>

<div id="divAllTopRDI">
    <?php
    echo $this->render('_gridAllTopRDI', ['listIncomeTran' => $listIncomeTran, 'dataIncomeTrans' => $dataIncomeTrans, 'listCustomerFirms' => $listCustomerFirms,
        'dataCustomerFirms' => $dataCustomerFirms, 'listSampleTests' => $listSampleTests, 'dataSampleTests' => $dataSampleTests]);
    ?>

</div>
<?php

/* 
 * Project Name: Top_Management * 
 * Copyright(C)2019 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 02 1, 19 , 1:34:30 PM * 
 * Module: topdatardi * 
 */

