<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$controllerId = $this->context->uniqueId . '/';
?>
<div class="user-view">
    <div class="row div-hr" style="padding-left: 15px">
    <a href="/admin/" class="btn btn-primary"></i>Assignment</a>
    <a href="/admin/user" class="btn btn-primary"></i>User</a>
    <a href="/admin/route" class="btn btn-primary"></i>Route</a>
    <a href="/admin/role" class="btn btn-primary"></i>Role</a>
    <a href="/admin/permission" class="btn btn-primary"></i>Permissions</a>
    <a href="/admin/menu" class="btn btn-primary"></i>Menu</a>
    <a href="/admin/rule" class="btn btn-primary"></i>Rule</a>
    </div>
    <p>
        <?php
        if ($model->status == 0 && Helper::checkRoute($controllerId . 'activate')) {
            echo Html::a(Yii::t('rbac-admin', 'Activate'), ['activate', 'id' => $model->id], [
                'class' => 'btn btn-primary',
                'data' => [
                    'confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                    'method' => 'post',
                ],
            ]);
        }else{
            echo Html::a(Yii::t('rbac-admin', 'Deactivate'), ['deactivate', 'id' => $model->id], [
                        'class' => 'btn btn-primary',
                        'data' => [
                            'confirm' => Yii::t('rbac-admin', 'Are you sure you want to Deactivate this user?'),
                            'method' => 'post',
                        ],
                    ]); 
                }
        ?>
        <?php
        if (Helper::checkRoute($controllerId . 'delete')) {
            echo Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        }
        echo "&nbsp;".Html::a("Update", Url::to(['user/update','id'=>$model->id]),['class'=>'btn btn-primary']);
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            [
                'attribute' => 'created_at',
                'value' => function($model) {
                    return gmdate("m/d/Y H:i A", $model->created_at); 
                }, 
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return gmdate("m/d/Y H:i A", $model->updated_at); 
                }, 
            ],
            [
                'label' => 'status',
                'value' => $model->status ? 'Active' : 'Inactive',
            ],
            [
                'attribute' => 'ismanagement',
                'value' => function($model) {
                    return $model->ismanagement == 0 ? 'No' : 'Yes';
                },
                'filter' => [
                    0 => 'No',
                    1 => 'Yes'
                ]
            ],
                        
        ],
    ])
    ?>

</div>
