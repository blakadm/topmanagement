<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Update Post: ' . $model->PostTitle;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PostTitle, 'url' => ['view', 'id' => $model->PostID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="post-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
