<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \app\models\Documentation;
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
                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'category.Category',
                        'Title',
                        [
                            'format'=>'raw',
                            'label'=>'Content',
                            'value'=>'<a href="/help/search" class="btn btn-primary"><i class="fa fa-search"></i> Back to Search</a>',
                        ],
                    ],
                ])
                ?>
                <div class="row" style="padding-left: 10px;overflow-y: scroll;min-height: 500px">
                    <div class="col-md-8">
                    <?= $model->DocumentContent;  ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
