<?php
use yii\helpers\Url;
use app\models\Announcement;
use yii\web\View;
use yii\helpers\Html;
use app\models\Agency;
use cinghie\articles\models\ItemsGlobalSearch;


$this->title = 'Members';

$Agencies= Agency::find()->orderBy(['ordernumber'=>SORT_ASC])->all();
/* @var $this yii\web\View */
$this->title = 'OneLab Portal';
//$Announcement= Announcement::find()->where(['between','StartDate',date('Y-m-d'),date('Y-m-d')])
//        ->andWhere(['between','EndDate',date('Y-m-d'),date('Y-m-d')])->one();
$con= Yii::$app->db;
$SQL="SELECT * FROM `tbl_announcement` WHERE :curDate BETWEEN `StartDate` AND `EndDate`";
$Ann=$con->createcommand($SQL)->bindValue("curDate", date('Y-m-d'))->queryOne();
$AnnouncementID=$Ann['AnnouncementID'];
$Announcement= Announcement::find(['AnnouncementID'=>$AnnouncementID])->one();
if($Announcement){
   $ShowAnnouncement=$Announcement->Announcement;
   $CSSClass=$Announcement->getAnnouncementType()->where(['AnnouncementTypeID'=>$Announcement->AnnouncementTypeID])->select('CSSClass')->scalar(); 
}else{
   $ShowAnnouncement="No Announcement"; 
   $CSSClass="alert alert-info";
}

$script = <<< JS
$('#div_aboutNew').on('click', function(e) {
    $('html,body').animate({
        scrollTop: $(".about").offset().top},
        'slow');
});
$('#div_about').on('click', function(e) {
     window.open("/portal/about", '_self');
});
$('#div_members').on('click', function(e) {
    window.open("/portal/members", '_self');
});
$('#div_customer').on('click', function(e) {
    window.open("http://customer.onelab.ph", '_blank');
});



$('#div_services').on('click', function(e) {
    window.open("/portal/services", '_blank');
});
$('#div_referral').on('click', function(e) {
    window.open("/portal/referral", '_blank');
});
$('#div_payment').on('click', function(e) {
    window.open("/portal/payment", '_blank');
});
$('#div_payment').on('click', function(e) {
    window.open("/portal/payment", '_blank');
});
$('#div_support').on('click', function(e) {
    window.open("/portal/support", '_blank');
});
$('#div_support').on('click', function(e) {
    window.open("/portal/support", '_blank');
});
$('#div_newsfeed').on('click', function(e) {
    window.open("/portal/newsfeed", '_blank');
}); 
JS;
$this->registerJs($script, View::POS_END);
//echo Yii::getAlias('@web');
//var_dump(Yii::$app->controller->module->attachType);
?>

<style>
    .link-display {
        display: block;
        position: relative;
    }
    a {
        color: #000;
    }

    .border img {
        transition: .5s ease;
    }

    .border img:hover{
        box-shadow: 0 0 0 3px #3c8dbc;
        transition: .5s ease;
        background: transparent;
    }

    .div_ex
    {
        box-shadow: none;
        transition: .5s ease;
        background: transparent;
    }
    .div_ex:hover
    {

        box-shadow: 0 0 0 3px #3c8dbc;
        transition: .5s ease;

    }
    .onelab-content
    {
        max-height: 700px;
    }

</style>
<div class="site-index">
    <div class="body-content">

        <section id="aboutSection">
            <div class="about"  style="margin: 1%">
                <div class="note-box rounded" style="text-align: center;">
                    <div title="Important Notes" class="info-tab note-icon">&nbsp;</div>
                    <h3 class="alert alert-info">Welcome to OneLab Portal</h3>

                    <div class="row" style="margin:5px">

                        <div class="col-lg-4 col-xs-12" >
                            <!-- small box -->
                            <div id="div_about" class="small-box bg-primary rounded-corner" style="border-radius: 20px">
                                <div class="inner">
                                    <h3><span class="fa fa-info-circle"></span></h3>
                                    <h4>About OneLab</h4>
                                </div>
                                Information on how OneLab started, what services we offer, who we are and what we have achieved.
                                <div class="icon">
                                    <i class="fa fa-info-circle"></i>
                                </div>
                                <br>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12" >
                            <!-- small box -->
                            <div id="div_members" class="small-box bg-primary rounded-corner" style="border-radius: 20px">
                                <div class="inner">
                                    <h3><span class="fa fa-users"></span></h3>
                                    <h4>Members</h4>
                                </div>
                                List of Member Laboratories under OneLab. Members includes DOST-RSTL,DOST RDI and Non-DOST Laboratories 
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div id="div_customer" class="small-box bg-primary rounded-corner" style="border-radius: 20px">
                                <div class="inner">
                                    <h3><span class="fa fa-address-book"></span></h3>
                                    <h4>Customer Portal</h4>
                                </div>
                                An online information that provides detailed instructions to customers for their test and calibration requirements.
                                <div class="icon">
                                    <i class="fa fa-address-book"></i>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
    </div>
</div>