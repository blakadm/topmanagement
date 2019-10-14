<?php
use kartik\tabs\TabsX;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use yii\helpers\Html;
/* 
 * Project Name: Top_Management * 
 * Copyright(C)2018 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 11 26, 18 , 1:29:26 PM * 
 * Module: referral * 
 */
/* @var $this yii\web\View */
$this->title = 'Referrals';
$this->params['breadcrumbs'][] = ['label' => 'Top Management', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = ['label' => 'Statistics Dashboard', 'url' => ['/toplevel/data/statistics']];
$this->params['breadcrumbs'][] = $this->title;
//Initialize
$DefDiv="<div style='width: 100%;height: 450px;text-align: center;'><img style='vertical-align: middle' src='/images/ajax-loader.gif' alt=''/></div>";
$tab0Content=$DefDiv;
$tab1Content=$DefDiv;
$tab2Content=$DefDiv;
$tab3Content=$DefDiv;
$tab0Active=false;
$tab1Active=false;
$tab2Active=false;
$tab3Active=false;
$form = ActiveForm::begin([
    'id' => 'formReferral',
    'method' => 'POST',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true
]);
switch($model->ActiveTab){
    case "tab0":
        $tab0Content=$this->render("_feescollected",['fees'=>$model,'form'=>$form,'post'=>$post]);
        $tab0Active=true;
        break;
    case "tab1":
        $tab1Content=$this->render("_referralcount",['model'=>$model,'form'=>$form,'post'=>$post]);
        $tab1Active=true;
        break;
}
$items = [
    [  //tab0
        'label'=>'<i class="fa fa-money"></i> Fees Collected',
        'content'=>$tab0Content,
        'active'=>$tab0Active
    ],
    [  //tab1
        'label'=>'<i class="fa fa-user-plus"></i> Accepting/Receiving',
        'content'=>$tab1Content,
        'active'=>$tab1Active
    ], 
];
$js=<<<SCRIPT
    $('#referraltab').on("click", "li", function (event) {         
        var activeTab = $(this).find('a').attr('href').split('-')[1];
        $("#ActiveTab").val(activeTab);  
        $('#formReferral').submit();
    }); 
SCRIPT;
$this->registerJs($js);
?>
<div class="row">
    <div class="col-md-12">
        <?php
        echo Html::hiddenInput("ActiveTab", $model->ActiveTab, ["id"=>"ActiveTab"]);
        echo TabsX::widget([
            'items'=>$items,
            'id'=>'referraltab',
            'bordered'=>true,
            'position'=>TabsX::POS_ABOVE,
            'encodeLabels'=>false,
            'pluginEvents' => [
                "tabsX.click" => "function() { 
                    //alert($('#referraltab>li a').attr('href'));
                    //$('#formReferral').submit(); 
                }"
            ]
        ]);
        ActiveForm::end();
        ?>
    </div>
</div>