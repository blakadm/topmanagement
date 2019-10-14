<?php

/**
 * @var \cinghie\articles\models\Items $model
 */

use cinghie\articles\assets\ArticlesAsset;
use kartik\helpers\Html;
use kartik\social\FacebookPlugin;
use kartik\social\TwitterPlugin;

// Load Articles Assets
ArticlesAsset::register($this);
$asset = $this->assetBundles['cinghie\articles\assets\ArticlesAsset'];

// Set Title and Breadcrumbs
$this->title = Html::encode($model->title);
$this->params['breadcrumbs'][] = Html::encode($model->alias);

/* Render MetaData */
$this->render('@vendor/cinghie/yii2-articles/views/default/_meta_data.php',[ 'model' => $model,]);

/* Facebook Open Graph */
$this->render('@vendor/cinghie/yii2-articles/views/default/_meta_facebook.php',[ 'model' => $model,]);

/* Twitter Card */
$this->render('@vendor/cinghie/yii2-articles/views/default/_meta_twitter.php',[ 'model' => $model,]);
//Meta Tag
$this->registerMetaTag([
    'name' => 'fb:app_id',
    'content' => '2019616858321571'
]);
?>

<article class="item-view">
	<header>
    	<h1><?= Html::encode($this->title) ?></h1>
        <time pubdate datetime="<?= $model->created ?>"></time>
    </header>
    <div class="row item-informations">
        <div class="col-md-12">
            <?php 
            if($model->user_id== Yii::$app->user->id){//Author ?>
            <a href="/articles/items/update?id=<?= $model->id ?> " title="Edit Article"><span class="fa fa-edit"> Edit </span></a>
            <?php } ?>
            <span class="item-created">
                <i class="fa fa-calendar"></i> <?= Yii::t('articles','Published on') ?> <?= date_format(date_create($model->created),'m/d/Y H:i A') ?>
            </span>
            <span class="item-created">
                <span class="fa fa-address-book"> <?= Yii::t('traits','by: ') ?> <?= $model->createdBy->username ?> </span>
            </span>
            <span class="item-created">
                <span class="fa fa-briefcase"> <?= Yii::t('traits','Category: ') ?> <?= $model->category->name ?> </span>
            </span>
            <hr style="margin-bottom: 5px;margin-top: 5px">
        </div>
        <div class="row" style="padding-left: 15px;margin-bottom: 5px">
            <div class="col-sm-1" style="padding-top: 3px;margin-left: 0px">
            <?php echo FacebookPlugin::widget(['type'=>FacebookPlugin::SHARE, 'settings' => ['size'=>'small', 'layout'=>'button_count', 'mobile_iframe'=>'false']]); ?>
            </div>
            <div class="col-sm-1" style="padding-top: 3px;margin-left: 0px">
                <?php echo TwitterPlugin::widget(['type'=>TwitterPlugin::SHARE, 'settings' => ['size'=>'default']]); ?>
            </div>
            <div class="col-sm-1" style="padding-top: 3px;margin-left: 0px">
                <?php echo FacebookPlugin::widget(['type'=>FacebookPlugin::LIKE, 'settings' => ['size'=>'small']]); ?>
            </div>
        </div>
    </div>
    <?php //if ($model->introtext && $model->getOption($model->category->params,"itemIntroText") == "Yes"): ?>
    <div class="row item-content">
        <div class="col-md-12">
            <?php if ($model->fulltext): ?>
                <div class="full-text">
                    <?= $model->fulltext ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <hr style="margin-bottom: 5px;margin-top: 5px">
    <div class="row">
        <div class="col-sm-8">
            <?php echo FacebookPlugin::widget(['type'=>FacebookPlugin::COMMENT, 'settings' => ['data-width'=>1000, 'data-numposts'=>5]]); ?>
        </div>
    </div>
</article>
<?php /* if($model->getOption($model->category->params,"itemDebug") == "Yes"): ?>
<div class="items-view-debug">
    <h2>Item Debug</h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'alias',
            'cat_id',
            'user_id',
            'state',
            'access',
            'language',
            'ordering',
            'hits',
            'image:ntext',
            'image_caption',
            'image_credits',
            'video:ntext',
            'video_caption',
            'video_credits',
            'created',
            'created_by',
            'modified',
            'modified_by',
            'params:ntext',
            'metadesc:ntext',
            'metakey:ntext',
            'robots',
            'author',
            'copyright',
        ],
    ]) ?>
</div>
<?php endif; */ ?>
