<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Documentation */

$this->title = $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Documentations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentation-view">
    <div class="documentation-form">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-book"></i> <?= Html::encode($this->title) ?></div>
            <div class="panel-body">
                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->DocumentationID], ['class' => 'btn btn-primary']) ?>
                    <?=
                    Html::a('Delete', ['delete', 'id' => $model->DocumentationID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </p>

                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'DocumentationID',
                        'category.Category',
                        'Title',
                        'DocumentContent:html',
                    ],
                ])
                ?>
            </div>
        </div>
    </div>
</div>
