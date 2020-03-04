<?php

use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

/* @var $this Controller */
$StartYear = 2017;
$CurYear = date("Y");
$StartCurYear = $StartYear . '-' . $CurYear;
?>
<div>
    <?php
    echo Breadcrumbs::widget([
        'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
        'tag' => 'ol', //<li class="active"><span>Data</span></li>
        'activeItemTemplate' => '<li class="active"><span>{link}</span></li>',
        'options' => ['class' => 'breadcrumb breadcrumb-arrow'],
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
<?= $content ?>
    </section>
</div>


<!-- Footer -->


<!-- Footer -->
