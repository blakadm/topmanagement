<?php
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\View;
use kartik\date\DatePicker;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
$this->title = 'Transactions';
$this->params['breadcrumbs'][] = ['label' => 'Top Management', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = ['label' => 'Statistics Dashboard', 'url' => ['/toplevel/data/statistics']];
$this->params['breadcrumbs'][] = $this->title;

//Load Customer JS ************************************************************************
//$this->registerJsFile('/js/income.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//*****************************************************************************************
//var_dump($Income);
$form = ActiveForm::begin([
    'id' => 'formIncome',
    'method' => 'POST',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true
]);
 echo Html::hiddenInput("RegionID", $Transactions->RegionID, ['id'=>'RegionID']);
 echo Html::hiddenInput("ChartType", $Transactions->ChartType, ['id'=>'ChartType']);
 echo Html::hiddenInput("fYear", $Transactions->Year, ['id'=>'fYear']);
 echo Html::hiddenInput("fYear2", $Transactions->Year2, ['id'=>'fYear2']);
 echo Html::hiddenInput("showcancelled", $Transactions->ShowCancelled, ['id'=>'showcancelled']);
 echo Html::hiddenInput("Frequency", $Transactions->Frequency, ['id'=>'Frequency']);
 echo Html::hiddenInput("highchart_theme_id", $Transactions->highchart_theme_id, ['id' => 'highchart_theme_id']);
$mChange=<<<SCRIPT
    function(e){
        var value = $(e.currentTarget).find("option:selected").val();
        $("#RegionID").val(value);
        $("#formIncome").submit();
    }    
SCRIPT;
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
    series = highChart_Transaction.series;
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
//echo "<pre>";
//var_dump(\Yii::$app->authManager->getRolesByUser(1));
//echo Yii::$app->user->can("Super-Administrator");
//echo "</pre>";
//exit;
?>
<div class="row">
    <div class="col-lg-2 box-blue" style="padding-bottom: 10px">
        <div class="row" style="padding-left: 5px;padding-right: 5px;padding-bottom: 10px">
        <label class="text-green">Region:</label>
        <?php
        $SQL="(SELECT 0 AS `id`, 'All Regions' AS `region`) UNION ALL ";
        $SQL.="(SELECT `region_id` as `id`, `region` FROM `tbl_region` ORDER BY `orderby`)";
        $connection=Yii::$app->db;
        $command=$connection->createCommand($SQL);
        $data=ArrayHelper::map($command->queryAll(),'id','region');
        echo Select2::widget([
            'name' => 'Region',
            'value' => $Transactions->RegionID,
            'size'=>'sm',
            'data' => $data,
            'options' => ['multiple' => false, 'placeholder' => 'Select Region'],
            'pluginEvents' => ['change' => $mChange]
        ]);
        ?>
        </div>
        <div class="row" style="padding-left: 5px;padding-right: 5px;padding-bottom: 10px">
        <label class="text-green">RSTL:</label>
        <?php
        
        echo Select2::widget([
            'name' => 'Agency',
            'value' => $Transactions->Agency,
            'data' => $Transactions->RSTLData,
            'size'=>'sm',
            'options' => ['multiple' => false, 'placeholder' => 'Select Laboratory'],
            'pluginEvents' => ['change' => '
                function(e){
                   $("#formIncome").submit();
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
            'value' => $Transactions->LabID,
            'size'=>'sm',
            'data' => $Transactions->LabData,
            'options' => ['multiple' => false, 'placeholder' => 'Select Laboratory'],
            'pluginEvents' => ['change' => '
                function(e){
                   $("#formIncome").submit();
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
            'value' => $Transactions->ChartTypeID,
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
                   $("#formIncome").submit();
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
            'value' => $Transactions->FrequencyID,
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
                   $("#formIncome").submit();
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
            'value' => $Transactions->Year,
            'size'=>'sm',
            'data' =>$YearData,
            'options' => ['multiple' => false, 'placeholder' => 'Select Year'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").val();
                   $("#fYear").val(value);
                   $("#formIncome").submit();
                }
            ']
            ]);
        ?>
        <?php
           if($Transactions->FrequencyID==5){
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
            'value' => $Transactions->Year2,
            'size'=>'sm',
            'data' =>$_YearData,
            'options' => ['multiple' => false, 'placeholder' => 'Select Year'],
            'pluginEvents' => ['change' => '
                function(e){
                   var value = $(e.currentTarget).find("option:selected").val();
                   $("#fYear2").val(value);
                   $("#formIncome").submit();
                }
            ']
            ]);
        ?>
            </div>
        </div>
        <label class="text-green"></label>
        <div class="input-group">
            <?php
            echo '<label class="class="text-green"" for="chkShowCancelled">Show Cancelled </label>';
            echo CheckboxX::widget([
                'name' => 'chkShowCancelled',
                'value' => $Transactions->ShowCancelled,
                'options' => ['id' => 'chkShowCancelled'],
                'pluginOptions' => ['threeState' => false],
                'pluginEvents' => ['change' => '
                        function(e){
                            $("#showcancelled").val(this.value);
                            $("#formIncome").submit();
                        }
                    ']
            ]);
            ?>
        </div>
    </div>
    </div>
    <div class="col-lg-10">
        <div class="col-lg-8 box box-primary" style="height: 500px">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-body">
                <?php
                if($Transactions->FrequencyID==5){
                    $CategoryMonth='Years';
                }else{
                    $CategoryMonth='Month';
                }
                //$Categories = ['title'=>['text'=>$CategoryMonth],'categories' =>$Transactions->Quarter];
                Yii::$app->PostedData->GenerateChart("Transaction",$Transactions->ChartType, "Transactions", $Transactions->ChartTitle, "/toplevel/statistics/income", $Transactions->Categories, $Transactions->Series,850,400,"sand-signika","0.f");
                ?>
            </div>
        </div>
    </div>  
</div>
<?php ActiveForm::end(); 