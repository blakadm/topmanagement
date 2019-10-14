<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Income';
$this->params['breadcrumbs'][] = ['label' => 'Top Management', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = ['label' => 'Statistics Dashboard', 'url' => ['/toplevel/data/statistics']];
$this->params['breadcrumbs'][] = $this->title;
//Load Customer JS ************************************************************************
//$this->registerJsFile('/js/income.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//*****************************************************************************************
//var_dump($Income);
$form = ActiveForm::begin([
    'id' => 'form',
    'method' => 'POST',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true
]);
$this->registerJsFile("/js/income.js");
?>
<div class="row">
    <?php echo $this->render("_statistics",['Stat'=>$Income,'id'=>'Income','HighchartThemes'=>$HighchartThemes,'Isreferral'=>false]); ?>
    <div class="col-lg-10">
        <div class="col-lg-10 box box-primary" style="height: 500px">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-body">
                <?php
                if($Income->FrequencyID==5){
                    $CategoryMonth='Years';
                }else{
                    $CategoryMonth='Month';
                }
                $Categories = ['title'=>['text'=>$CategoryMonth],'categories' =>$Income->Quarter];
                Yii::$app->PostedData->GenerateChart("Income",$Income->ChartType, $Income->FeeType, $Income->ChartTitle, "/toplevel/statistics/income", $Categories, $Income->Series,850,400,$Income->theme);
                ?>
            </div>
        </div>
    </div>  
</div>
<iframe id="my_iframe" style="display:none;"></iframe>
<?php ActiveForm::end(); 