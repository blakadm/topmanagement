<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Announcement */

?>
<div class="announcement-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->Title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'AnnouncementID', 'visible' => false],
        [
            'label' => 'AnnouncementType',
            'value' => function($model){   
                    return $model->getAnnouncementType()->select('AnnouncementType')->where(['AnnouncementTypeID'=>$model->AnnouncementTypeID])->scalar();
            },
        ],
        'Title',
        'Announcement:html',
        'StartDate:date',
        'EndDate:date',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
