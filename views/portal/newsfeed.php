<?php
use app\models\Post;
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use app\models\Agency;
use cinghie\articles\models\ItemsGlobalSearch;

$this->title = 'News Feed';

$searchModel = new ItemsGlobalSearch();
$searchModel->state=1;
if(Yii::$app->request->queryParams==''){
    $Param="";
}else{
    $Param=Yii::$app->request->queryParams;
}
$dataProvider = $searchModel->search($Param);


?>
<style type="text/css">
    .onelab-content
    {
        max-height: 1500px;
    }
</style>

<div class="content">
    <div class="note-box rounded">
        <div title="Important Notes" class="info-tab note-icon">&nbsp;</div>
        <h3 class="alert alert-info">News Feed</h3>
        <div class="onelab-content">

            <div class="article-content">
                <form name="searchForm" action="/portal/newsfeed" method="GET">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                        </span>
                        <input type="text" name="ItemsSearch[title]" class="form-control" placeholder="Enter Title to Search">
                    </div>
                </form>
                <hr>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'format' => 'raw',
                            'value' => function($model) {
                                $content = '<div class="panel panel-default">';
                                $content .= '<div class="panel-heading"><span class="postInfo">Written by: <a href="#">' . $model->author . '</a></span> Publish on: <i class="fa fa-calendar"></i> ' . date_format(date_create($model->created), 'F d, Y h:i A') . '</div>';
                                $content .= '<div class="panel-body">';
                                $content .= '<h3><a href="/articles/items/view/' . $model->id . '">' . $model->title . '</a></h3>';
                                $content .= $model->introtext . '<a class="btn-link" href="/articles/items/view/' . $model->id . '">Continue Reading...</a>';
                                $content .= '</div></div>';
                                return $content;
                            },
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
