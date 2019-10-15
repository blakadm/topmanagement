<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\social\FacebookPlugin;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->PostTitle;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PostID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PostID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'UserID',
                'label'=>'Created by:',
                'value'=>function($model){
                   return $model->user->username;
                }
            ],
            'PostTitle',
            'DateCreated:datetime',
            'PostContent:html',
        ],
    ]) ?>
    <?php echo FacebookPlugin::widget(['appId'=>'2019616858321571','type'=>FacebookPlugin::LIKE, 'settings' => ['size'=>'small']]);     ?>

</div>
