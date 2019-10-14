<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
/* @var $this Controller */
?>
<div class="content-wrapper">
    <?php
    echo Breadcrumbs::widget([
      'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
      'tag'=>'ol', //<li class="active"><span>Data</span></li>
      'activeItemTemplate'=>'<li class="active"><span>{link}</span></li>',
      'options'=>['class'=>'breadcrumb breadcrumb-arrow'],
      'homeLink' => [ 
                'label' => '<i class="glyphicon glyphicon-home"></i>',
                'encode' => false,
                'url' => Yii::$app->homeUrl,
            ],
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);
    ?>
    <section class="content">
        <?= Alert::widget() ?>
        <div class="container">
    <div class="header">
        <h3 class="text-muted"><?= \yii\helpers\Html::encode(\Yii::$app->name) ?></h3>
    </div>
    <div class="jumbotron">
        <p class="lead">
            <h1><?= \Yii::t('maintenance', 'Maintenance mode'); ?></h1>
        </p>
        <p class="lead"><?= \Yii::t('maintenance', 'Sorry, this page is currently not available.'); ?></p>
        <p class="lead"><?= \Yii::t('maintenance', 'This page is currently in a maintenance mode. Usually this takes 5-15 minutes.'); ?></p>
        <p class="lead"><?= \Yii::t('maintenance', 'Visit us again soon.'); ?></p>
    </div>
    <footer class="footer">
        <p>&copy; <?= \yii\helpers\Html::encode(\Yii::$app->name) ?> <?= date('Y') ?></p>
    </footer>
</div>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2017 <a href="http://region9.dost.gov.ph/">DOST Regional Office IX</a>.</strong> All rights
    reserved.
</footer>

