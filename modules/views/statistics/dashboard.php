
<?php


use kartik\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Top Management', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = ['label' => 'Statistics Dashboard', 'url' => ['/toplevel/statistics/dashboard']];
$this->params['breadcrumbs'][] = 'Accomplishment - Dashboard XXX'; // $this->title;


?>


<style type="text/css">
    
.hi-icon-wrap {
	text-align: center;
	margin: 0 auto;
        background: blue;
	padding: 2em 0 3em;
}
    /* Effect 8 */
.hi-icon-effect-8 .hi-icon {
	background: rgba(255,255,255,0.1);
	-webkit-transition: -webkit-transform ease-out 0.1s, background 0.2s;
	-moz-transition: -moz-transform ease-out 0.1s, background 0.2s;
	transition: transform ease-out 0.1s, background 0.2s;
}

.hi-icon-effect-8 .hi-icon:after {
	top: 0;
	left: 0;
	padding: 0;
	z-index: -1;
	box-shadow: 0 0 0 2px rgba(255,255,255,0.1);
	opacity: 0;
	-webkit-transform: scale(0.9);
	-moz-transform: scale(0.9);
	-ms-transform: scale(0.9);
	transform: scale(0.9);
}

.hi-icon-effect-8 .hi-icon:hover {
	background: rgba(255,255,255,0.05);
	-webkit-transform: scale(0.93);
	-moz-transform: scale(0.93);
	-ms-transform: scale(0.93);
	transform: scale(0.93);
	color: #fff;
}

.hi-icon-effect-8 .hi-icon:hover:after {
	-webkit-animation: sonarEffect 1.3s ease-out 75ms;
	-moz-animation: sonarEffect 1.3s ease-out 75ms;
	animation: sonarEffect 1.3s ease-out 75ms;
}

@-webkit-keyframes sonarEffect {
	0% {
		opacity: 0.3;
	}
	40% {
		opacity: 0.5;
		box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px #3851bc, 0 0 0 10px rgba(255,255,255,0.5);
	}
	100% {
		box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px #3851bc, 0 0 0 10px rgba(255,255,255,0.5);
		-webkit-transform: scale(1.5);
		opacity: 0;
	}
}
@-moz-keyframes sonarEffect {
	0% {
		opacity: 0.3;
	}
	40% {
		opacity: 0.5;
		box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px #3851bc, 0 0 0 10px rgba(255,255,255,0.5);
	}
	100% {
		box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px #3851bc, 0 0 0 10px rgba(255,255,255,0.5);
		-moz-transform: scale(1.5);
		opacity: 0;
	}
}
@keyframes sonarEffect {
	0% {
		opacity: 0.3;
	}
	40% {
		opacity: 0.5;
		box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px #3851bc, 0 0 0 10px rgba(255,255,255,0.5);
	}
	100% {
		box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px #3851bc, 0 0 0 10px rgba(255,255,255,0.5);
		transform: scale(1.5);
		opacity: 0;
	}
}
</style>


<div class="row">

</div>

<div class="row" >
 <?php
 if((Yii::$app->user->identity->ismanagement==true) &&  (Yii::$app->user->identity->type=='Top'))
 {
           //       echo $this->render('_topdashboard');
 }
?>
</div>

<div class="row" >
 <?php
  if((Yii::$app->user->identity->ismanagement) &&  (strtolower(Yii::$app->user->identity->type)!='top'))
 {
                 // echo $this->render('_rstltopdashboard');
 }
?>
</div>



<style type="text/css">
    a.icon{
  text-decoration:none;
  color:#f00;
}

.fa-user:after {
    content: "\f007";
  display: block;
}

.fa-user:before {
    position: absolute;
}

.icon:hover:before{
    -webkit-animation: pulse 2s ease-in;
    -moz-animation: pulse 2s ease-in;
     animation: pulse 2s ease-in;
    -webkit-animation-iteration-count: infinite;
    -moz-animation-iteration-count: infinite;
    animation-iteration-count: infinite;    
}
@keyframes pulse {
  0% {
    -webkit-transform: scale(1);
    opacity: 0.0;
 }
 25% {
    -webkit-transform: scale(1.35);
    opacity: 0.1;
 }
 50% {
    -webkit-transform: scale(1.7);
    opacity: 0.3;
 }
 75% {
    -webkit-transform: scale(2.05);
    opacity: 0.5;
 }
 100% {
    -webkit-transform: scale(2.4);
    opacity: 0.0;
 }
}
</style>





