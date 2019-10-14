<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Menu */

$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
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
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Menu</div>
        <div class="panel-body">
    <p>
        <?= Html::a(Yii::t('rbac-admin', 'Create Menu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'menuParent.name',
                'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                    'class' => 'form-control', 'id' => null
                ]),
                'label' => Yii::t('rbac-admin', 'Parent'),
            ],
            'route',
            'order',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
<?php Pjax::end(); ?>
        </div>
    </div>
</div>
