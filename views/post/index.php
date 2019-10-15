<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'UserID',
                'label'=>'Writer',
                'value'=>function($data){
                    return $data->user->username;
                },
            ],
            'PostTitle',
            'DateCreated:datetime',
            [
                'attribute'=>'PostContent',
                'label'=>'Content',
                //'value' => 'substr($data->PostContent,0,100)."...<div class=more-data>$data->PostContent</div><a href=javascript:void(0); id=readMore>Read More</a>',
                'format' => 'raw',
                'value'=>function($data){
                    return StringHelper::truncateWords(Html::decode($data->PostContent), 100).'<a href="/post/'.$data->PostID.'" class="btn-link">View</a>';
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
