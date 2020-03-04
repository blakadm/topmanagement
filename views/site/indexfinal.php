<?php

use yii\helpers\Url;
use app\models\Announcement;
use yii\web\View;
use yii\helpers\Html;
use app\models\Agency;
use cinghie\articles\models\ItemsGlobalSearch;

$this->title = 'Members';

$Agencies = Agency::find()->orderBy(['ordernumber' => SORT_ASC])->all();
/* @var $this yii\web\View */
$this->title = 'OneLab Portal';
//$Announcement= Announcement::find()->where(['between','StartDate',date('Y-m-d'),date('Y-m-d')])
//        ->andWhere(['between','EndDate',date('Y-m-d'),date('Y-m-d')])->one();
$con = Yii::$app->db;
$SQL = "SELECT * FROM `tbl_announcement` WHERE :curDate BETWEEN `StartDate` AND `EndDate`";
$Ann = $con->createcommand($SQL)->bindValue("curDate", date('Y-m-d'))->queryOne();
$AnnouncementID = $Ann['AnnouncementID'];
$Announcement = Announcement::find(['AnnouncementID' => $AnnouncementID])->one();
if ($Announcement) {
    $ShowAnnouncement = $Announcement->Announcement;
    $CSSClass = $Announcement->getAnnouncementType()->where(['AnnouncementTypeID' => $Announcement->AnnouncementTypeID])->select('CSSClass')->scalar();
} else {
    $ShowAnnouncement = "No Announcement";
    $CSSClass = "alert alert-info";
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

    .img-responsive {
        margin: 0 auto;

    }

    .bannerBG {
        width: 100%;
        height: auto;
        float: left;

    }

    .inner-heading {
        width: 100%;
        height: auto;
        float: left;
        font-size: 25px;
        color: 
            #066da9;

        line-height: 45px;
        margin: 10px 0px;
    }

    .inner-txt {
        width: 100%;
        height: auto;
        float: left;
        color: 
            #000;
        text-align: justify;
        font-size: 15px;
    }

    .imageresponsive{
        width: 100%;
        height: auto;
        float: left;
    }

    .contentnew {
        margin-right: auto;
        padding:unset !important;
        padding-left:unset !important;

    }
    
        .span4 img {
    margin-right: 10px;
}
.span4 .img-left {
    float: left;
    width: 100px; height: 100px;
}
.span4 .img-right {
    float: right;
}

.img-circle {
    height: 100px;
    width: 100px;
}

.strongcolor{
    color: #024a74
}

.content-wrapper {
    min-height: 100%;
    background-color: 
    #ecf0f5;
    z-index: 800;
}

</style>
<div class="site-index">
    <div class="content-wrapper">

        <section>
            <div>
                <div class="bannerBG">
                    <img src="/images/homebackground.png" class="imageresponsive">
                </div>
            </div>
        </section>

        <section>

            <div class="row" style="padding:2%">


                <div class="body_main_bg">

                    <div class="col-xs-12 col-md-12">

                        <div class="container">
                            <br>

                            <div class="content-bg">



                                <div class="inner-heading"><i class="fa fa-angle-double-right" style="color:#066da9;font-size:1em;margin-right: 10px"></i>History</div>

                                <div class="inner-txt">

                                    In 2012, the President instructed the Department of Science and Technology (DOST) to initiate the harmonization of testing laboratories in the country. The challenge at that time was to establish a framework that will address issues on harmonization, collaboration, and interfacing among laboratories while respecting their mandates and regulatory functions. This brought about the establishment of a laboratory network known as the “One-stop Laboratory Services for Global Competitiveness (OneLab). 
                                    <br>
                                </div>

                                <div class="inner-heading"><i class="fa fa-angle-double-right" style="color:#066da9;font-size:1em;margin-right: 10px"></i>Mission</div>

                                <div class="inner-txt">
                                 To provide global access to comprehensive analytical and calibration services at a single touch point.  
                                    
                                    <br/>
                                </div>
                                <div class="inner-heading"><i class="fa fa-angle-double-right" style="color:#066da9;font-size:1em;margin-right: 10px"></i>Vision</div>
                                <div class="inner-txt">
                                To be globally-recognized network of analytical and calibration laboratories distinguished for quality, proficient services and ultimate customer convenience.
                                </div>
                                <div class="inner-heading"><i class="fa fa-angle-double-right" style="color:#066da9;font-size:1em;margin-right: 10px"></i>What is OneLab</div>

                                <div class="inner-txt">

                                    A Network of laboratories aimed at ensuring availability and broadening public access to testing and calibration services at a single touchpoint through an IT-based platform. OneLab uniquely facilitates the seamless laboratory transaction from sample receipt to release of test result as facilitated by the OneLab Referral System. With this efficient system, you get the fastest turn-around time and expanded test offerings in the market.
                                    Provide relevant and efficient laboratory services for industries, research institutions, other government & Non-government sectors and general public. Offer wider scope of services for different materials and products.



                                    Currently, OneLab has 16 DOST Regional Standard and Testing Laboratories(RSTL), 6 DOST Research and Development Institute(RDI) laboratories, 4 government agencies and 19 private local laboratories and 8 international laboratories  as members. For full details please click the <strong class="strongcolor"><a href="portal/network">Our Network </a></strong> section.



                                </div>

                                <br>

                            </div>
                            <div class="inner-heading"><i class="fa fa-angle-double-right" style="color:#066da9;font-size:1em;margin-right: 10px"></i>Awards and Recognition</div>

                            <div class="inner-txt">
                                <div style='text-indent: 2%'><i class="fa fa-dot-circle-o" style="color:#066da9;font-size:1em;"></i> &nbsp&nbsp&nbsp<strong class='strongcolor'>Benita & Catalino Yap Foundation (BCYF) Innovation Award</strong> under the government category.</div>
                                <div style='text-indent: 2%'><i class="fa fa-dot-circle-o" style="color:#066da9;font-size:1em;"></i> &nbsp&nbsp&nbspAwarded by  Development Academy of the Philippines (DAP)<strong class='strongcolor'> as Government Best Practice Recognition</strong> for 2017.</div>
                                <div style='text-indent: 2%'><i class="fa fa-dot-circle-o" style="color:#066da9;font-size:1em;"></i> &nbsp&nbsp&nbspRecognized as One of the <strong class='strongcolor'>Top 10 Best Practices</strong> in 6th International Best Practice Competition on 2018 held at Abu Dhabi, Dubai.</div>
                              
                            </div>

                            
                            
                            <div class="inner-heading"><i class="fa fa-angle-double-right" style="color:#066da9;font-size:1em;margin-right: 10px"></i>Project Management Team</div>
                            <strong class='strongcolor'>
                            <div class="row" style="width:90%">
                               
                                <div class="col-lg-6 col-xs-12">
                                   <div class="span4" style='padding-left: 4%'>
                                        <img class="img-left" src="/images/projectleader.png"/>
                                        <p>Rosemarie S. Salazar<br>
                                        DOST-IX (Assistant Reg'l Director for FASTS)<br>
                                        Onelab Project Leader</p>
                                       
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-xs-12">
                                   <div class="span4" style='padding-left: 4%'>
                                        <img class="img-left" src="/images/southluzon.png"/>
                                        <p>Dr. Alexander R. Madrigal<br>
                                        DOST-CALABARZON Regional Director<br>
                                        South Luzon Cluster Head</p>
                                       
                                    </div>
                                </div>
                             
                            </div>
                            <div class="row" style="width:90%">
                                
                                 <div class="col-lg-6 col-xs-12">
                                   <div class="span4" style='padding-left: 4%'>
                                        <img class="img-left" src="/images/rdi.png"/>
                                        <div class="content-heading">Dr. Annebelle V. Briones</div>
                                        <p>ITDI Director<br>
                                        OneLab Co-Project Leader / RDI Cluster Head</p>
                                    
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-xs-12">
                                   <div class="span4" style='padding-left: 4%'>
                                        <img class="img-left" src="/images/visayas.png"/>
                                        <p>Engr. Rowen R. Gelonga<br>
                                        DOST-VI Regional Director<br>
                                        Visayas Cluster Head</p>
                                       
                                    </div>
                                </div>
                           
                            </div>
                            <div class="row" style="width:90%">
                                
                                 <div class="col-lg-6 col-xs-12">
                                   <div class="span4" style='padding-left: 4%'>
                                        <img class="img-left" src="/images/mindanao.png"/>
                                        <p>Dr. Anthony C. Sales, CESO III<br>
                                        DOST-XI Regional Director<br>
                                        Mindanao Cluster Head</p>
                                    
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-xs-12">
                                   <div class="span4" style='padding-left: 4%'>
                                        <img class="img-left" src="/images/northluzon.png"/>
                                        <p>Dr. Julius Ceasar V. Sicat<br>
                                        DOST-III Regional Director<br>
                                        North Luzon Cluster Head</p>
                                       
                                    </div>
                                </div>
                        
                            </div>
                        </strong>
                        </div>
                    </div>   
                </div>
            </div>








    
   







</section>
         </div>
</div>
