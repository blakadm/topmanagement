<?php

/* @var $this yii\web\View */
/* @var $model app\models\Announcement */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use app\models\AnnouncementType;

//use \app\models\base\Announcement as BaseAnnouncement;

$this->title = 'Announcement';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="announcement-index">
    <p>
        <?= Html::a('Create Announcement', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'label' => 'Expand',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        ['attribute' => 'AnnouncementID', 'visible' => false],
        [
                'attribute' => 'Announcement.announcementType',
                'label' => 'AnnouncementType',
                'value' => function($model){   
                    return $model->getAnnouncementType()->select('AnnouncementType')->where(['AnnouncementTypeID'=>$model->AnnouncementTypeID])->scalar();
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(Announcementtype::find()->where('AnnouncementTypeID>=1')->orderBy('AnnouncementType')->all(), 'AnnouncementTypeID', 'AnnouncementTypeID'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Tbl announcementtype', 'id' => 'grid--AnnouncementTypeID']
            ],
        'Title',
        [
            'format'=>'raw',
            'label' => 'Announcement',
            'value'=>function($model){
                 return \yii\helpers\StringHelper::truncateWords(Html::decode($model->Announcement), 30);
            }
        ],
        'StartDate:date',
        'EndDate:date',
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-announcement']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]) ,
        ],
    ]); ?>

</div>
