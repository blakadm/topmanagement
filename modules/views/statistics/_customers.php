<?php
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\View;
use kartik\date\DatePicker;
use kartik\checkbox\CheckboxX;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
//Load Customer JS ************************************************************************
//$this->registerJsFile('/js/income.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//*****************************************************************************************
//var_dump($Income);
/*$form = ActiveForm::begin([
    'id' => 'formCustomer',
    'method' => 'POST',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true
]);
 * 
 */
 echo Html::hiddenInput("RegionID", $Customer->RegionID, ['id'=>'RegionID']);
 echo Html::hiddenInput("ChartType", $Customer->ChartType, ['id'=>'ChartType']);
 echo Html::hiddenInput("StartYear", $Customer->StartYear, ['id'=>'StartYear']);
 echo Html::hiddenInput("EndYear", $Customer->EndYear, ['id'=>'EndYear']);
 echo Html::hiddenInput("ChartTitle", $Customer->ChartTitle, ['id'=>'ChartTitle']);
 echo Html::hiddenInput("Frequency", $Customer->Frequency, ['id'=>'Frequency']);
 echo Html::hiddenInput("FeesCollection[LabID]", $Customer->LabID, ['id'=>'LabID']);
 echo Html::hiddenInput("HighchartThemeID", $Customer->HighchartThemeID, ['id' => 'highchart_theme_id']);
$mChange=<<<SCRIPT
    function(e){
        var value = $(e.currentTarget).find("option:selected").val();
        $("#RegionID").val(value);
        $("#formReferral").submit();
    }    
SCRIPT;
$js=<<<SCRIPT
var series;
var IsHide=false;
    
function ajaxChart(){
    ShowProgress();
    $("#formReferral").submit();
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
    series = highChart_Referral.series;
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
    $("#chkShowCancelled").change(function(){
         $("#showcancelled").val(this.checked ? 1 : 0);
         ajaxChart();
    })   
SCRIPT;
$this->registerJs($js);
?>
<div class="row" style="padding-left: 10px">
    <div class="col-lg-2 box-blue" style="padding-bottom: 10px;">
        <div class="row" style="padding-left: 0px;padding-right: 0px;padding-bottom: 0px;">
            <div class="col-md-8" style="padding-left: 5px;padding-right: 0px">  
                <label class="text-green">Customers:</label>
                <?php
                   echo $form->field($Customer, 'ReferralMode')->widget(SwitchInput::classname(), [
                        'items' => [
                            ['label' => 'New', 'value' => 1],
                            ['label' => 'OLD', 'value' => 2],
                        ],
                        'pluginOptions' => [
                            'onText' => 'New',
                            'offText' => 'OLD',
                            'onColor' => 'primary',
                            'offColor' => 'success',
                            'handleWidth'=>73,
                        ],
                        'pluginEvents' => [
                            "switchChange.bootstrapSwitch" => "
                                function() { 
                                    $('#formReferral').submit();
                                }  
                            ",
                        ],
                    ])->label(false);  
                ?>
            </div>
        </div>
        <div class="row" style="padding-left: 5px;padding-right: 5px">
        <label class="text-green">ChartType:</label>    
        <?php
            echo Select2::widget([
            'name' => 'ChartTypeID',
            'value' => $Customer->ChartTypeID,
            'size'=>'sm',
            'data' => [
                0=>'Select Chart',
                1=>'Line',
                2=>'Bar',
                3=>'Column',
                4=>'Area',
                5=>'spline',
                6=>'pie'
            ],
            'options' => ['multiple' => false, 'placeholder' => 'Select Chart'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").text();
                   $("#ChartType").val(value);
                   $("#formReferral").submit();
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
            'value' => $Customer->FrequencyID,
            'size'=>'sm',
            'data' => [
                0=>'All Quarters',
                1=>'First Quarter',
                2=>'Second Quarter',
                3=>'Third Quarter',
                4=>'Fourth Quarter',
                5=>'Years'
            ],
            'options' => ['multiple' => false, 'placeholder' => 'Select Frequency'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").text();
                   $("#Frequency").val(value);
                   $("#formReferral").submit();
                }
            ']
            ]);
        ?>
        </div>
        <div class="row" style="padding-left: 5px;padding-right: 5px">
        <label class="text-green">Year:</label>
        <div class="input-group">
        <?php
            $StartYear=2013;
            $CurYear=(int)date("Y")+1;
            $Proc="CALL spGenerateYears(:StartYear,:EndYear)";
            $conn=Yii::$app->db;
            $comm=$conn->createCommand($Proc);
            $comm->bindParam("StartYear", $StartYear);
            $comm->bindParam("EndYear", $CurYear);
            $YearData=ArrayHelper::map($comm->queryAll(),'Year','Year');
            echo Select2::widget([
            'name' => 'FrequencyYear',
            'id'=>'FrequencyYear',
            'value' => $Customer->StartYear,
            'size'=>'sm',
            'data' =>$YearData,
            'options' => ['multiple' => false, 'placeholder' => 'Select Year'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").val();
                   $("#StartYear").val(value);
                   $("#formReferral").submit();
                }
            ']
            ]);
        ?>
        <?php
           if($Customer->FrequencyID==5){
               $DisplayYearRange='';
           }else{
               $DisplayYearRange='style="display: none"';
           }
        ?>
            <span class="input-group-addon" <?= $DisplayYearRange ?>>-</span>
            <div <?= $DisplayYearRange ?>> 
        <?php
            $_StartYear=2013;
            $_CurYear=(int)date("Y")+2;
            $_Proc="CALL spGenerateYears(:StartYear,:EndYear)";
            $con=Yii::$app->db;
            $com=$con->createCommand($_Proc);
            $com->bindParam("StartYear", $_StartYear);
            $com->bindParam("EndYear", $_CurYear);
            $_YearData=ArrayHelper::map($com->queryAll(),'Year','Year');
            echo Select2::widget([
            'name' => 'FrequencyYear2',
            'id'=>'FrequencyYear2',
            'value' => $Customer->EndYear,
            'size'=>'sm',
            'data' =>$_YearData,
            'options' => ['multiple' => false, 'placeholder' => 'Select Year'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").val();
                   $("#EndYear").val(value);
                   $("#formReferral").submit();
                }
            ']
            ]);
        ?>
            </div>
        </div>
    </div>
    </div>
    <div class="col-lg-10">
        <div class="col-lg-8 box box-primary" style="height: 500px">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-body">
                <?php
                if($Customer->FrequencyID==5){
                    $CategoryMonth='Years';
                }else{
                    $CategoryMonth='Region';
                }
                $Categories = ['title'=>['text'=>$CategoryMonth],'categories' =>$Customer->Quarter];
                Yii::$app->PostedData->GenerateChart("Referral",$Customer->ChartType, "Referrals", $Customer->ChartTitle, "/toplevel/statistics/referral", $Categories, $Customer->Series,850,400);
                ?>
            </div>
        </div>
    </div>  
</div>
<?php //ActiveForm::end(); 