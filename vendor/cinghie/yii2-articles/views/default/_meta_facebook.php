<?php

use kartik\helpers\Html;
use yii\helpers\Url;

// Add Facebook Title
Yii::$app->view->registerMetaTag([
	'property' => 'og:title', 
	'content'  => Html::encode($this->title)
]);
// Add Facebook Image
if ($model->image) {
	Yii::$app->view->registerMetaTag([
		'property' => 'og:image', 
		'content'  => Yii::$app->request->hostInfo.Html::encode($model->image)
	]);
}
// Add Facebook Author
if ($model->author) {
	Yii::$app->view->registerMetaTag([
		'name'    => 'article:author', 
		'content' => Html::encode($model->author)
	]);
}
// Add Facebook Author
if ($model->copyright) {
	Yii::$app->view->registerMetaTag([
		'property'    => 'article:publisher', 
		'content' => Html::encode('https://www.facebook.com/DOSTOnelab')
	]);
}
// Add Facebook Site Name
Yii::$app->view->registerMetaTag([
	'property' => 'og:site_name', 
	'content'  => Yii::$app->name
]);
// Add Facebook URL
Yii::$app->view->registerMetaTag([
	'property' => 'og:url', 
	'content'  => Yii::$app->request->hostInfo.Yii::$app->request->url
]);
// Add Facebook Description
if ($model->metadesc) {
	Yii::$app->view->registerMetaTag([
		'property'    => 'og:description', 
		'content' => Html::encode($model->metadesc)
	]);
}
// Add Facebook Type
Yii::$app->view->registerMetaTag([
	'property' => 'og:type', 
	'content'  => 'article'
]);
Yii::$app->view->registerMetaTag([
	'property' => 'fb:app_id', 
	'content'  => '2019616858321571'
]);
Yii::$app->view->registerMetaTag([
	'property' => 'fb:admins', 
	'content'  => '100001313776918'
]);
?>