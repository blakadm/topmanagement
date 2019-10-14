<?php

use kartik\helpers\Html;

// Add Twitter Summary
Yii::$app->view->registerMetaTag([
	'property' => 'twitter:card', 
	'content'  => 'summary'
]);
// Add Twitter Title
Yii::$app->view->registerMetaTag([
	'property' => 'twitter:title', 
	'content'  => $this->title
]);
// Add Twitter Site Name
Yii::$app->view->registerMetaTag([
	'property' => 'twitter:site', 
	'content'  => Yii::$app->name
]);
// Add Twitter Description
if ($model->metadesc) {
	Yii::$app->view->registerMetaTag([
		'name'    => 'twitter:description', 
		'content' => Html::encode($model->metadesc)
	]);
}
// Add Twitter Author
if ($model->author) {
	Yii::$app->view->registerMetaTag([
		'name'    => 'twitter:creator', 
		'content' => Html::encode($model->author)
	]);
}
// Add Twitter Image
if ($model->image) {
	Yii::$app->view->registerMetaTag([
		'property' => 'twitter:image:src', 
		'content'  => Yii::$app->request->hostInfo.Html::encode($model->image)
	]);
}

?>