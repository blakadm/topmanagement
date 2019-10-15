<?php

/* 
 * This is a sample Status Tracking written in css
 * Created: August 11, 2017
 *
 */
use dosamigos\datepicker\DateRangePicker;
use yii\widgets\ActiveForm;
use dosamigos\highcharts\HighCharts;
if(Yii::$app->request->post()){
    $ChartType=$_POST['chart_type'];
}else{
    $ChartType="line";
}
?>
<div class="row">
    <div class="col-md-4">
        <?=
        DateRangePicker::widget([
            'name' => 'date_from',
            'value' => '08-11-2017',
            'nameTo' => 'name_to',
            'valueTo' => '08-11-2017',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd-M-yyyy'
            ]
        ]);
        ?>
    </div>
</div>
<div class="row shop-tracking-status">
    <div class="col-md-12">
        <div class="well">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="inputOrderTrackingID" class="col-sm-2 control-label">Order id</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputOrderTrackingID" value="" placeholder="# put your order id here">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" id="shopGetOrderStatusID" class="btn btn-success">Get status</button>
                    </div>
                </div>
            </div>
            <h4>Your order status:</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="prefix">Date created:</span>
                    <span class="label label-success">12.12.2013</span>
                </li>
                <li class="list-group-item">
                    <span class="prefix">Last update:</span>
                    <span class="label label-success">12.15.2013</span>
                </li>
                <li class="list-group-item">
                    <span class="prefix">Comment:</span>
                    <span class="label label-success">customer's comment goes here</span>
                </li>
                <li class="list-group-item">You can find out latest status of your order with the following link:</li>
                <li class="list-group-item"><a href="//tracking/link/goes/here">//tracking/link/goes/here</a></li>
            </ul>
            <div class="order-status">
                <div class="order-status-timeline">
                    <!-- class names: c0 c1 c2 c3 and c4 -->
                    <div class="order-status-timeline-completion c2"></div>
                </div>
                <div class="image-order-status image-order-status-new active img-circle">
                    <span class="status">Accepted</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-active active img-circle">
                    <span class="status">In progress</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-intransit active img-circle">
                    <span class="status">Shipped</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-delivered active img-circle">
                    <span class="status">Delivered</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-completed active img-circle">
                    <span class="status">Completed</span>
                    <div class="icon"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <select name="chart_type" onchange="this.form.submit()">
        <option value="line" selected>Line Graph</option>
        <option value="bar">Bar Chart</option>
        <option value="pie">Pie Chart</option>
        <option value="column">Column Stack</option>
        <option value="area">Area</option>
        <option value="scatter">Scatter</option>
    </select>
</div>
<?php ActiveForm::end(); ?>
<?=
HighCharts::widget([
    'clientOptions' => [
        'chart' => [
                'type' =>$ChartType
        ],
        'title' => [
             'text' => 'Programming Languages'
             ],
        'xAxis' => [
            'categories' => [
                '2011',
                '2012',
                '2013',
                '2014',
                '2015',
                '2016',
                '2017'
            ]
        ],
        'legend'=>['text'=>'Programming Skills'],
        'yAxis' => [
            'title' => [
                'text' => 'Programming Skills'
            ]
        ],
        'series' => [
            ['name' => 'VB6', 'data' => [290, 200, 180,100,78,50,10]],
            ['name' => 'VB.net', 'data' => [19, 30, 40,56,78,89,120]],
            ['name' => 'Java', 'data' => [5, 60, 70,78,89,150,350]],
            ['name' => 'PHP', 'data' => [12, 68, 75,88,90,250,450]]
        ]
    ]
]);
?>
