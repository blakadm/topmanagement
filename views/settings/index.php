<?php
/* @var $this yii\web\View */
use yii\web\View;
use kartik\switchinput\SwitchInput;


$this->title = 'System Settings';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(
    "$(function() {
       $('#toggle-one').bootstrapToggle();
       $('#chkMaintenance').change(function(){
          alert('ok');
       });
     })",
    View::POS_READY,
    'my-button-handler'
);
if (Yii::$app->maintenanceMode->IsEnabled){
    $IsMaintenance=true;
    $setEnable="disable";
}else{
    $IsMaintenance=false;
    $setEnable="enable";
}

?>
<div class="content">
    <?php if(Yii::$app->user->can('Allow Maintenance')){ ?>
    <div class="panel panel-default">
        <div class="panel-heading"><i class='fa fa-wrench'></i> System Maintenance</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <label for="ReferenceNumber" class="control-label col-sm-3">Mode:</label>
                    <div class="col-sm-7">
                        <?php
                        echo SwitchInput::widget([
                            'name' => 'chkMaintenance',
                            'id' => 'chkMaintenance',
                            'value' => $IsMaintenance,
                            'pluginOptions' => [
                                'onText' => 'Yes',
                                'offText' => 'No',
                            ],
                            'pluginEvents' => [
                                "switchChange.bootstrapSwitch" => "
                    function() { 
                        $.ajax('/settings/" . $setEnable . "',{
                            success: function (data, status, xhr) {// success callback function
                            document.location=location.href;
                        }
                        });
                    }  
                ",
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>