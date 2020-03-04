<?php

/**
 * @var $model cinghie\articles\models\Items
 */

use kartik\helpers\Html;

// Set Title and Breadcrumbs
$this->title = Yii::t('articles', '') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Articles'), 'url' => ['/articles/items/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('articles', 'Item'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->alias;

?>

<div class="items-update">

    <?php if(Yii::$app->getModule('articles')->showTitles): ?>
        <div class="page-header">
            <h2>Update: <?= Html::encode($this->title) ?></h2>
        </div>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
