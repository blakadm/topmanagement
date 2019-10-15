<?php
use yii\helpers\Url;
use app\models\Announcement;
use yii\web\View;
use cinghie\articles\models\ItemsGlobalSearch;
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
$this->params['breadcrumbs'][] = $this->title;
$script = <<< JS
$('#div_about').on('click', function(e) {
    window.open("/portal/about", '_blank');
});
$('#div_services').on('click', function(e) {
    window.open("/portal/services", '_blank');
});
$('#div_customer').on('click', function(e) {
    window.open("https://customer.onelab.ph/#/", '_blank');
});
$('#div_referral').on('click', function(e) {
    window.open("/portal/referral", '_blank');
});
$('#div_payment').on('click', function(e) {
    window.open("/portal/payment", '_blank');
});
$('#div_members').on('click', function(e) {
    window.open("/portal/members", '_blank');
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
<div class="site-index">
    <div class="body-content">
       <div class="row">
           <div class="col-lg-4 col-xs-7">
               <!-- small box -->
               <div id="div_about" class="small-box bg-green rounded-corner" style="border-radius: 20px">
                   <div class="inner">
                       <h3><span class="fa fa-adn"></span></h3>
                       <h4>About OneLab</h4>
                   </div>
                   <div class="icon">
                       <i class="ion ion-android-home"></i>
                   </div>
                   <span class="small-box-footer">Goto Page <i class="fa fa-arrow-circle-right"></i></span>
               </div>
           </div>
            <div class="col-lg-4 col-xs-7">
                <!-- small box -->
                <div id="div_customer" class="small-box bg-light-blue-gradient rounded-corner" style="border-radius: 20px">
                    <div class="inner">
                        <h3><span class="fa fa-user-circle-o"></span></h3>
                        <h4>Customer Portal</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <span class="small-box-footer">Goto Page <i class="fa fa-arrow-circle-right"></i></span>
                </div>
            </div>
            <div class="col-lg-4 col-xs-7">
                <!-- small box -->
                <div id="div_members" class="small-box bg-primary rounded-corner" style="border-radius: 20px">
                    <div class="inner">
                        <h3><span class="fa fa-address-book"></span></h3>
                        <h4>Members</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <span class="small-box-footer">Goto Page <i class="fa fa-arrow-circle-right"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <?php  
        $searchModel = new ItemsGlobalSearch();
        $searchModel->state=1;
        if(Yii::$app->request->queryParams==''){
            $Param="";
        }else{
            $Param=Yii::$app->request->queryParams;
        }
        $dataProvider = $searchModel->search($Param);
        echo $this->render('..\portal\newsfeed.php', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        ?>
    </div>
</div>

