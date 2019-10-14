<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */
if($model->IsNewRecord){
    $Label="New User";
}else{
    $Label="Update";
}
$this->title = Yii::t('rbac-admin', $Label);
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
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Update User</div>
        <div class="panel-body">
    <p>Please change the following fields to update:</p>
    <?= Html::errorSummary($model)?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-Update']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password_hash')->passwordInput() ?>
              <?= $form->field($model, 'ismanagement')->checkbox(array('label'=>'Is Top Managament'))?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('rbac-admin', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
        </div>
    </div>
</div>
