<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Login */

$this->title = Yii::t('rbac-admin', 'Login');
$this->params['breadcrumbs'][] = $this->title;
list(,$url) = Yii::$app->assetManager->publish('@mdm/admin/assets');
$this->registerCssFile($url.'/main.css');

?>

<style>
    /* latin-ext */
    @font-face {
        font-family: 'Audiowide';
        font-style: normal;
        font-weight: 400;
        src: local('Audiowide Regular'), local('Audiowide-Regular'), url('/font/audiowide_latin_ext.woff2') format('woff2');

    }
    /* latin */
    @font-face {
        font-family: 'Audiowide';
        font-style: normal;
        font-weight: 400;
        src: local('Audiowide Regular'), local('Audiowide-Regular'), url('/font/audiowide_latin.woff2') format('woff2');

    }

    .newtext {
       
        background: -webkit-linear-gradient( #1b4f72  , #3c8dbc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font: normal 52px/1 "Audiowide", Helvetica, sans-serif;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
        font-family: 'Audiowide';
        font-size: 40px;
        text-align: center;
    }
    .newtextsmall {
       
       background: -webkit-linear-gradient( #1b4f72  , #3c8dbc);
       -webkit-background-clip: text;
       -webkit-text-fill-color: transparent;
       font: normal 52px/1 "Audiowide", Helvetica, sans-serif;
       -o-text-overflow: ellipsis;
       text-overflow: ellipsis;
       font-family: 'Audiowide';
       font-size: 30px;
       text-align: center;
       padding-top: -10px
   }
    .img-responsive {
        display: block;
        max-width: 100%;
        height: auto;
        margin:auto;

    }

</style>

<div class="body-content" style="margin:10%;background: linear-gradient(110deg,  #b1d1e4 50%,#3c8dbc 50%);margin-top: 0px">
    <div >
        <div class="d-flex align-items-center" >

            <div>
                <div class="row">

                    <div class="col-sm-6 ">
                        <div class="d-flex align-items-center" >
                            <div class="row" style="margin-top: 10%">
                                <div class="col-sm-12 col-md-offset-0 ">
                                    <img src="/images/onelablogo.png" style="width: 80%;border-radius: 15px 15px;display: block; height: auto; max-width: 100%;margin:0 auto;margin-top: 30px">
                                </div>
                                <div class="col-sm-12 col-md-offset-0 ">
                                    <div class="row"> 
                                        <h1 class="newtext">
                                            Performance Dashboard
                                        </h1>  
                                    </div>
                                    
                                    <div class="row">  
                                        <h1 class="newtextsmall">
                                            for Top Management
                                        </h1>  
                                    </div>
                                    <br>
                                  
                                    <p style="font-family: 'Audiowide';font-size:18px;color:#1b4f72;text-align:center;vertical-align: central">
                                        Department of Science and Technology
                                    </p> 
                                    <br><br>
                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="col-sm-6" style="margin-bottom: 30px">
                        <div class="login-box">
                            <div class="login-content col-md-12 ">
                                    <h1><span class="fa fa-lock"></span> <?= Html::encode($this->title) ?></h1>
                                    <p>Please fill out the following fields to login:</p>
                                        <div class="col-lg-12">
                                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                                <?= $form->field($model, 'username') ?>
                                                <?= $form->field($model, 'password')->passwordInput() ?>
                                                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                                                <div style="color:#999;margin:1em 0">
                                                    If you forgot your password you can <?= Html::a('reset it', ['user/request-password-reset']) ?>.
                                                </div>
                                                <div class="form-group">
                                                    <?= Html::submitButton(Yii::t('rbac-admin', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                                </div>
                                            <?php ActiveForm::end(); ?>
                                        </div>
                                </div>
                                <br>    
                            <!-- /.login-box-body -->
                        </div><!-- /.login-box -->
                    </div>
                </div> 

            </div>
        </div>
    </div>

</div>

