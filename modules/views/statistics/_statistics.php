<?php
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
/* 
 * Project Name: onelab.gov.ph * 
 * Copyright(C)2018 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 02 14, 18 , 2:24:23 PM * 
 * Module: _statistics * 
 */
echo Html::hiddenInput("RegionID", $Stat->RegionID, ['id' => 'RegionID']);
echo Html::hiddenInput("AgencyID", $Stat->AgencyID, ['id' => 'AgencyID']);
echo Html::hiddenInput("ChartType", $Stat->ChartType, ['id' => 'ChartType']);
echo Html::hiddenInput("fYear", $Stat->Year, ['id' => 'fYear']);
echo Html::hiddenInput("fYear2", $Stat->Year2, ['id' => 'fYear2']);
echo Html::hiddenInput("labID", $Stat->LabID, ['id' => 'LabID']);
echo Html::hiddenInput("Frequency", $Stat->Frequency, ['id' => 'Frequency']);
echo Html::hiddenInput("Frequency_id", $Stat->FrequencyID, ['id' => 'Frequency_id']);
echo Html::hiddenInput("Theme", $Stat->theme, ['id' => 'Theme']);
echo Html::hiddenInput("highchart_theme_id", $Stat->highchart_theme_id, ['id' => 'highchart_theme_id']);
echo Html::hiddenInput("PaymentTypeID", $Stat->PaymentTypeID, ['id' => 'PaymentTypeID']);
echo Html::hiddenInput("ReferralTypeAmount", $Stat->ReferralTypeAmount, ['id' => 'ReferralTypeAmount']);
if(isset($Stat->ReferralType)){
    echo Html::hiddenInput("ReferralType", $Stat->ReferralType, ['id' => 'ReferralType']);
}
if(isset($Stat->FeeTypeID)){
    echo Html::hiddenInput("FeeTypeID", $Stat->FeeTypeID, ['id' => 'FeeTypeID']);
    echo Html::hiddenInput("FeeType", $Stat->FeeType, ['id' => 'FeeType']);
}
$cs=<<<CS
    .referral-progress{
      height: 80px;
      position: relative;
      margin-left: 50%;
      margin-top: 150px    
    }
    .referral-div{
      width: 100%;
      height: 100%;
      z-index: 1000;
      position: absolute;
      display: block
    }
CS;
$this->registerCss($cs);
$js=<<<SCRIPT
var series;
var IsHide=false;
    
function ajaxChart(){
    ShowProgress();
    $("#form").submit();
}
function ShowProgress(df){
    if(df==null){
        df=true;
    }
    if(df){
        $("#progress-div").show();
        $("#progress-report").show(); 
    }else{
        $("#progress-div").hide();
        $("#progress-report").hide();
    }
}
function InitiateIteration() {
    ShowProgress(true);
    IsHide = !IsHide;
    series = highChart_$id.series;
    var tot = series.length;
    IterateSeries(tot);
}
function IterateSeries(Tot) {
    var i = 0;
    ShowProgress(true);
    var myVar = setInterval(function () {
        if (IsHide) {
            series[i].hide();
        } else {
            series[i].show();
        }
        $("#progress-report").html("Hiding Series " + series[i].name + "...");
        i = i + 1;
        if (i >= Tot) {
            clearInterval(myVar);
            $("#progress-div").hide();
            $("#progress-report").hide();
            if (IsHide) {
                $("#btnCaption").html("Show All");
            } else {
                $("#btnCaption").html("Hide All");
            }
        }
    }, 0);
}
    $("#chkPaymentTypeID").change(function(){
         $("#PaymentTypeID").val(this.checked ? 1 : 0);
         ajaxChart();
    })   
SCRIPT;
$this->registerJs($js);
?>
<div id="progress-div" style="display: none" class="referral-div">
    <img src="/images/ajax-loader.gif" class="referral-progress" alt=""/>
</div>
<div class="col-lg-2 box-blue" style="padding-bottom: 18px">
    <div class="row" style="padding-left: 5px;padding-right: 5px;padding-bottom: 10px">
        <label class="text-green">Region:</label>&nbsp;
        <label class="text-green"><?php echo Html::checkbox("chkPaymentTypeID", $Stat->PaymentTypeID,['id'=>'chkPaymentTypeID']) ?> Paid</label>
        <?php
        $SQL = "(SELECT -1 AS `id`, 'Sum of All Regions' AS `reg_desc`) UNION ALL ";
        $SQL .= "(SELECT 0 AS `id`, 'All Regions' AS `reg_desc`) UNION ALL ";
        $SQL .= "(SELECT `region_id` as `id`, `reg_desc` FROM `eulims_address`.`tbl_region` ORDER BY `reg_desc`)";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($SQL);
        $data = ArrayHelper::map($command->queryAll(), 'id', 'reg_desc');
        echo Select2::widget([
            'name' => 'Region',
            'value' => $Stat->RegionID,
            'size' => 'sm',
            'data' => $data,
            'options' => ['multiple' => false, 'placeholder' => 'Select Region'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").val();
                   $("#RegionID").val(value);
                   ajaxChart();
                }
            ']
        ]);
        ?>
    </div>
    <div class="row" style="padding-left: 5px;padding-right: 5px;padding-bottom: 10px">
        <label class="text-green">Agency:</label>
        <?php
        echo Select2::widget([
            'name' => 'Agency',
            'value' => $Stat->Agency,
            'data' => $Stat->RSTLData,
            'size' => 'sm',
            'options' => ['multiple' => false, 'placeholder' => 'Select Agency'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").val();
                   $("#AgencyID").val(value);
                   ajaxChart();
                }
            ']
        ]);
        ?>
    </div>
    <div class="row" style="padding-left: 5px;padding-right: 5px;padding-bottom: 10px">
        <label class="text-green">Laboratories:</label>
        <?php
        echo Select2::widget([
            'name' => 'Laboratories',
            'value' => $Stat->LabID,
            'size' => 'sm',
            'data' => $Stat->LabData,
            'options' => ['multiple' => false, 'placeholder' => 'Select Laboratory'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").val();
                   $("#LabID").val(value);
                   ajaxChart();
                }
            ']
        ]);
        ?>
    </div>
    <div class="row" style="padding-left: 5px;padding-right: 5px">
        <label class="text-green">ChartType:</label>    
        <?php
        echo Select2::widget([
            'name' => 'ChartTypeID',
            'value' => $Stat->ChartTypeID,
            'size' => 'sm',
            'data' => [
                0 => 'Select Chart',
                1 => 'Line',
                2 => 'Bar',
                3 => 'Column',
                4 => 'Area',
                5 => 'spline'
            ],
            'options' => ['multiple' => false, 'placeholder' => 'Select Chart'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").text();
                   $("#ChartType").val(value);
                   ajaxChart();
                }
            ']
        ]);
        ?>
    </div>
    <div class="row" style="padding-left: 5px;padding-right: 5px">
        <label class="text-green">Quarter:</label>    
        <?php
        echo Select2::widget([
            'name' => 'FrequencyID',
            'value' => $Stat->FrequencyID,
            'size' => 'sm',
            'data' => [
                0 => 'All Quarters',
                1 => 'First Quarter',
                2 => 'Second Quarter',
                3 => 'Third Quarter',
                4 => 'Fourth Quarter',
                5 => 'Years'
            ],
            'options' => ['multiple' => false, 'placeholder' => 'Select Frequency'],
            'pluginEvents' => ['change' => '
                function(e){
                   var valueText = $(e.currentTarget).find("option:selected").text();
                   var value = $(e.currentTarget).find("option:selected").val();
                   $("#Frequency").val(valueText);
                   $("#Frequency_id").val(value);
                   ajaxChart();
                }
            ']
        ]);
        ?>
    </div>
    <div class="row" style="padding-left: 5px;padding-right: 5px">
        <label class="text-green">Year:</label>
        <div class="input-group">
            <?php
            $StartYear = 2013;
            $CurYear = (int) date("Y") + 1;
            $Proc = "CALL spGenerateYears(:StartYear,:EndYear)";
            $conn = Yii::$app->db;
            $comm = $conn->createCommand($Proc);
            $comm->bindParam("StartYear", $StartYear);
            $comm->bindParam("EndYear", $CurYear);
            $YearData = ArrayHelper::map($comm->queryAll(), 'Year', 'Year');
            echo Select2::widget([
                'name' => 'FrequencyYear',
                'id' => 'FrequencyYear',
                'value' => $Stat->Year,
                'size' => 'sm',
                'data' => $YearData,
                'options' => ['multiple' => false, 'placeholder' => 'Select Year'],
                'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").val();
                   $("#fYear").val(value);
                   ajaxChart();
                }
            ']
            ]);
            ?>
            <?php
            if ($Stat->FrequencyID == 5) {
                $DisplayYearRange = '';
            } else {
                $DisplayYearRange = 'style="display: none"';
            }
            ?>
            <span class="input-group-addon" <?= $DisplayYearRange ?>>-</span>
            <div <?= $DisplayYearRange ?>> 
                <?php
                $_StartYear = 2013;
                $_CurYear = (int) date("Y") + 2;
                $_Proc = "CALL spGenerateYears(:StartYear,:EndYear)";
                $con = Yii::$app->db;
                $com = $con->createCommand($_Proc);
                $com->bindParam("StartYear", $_StartYear);
                $com->bindParam("EndYear", $_CurYear);
                $_YearData = ArrayHelper::map($com->queryAll(), 'Year', 'Year');
                echo Select2::widget([
                    'name' => 'FrequencyYear2',
                    'id' => 'FrequencyYear2',
                    'value' => $Stat->Year2,
                    'size' => 'sm',
                    'data' => $_YearData,
                    'options' => ['multiple' => false, 'placeholder' => 'Select Year'],
                    'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").val();
                   $("#fYear2").val(value);
                   ajaxChart();
                }
            ']
                ]);
                ?>
            </div>
        </div>
    </div>
    <?php if($Isreferral){ ?>
    <div class="row" style="padding-left: 5px;padding-right: 5px">
        <label class="text-green">Referral Type:</label>    
        <?php
        echo Select2::widget([
            'name' => 'ReferralTypeAmountID',
            'value' => $Stat->ReferralTypeAmount,
            'size' => 'sm',
            'data' => [
                1 => 'Total Fees',
                2 => 'Gratis Fees',
                3 => 'Discounted Fees',
            ],
            'options' => ['multiple' => false, 'placeholder' => 'Select ReferralTypeAmount'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").val();
                   var valueText = $(e.currentTarget).find("option:selected").text();
                   $("#ReferralTypeAmount").val(value);
                   $("#ReferralType").val(valueText);
                   ajaxChart();
                }
            ']
        ]);
        ?>
    </div>
    <?php }else{// Income ?>
     <div class="row" style="padding-left: 5px;padding-right: 5px">
        <label class="text-green">Fee Type:</label>    
        <?php
        echo Select2::widget([
            'name' => 'StringFeeType',
            'value' => $Stat->FeeTypeID,
            'size' => 'sm',
            'data' => [
                1 => 'Total Fees',
                2 => 'Discount Fees',
                3 => 'Discounted Fees',
            ],
            'options' => ['multiple' => false, 'placeholder' => 'Select Fee Type'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").val();
                   var valueText = $(e.currentTarget).find("option:selected").text();
                   $("#FeeTypeID").val(value);
                   $("#FeeType").val(valueText);
                   ajaxChart();
                }
            ']
        ]);
        ?>
    </div> 
    <?php } ?>
    <div class="row" style="padding-left: 5px;padding-right: 5px">
        <hr style="margin-bottom: 3px;margin-top: 10px">
        <label class="text-green">Chart Themes:</label>    
        <?php
        $HightChartsData = ArrayHelper::map($HighchartThemes, 'highchart_theme_id', 'theme');
        echo Select2::widget([
            'name' => 'ChartTheme',
            'value' => $Stat->highchart_theme_id,
            'size' => 'sm',
            'data' => $HightChartsData,
            'options' => ['multiple' => false, 'placeholder' => 'Select Theme'],
            'pluginEvents' => ['change' => '
                function(e){
                   var valueText = $(e.currentTarget).find("option:selected").text();
                   var value = $(e.currentTarget).find("option:selected").val();
                   $("#highchart_theme_id").val(value);
                   $("#Theme").val(valueText);
                   ajaxChart();
                }
            ']
        ]);
        ?>
    </div>
</div>
