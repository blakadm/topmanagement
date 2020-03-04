<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = Yii::t('rbac-admin', 'New User');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="row div-hr" style="padding-left: 15px">
    <a href="/admin/" class="btn btn-primary"></i>Assignment</a>
    <a href="/admin/user" class="btn btn-primary"></i>User</a>
    <a href="/admin/route" class="btn btn-primary"></i>Route</a>
    <a href="/admin/role" class="btn btn-primary"></i>Role</a>
    <a href="/admin/permission" class="btn btn-primary"></i>Permissions</a>
    <a href="/admin/menu" class="btn btn-primary"></i>Menu</a>
    <a href="/admin/rule" class="btn btn-primary"></i>Rule</a>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> New User</div>
        <div class="panel-body">
    <p>Please fill out the following fields to register:</p>
    <?= Html::errorSummary($model)?>
    
    
    
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'ismanagement')->checkbox(array('label'=>'Is Top Managament'))?>
                <div id="divMngtType" style="display: none;">
                <?= $form->field($model, 'mngttype')->dropDownList(
			['0' => 'Top Management', '1' => 'Director']
			)->label('Management Type'); ?>
                </div>
            <div id="divType" style="display: block;">
                 <?= $form->field($model, 'type')->dropDownList(
			['Top' => 'Top Management','DOST-I' => 'DOST-I', 'DOST-II' => 'DOST-II','DOST-III' => 'DOST-III','DOST-CALABARZON' => 'DOST-CALABARZON','DOST-MIMAROPA' => 'DOST-MIMAROPA','DOST-V' => 'DOST-V'
                         ,'DOST-VI' => 'DOST-VI','DOST-VII' => 'DOST-VII','DOST-VIII' => 'DOST-VIII','DOST-IX' => 'DOST-IX','DOST-X' => 'DOST-X','DOST-XI' => 'DOST-XI','DOST-XII' => 'DOST-XII'
                         ,'DOST-CAR' => 'DOST-CAR','DOST-CARAGA' => 'DOST-CARAGA','MOST-ARMM' => 'MOST-ARMM',
                            'ITDI' => 'ITDI','FPRDI' => 'FPRDI','FNRI' => 'FNRI','MIRDC' => 'MIRDC','PNRI' => 'PNRI','PTRI' => 'PTRI']
			); ?>
            </div>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('rbac-admin', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
        </div>
    </div>
</div>


<?php
    $this->registerJs("
        $('#signup-ismanagement').change(function() {
        if(this.checked) {
          //   e.preventDefault();
          $('#divMngtType').show();
         //  $('#signup-username').val('b');
       
        $('#signup-mngttype').val('0')
        
      //  $('#divType').hide();
        $('#signup-type').val('Top')
        }
        else
        {
          $('#divMngtType').hide();
      //       $('#divType').show();
      //       $('#signup-type').val('RSTL');
         
        }
           
    });
    
        
    ");
?>
