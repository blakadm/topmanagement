<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentation-index">
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-book"></i> <?= Html::encode($this->title) ?></div>
        <div class="panel-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Create Documentation', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'Title',
                    [
                        'format'=>'raw',
                        'label' => 'Content',
                        'value'=>function($model){
                            return StringHelper::truncateWords(Html::decode($model->DocumentContent), 30,' <a href="#">...continue reading...</a>');
                        }
                    ],
                    'category.Category',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
