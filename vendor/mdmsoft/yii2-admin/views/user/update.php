<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\User */

$this->title = Yii::t('rbac-admin', 'Update Menu') . ': ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('rbac-admin', 'Update');
?>
<div class="menu-update">
    <?=
    $this->render('_update', [
        'model' => $model,
    ])
    ?>

</div>
