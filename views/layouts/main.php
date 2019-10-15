<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    $js='$(document).ready(function(){
        $(\'[data-toggle="tooltip"]\').tooltip(); 
    });';
    $this->registerJs($js);
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>OneLab | <?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/onelab.ico" type="image/x-icon" />
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-collapse">
    <section id="navigation-main"> 
       <!-- Require the navigation -->
       <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>
    </section><!-- /#navigation-main -->
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>
        <div class="control-sidebar-bg"></div>
    </div>

    <?php $this->endBody() ?>
    </body>
    <!-- Application developed by: Eng'r Nolan F. Sunico
         Agency: DOST-IX 
         Date: October 1, 2017
    -->
    </html>
    <?php $this->endPage() ?>
<?php } ?>
