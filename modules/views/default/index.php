<?php
use yii\helpers\Url;
use yii\web\View;
use app\models\Announcement;
/* @var $this yii\web\View */
$this->title = 'Top Management';
$PostedData=Yii::$app->PostedData->GetPostedData();
//$Announcement= Announcement::find()->where(['between',':TodayDate','StartDate','EndDate'])->one();
//var_dump($Announcement);
//exit;
$js="
    function OpenLink(link){
       location.href=link;
    }
    $('#toplevel').addClass('active');
    $('#onelabportal').removeClass('active');
";
$this->registerJs($js, View::POS_END);
$this->params['breadcrumbs'][] = $this->title;
$mClass="col-lg-8 col-xs-12";
?>
<div class="row" style="padding-bottom: 10px">
<div class="col-lg-4 col-xs-12">
        <div class="col-lg-4 box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h4 class="box-title">RSTL Posted as of <?= date('m/d/Y h:i A') ?></h4>
            </div>
            <div class="box-body" style="overflow-y: scroll;min-height: 430px;max-height: 430px;margin-bottom: 10px">
                <?=$PostedData; ?>
            </div>
        </div>
</div>
<div class="col-lg-8 col-xs-12">
    <ul id="categories" class="clr">
        <li class="pusher"></li>
        <li>
            <div onclick="OpenLink('/toplevel/data/referral')">
                <img src="/images/referral.png" alt=""/>
                <h1>Referral System</h1>
                <p>This is OneLab Referral System</p>
            </div>
        </li>
        <li>
            <div onclick="OpenLink('/toplevel/data/rquest')">
                <img src="/images/request.png" alt=""/>
                <h1>Request</h1>
                <p>Customer's Transactions</p>
            </div>
        </li>
        <li>
            <div onclick="OpenLink('/toplevel/data/statistics')">
                <img src="/images/statistics.png" alt=""/>
                <h1>Statistics</h1>
                <p>Shows Statistical data.</p>
            </div>
        </li>
        <li>
            <div onclick="OpenLink('/toplevel/data/equipment')">
                <img src="/images/equipment.png" alt=""/>
                <h1>Equipment & Supplies</h1>
                <p>Show the list of Equipment and supplies</p>
            </div>
        </li>
        <li class="pusher"></li>
        <li>
            <div onclick="OpenLink('/toplevel/data/customers')">
                <img src="/images/customers.png" alt=""/>
                <h1>Customers</h1>
                <p>This is a list for all the customers of OneLab System</p>
            </div>
        </li>

        <li>
            <div onclick="OpenLink('/toplevel/data/members')">
                <img src="/images/members.png" alt=""/>
                <h1>Members</h1>
                <p>List all the members of OneLab</p>
            </div>
        </li>
        <li class="pusher"></li>
    </ul>
  </div>
</div>
