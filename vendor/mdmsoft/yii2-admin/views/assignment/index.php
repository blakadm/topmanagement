<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = Yii::t('rbac-admin', 'Assignment');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    $usernameField,
];
if (!empty($extraColumns)) {
    $columns = array_merge($columns, $extraColumns);
}
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}'
];
?>
<div class="assignment-index">
    <div class="row div-hr" style="padding-left: 15px">
    <a href="/admin/" class="btn btn-primary"></i>Assignment</a>
    <a href="/admin/user" class="btn btn-primary"></i>User</a>
    <a href="/admin/route" class="btn btn-primary"></i>Route</a>
    <a href="/admin/role" class="btn btn-primary"></i>Role</a>
    <a href="/admin/permission" class="btn btn-primary"></i>Permissions</a>
    <a href="/admin/menu" class="btn btn-primary"></i>Menu</a>
    <a href="/admin/rule" class="btn btn-primary"></i>Rule</a>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Assignment</div>
        <div class="panel-body">
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]);
    ?>
    <?php Pjax::end(); ?>
        </div>
    </div>
</div>
