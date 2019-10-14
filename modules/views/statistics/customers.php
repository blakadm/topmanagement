<?php
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\View;
use kartik\date\DatePicker;
use kartik\checkbox\CheckboxX;
use app\models\Customertype;
use app\models\Businessnature;
use app\models\Classification;


/* @var $this yii\web\View */
$this->title = 'Customers';
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
 echo Html::hiddenInput("RegionID", $Customers->RegionID, ['id'=>'RegionID']);
 echo Html::hiddenInput("ChartType", $Customers->ChartType, ['id'=>'ChartType']);
 echo Html::hiddenInput("ClassificationID", $Customers->ClassificationID, ['id'=>'ClassificationID']);
 echo Html::hiddenInput("AgencyID", $Customers->AgencyID, ['id'=>'AgencyID']);
 echo Html::hiddenInput("BusinessNatureID", $Customers->BusinessNatureID, ['id'=>'BusinessNatureID']);
 echo Html::hiddenInput("activecustomer", $Customers->activecustomer, ['id'=>'activecustomer']);
 echo Html::hiddenInput("CustomerTypeID", $Customers->CustomerTypeID, ['id'=>'CustomerTypeID']);
 echo Html::hiddenInput("highchart_theme_id", $Customers->highchart_theme_id, ['id' => 'highchart_theme_id']);
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
    series = highChart_Customer.series;
    var tot = series.length;
    IterateSeries(tot);
}
function ExportToPDF(){
     alert("Exporting to PDF!!!");
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
        $SQL="(SELECT 0 AS `id`, 'All Regions' AS `reg_desc`) UNION ALL ";
        $SQL.="(SELECT `region_id` as `id`, `reg_desc` FROM `eulims_address`.`tbl_region` ORDER BY `reg_desc`)";
        $connection=Yii::$app->db;
        $command=$connection->createCommand($SQL);
        $data=ArrayHelper::map($command->queryAll(),'id','reg_desc');
        echo Select2::widget([
            'name' => 'Region',
            'value' => $Customers->RegionID,
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
            'value' => $Customers->Agency,
            'data' => $Customers->RSTLData,
            'size'=>'sm',
            'options' => ['multiple' => false, 'placeholder' => 'Select Laboratory'],
            'pluginEvents' => ['change' => '
                function(e){
                   $("#AgencyID").val(this.value);
                   $("#formIncome").submit();
                }
            ']
        ]);
        ?>
        </div>
        <div class="row" style="padding-left: 5px;padding-right: 5px;padding-bottom: 10px">
        <label class="text-green">Business Nature:</label>
        <?php
            $SQL="(SELECT 0 AS `business_nature_id`, 'All' AS `nature`) UNION ALL ";
            $SQL.="(SELECT `business_nature_id`, `nature` FROM `tbl_businessnature` ORDER BY `nature`)";
            $connection=Yii::$app->labdb;
            $command=$connection->createCommand($SQL);
            $BusinessNatureList=ArrayHelper::map($command->queryAll(),'business_nature_id','nature');
            echo Select2::widget([
            'name' => 'BusinessNature',
            'value' => $Customers->BusinessNatureID,
            'size'=>'sm',
            'data' => $BusinessNatureList,
            'options' => ['multiple' => false, 'placeholder' => 'Select Business Nature'],
            'pluginEvents' => ['change' => '
                function(e){
                   $("#BusinessNatureID").val(this.value);
                   $("#formIncome").submit();
                }
            ']
            ]);
        ?>
        </div>
        <div class="row" style="padding-left: 5px;padding-right: 5px">
        <label class="text-green">Customer Type:</label>    
        <?php
            $CustomerTypeList= ArrayHelper::map(Customertype::find()->all(),'customertype_id','type');
            echo Select2::widget([
            'name' => 'CustomerType',
            'value' => $Customers->CustomerTypeID,
            'size'=>'sm',
            'data' => $CustomerTypeList,
            'options' => ['multiple' => false, 'placeholder' => 'Select CustomerType'],
            'pluginEvents' => ['change' => '
                function(e){
                   $("#CustomerTypeID").val(this.value);
                   $("#formIncome").submit();
                }
            ']
            ]);
        ?>
        </div>
        <div class="row" style="padding-left: 5px;padding-right: 5px">
        <label class="text-green">Classification:</label>
        <?php
            $SQL="(SELECT 0 AS `classification_id`, 'All' AS `classification`) UNION ALL ";
            $SQL.="(SELECT `classification_id`, `classification` FROM `tbl_classification`) ";
            $SQL.="ORDER BY `classification`;";
            $connection=Yii::$app->labdb;
            $command=$connection->createCommand($SQL);
            $IndustryTypeList=ArrayHelper::map($command->queryAll(),'classification_id','classification');
            echo Select2::widget([
            'name' => '_Classification',
            'value' => $Customers->ClassificationID,
            'size'=>'sm',
            'data' => $IndustryTypeList,
            'options' => ['multiple' => false, 'placeholder' => 'Select Industry Type'],
            'pluginEvents' => ['change' => '
                function(e){
                   $("#ClassificationID").val(this.value);
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
            'value' => $Customers->ChartTypeID,
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
        <label class="text-green"></label>
        <div class="input-group">
            <?php
            echo '<label class="class="text-green"" for="chkShowCancelled">Show Active Customers </label>';
            echo CheckboxX::widget([
                'name' => 'chkActiveCustomer',
                'value' => $Customers->activecustomer,
                'options' => ['id' => 'chkActiveCustomer'],
                'pluginOptions' => ['threeState' => false],
                'pluginEvents' => ['change' => '
                        function(e){
                            $("#activecustomer").val(this.value);
                            $("#formIncome").submit();
                        }
                    ']
            ]);
            ?>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="col-lg-8 box box-primary" style="height: 500px">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-body">
                <?php
                Yii::$app->PostedData->GenerateChart("Customer","pie","# of Customers","Customers","/toplevel/statistics/customers",$Categories,$Series,890,400);
                ?>
            </div>
        </div>
    </div>  
</div>
<?php ActiveForm::end(); 
