<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Announcement */

$this->title = $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Announcement', 'url' => ['/announcement']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="announcement-view">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Announcement</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-3" style="margin-top: 15px"> 
                    <?= Html::a('Update', ['update', 'id' => $model->AnnouncementID], ['class' => 'btn btn-primary']) ?>
                    <?=
                    Html::a('Delete', ['delete', 'id' => $model->AnnouncementID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                    <?= Html::a('Cancel', ['/announcement'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <div class="row">
                <?php
                $gridColumn = [
                    ['attribute' => 'AnnouncementID', 'visible' => false],
                    [
                        //'attribute' => 'announcementType.AnnouncementType',
                        'label' => 'AnnouncementType',
                        'value'=>function($model){   
                            return $model->getAnnouncementType()->select('AnnouncementType')->where(['AnnouncementTypeID'=>$model->AnnouncementTypeID])->scalar();
                        }
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
    </div>
</div>
