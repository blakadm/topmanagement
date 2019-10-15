<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Announcement */

$this->title = 'Update: ' . ' ' . $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Announcement', 'url' => ['/announcement']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->AnnouncementID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="announcement-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
