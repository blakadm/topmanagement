<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use dosamigos\highcharts\HighCharts;
use yii\web\View;

$js="
$('#onelabportal').removeClass('active');
$('#toplevel').addClass('active');
";
$this->registerJs($js, View::POS_END);
$this->title="Members";
$this->params['breadcrumbs'][] = ['label' => 'Top Level', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-lg-4 col-xs-6">
    <div class="col-lg-8 box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">RSTL Posted as of September 14, 2017</h3>
        </div>
        <div class="box-body" style="overflow-y: scroll;min-height: 300px;max-height: 300px;margin-bottom: 10px">
            <?=Yii::$app->PostedData->GetPostedData(); ?>
        </div>
    </div>
</div>
<div class="col-lg-4 col-xs-6">
    <div class="col-lg-8 box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">RSTL Posted as of September 14, 2017</h3>
        </div>
        <div class="box-body" style="overflow-y: scroll;min-height: 300px;max-height: 300px;margin-bottom: 10px">
            
        </div>
    </div>
</div>
<div class="col-lg-4 col-xs-6">
    <div class="col-lg-8 box box-primary">
        <div class="box-header">
            <i class="fa fa-bar-chart-o"></i>
            <h3 class="box-title">RSTL Income for the First Quarter</h3>
        </div>
        <div class="box-body" style="overflow-y: scroll;min-height: 300px;max-height: 300px;margin-bottom: 10px">
            <?=
            HighCharts::widget([
                'clientOptions' => [
                    'chart' => [
                        'type' => 'bar'
                    ],
                    'title' => [
                        'text' => 'Income for first quarter of 2017 '
                    ],
                    'xAxis' => [
                        'categories' => [
                            'Jan',
                            'Feb',
                            'Mar'
                        ]
                    ],
                    'yAxis' => [
                        'title' => [
                            'text' => 'Income'
                        ]
                    ],
                    'series' => [
                        ['name' => 'DOST-I', 'data' => [14345, 20000, 46789]],
                        ['name' => 'DOST-II', 'data' => [600, 7065, 3500]]
                    ]
                ]
            ]);
            ?>
        </div>
    </div>
</div>   
</div>
