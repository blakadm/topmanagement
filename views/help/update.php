<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Documentation */

$this->title = 'Update Documentation: ';
$this->params['breadcrumbs'][] = ['label' => 'Documentations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->DocumentationID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="documentation-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
