<?php
/* @var $this yii\web\View */
use yii\web\View;
use dosamigos\highcharts\HighCharts;

$this->title = 'Statistics Dashboard';
$this->params['breadcrumbs'][] = ['label' => 'Top Management', 'url' => ['/toplevel']];
$this->params['breadcrumbs'][] = $this->title;

$js="
$('#onelabportal').removeClass('active');
$('#toplevel').addClass('active');
";
$this->registerJs($js, View::POS_END);
$mClass="col-lg-4 col-xs-12";
?>

  <style type="text/css">
        .rounded-corner {
    border-radius: 10px;
    border: 5px solid #066da9;
}
 </style>

<div class="row" style="padding-bottom: 10px">

  

<div class="<?= $mClass ?>">
        <div class="big-box rounded-corner mycontainer" style="margin-top: 10px">
            <?php
                $Categories=['categories'=>['DOST-I','DOST-II','DOST-IX','ARMM']];
                $Series=[
                    ['name' => 'Chem', 'data' => [45, 20, 9, 0]],
                    ['name' => 'Micro', 'data' => [70,165, 59, 10]],
                    ['name' => 'Metro', 'data' => [15,35, 59, 100]],
                   
                ];
                Yii::$app->PostedData->GenerateChart("Fee","column","Fees","Graph shows comparisons of INCOME on all regions including by laboratories and monthly distributions","/toplevel/statistics/income",$Categories,$Series);
            ?>
            <div class="overlay" onclick="location.href='/toplevel/statistics/accomplishments?type=Fees'">
                <div class="text">Click to proceed</div>
            </div>
        </div>
</div>   
<div class="<?= $mClass ?>">
        <div class="big-box rounded-corner mycontainer" style="margin-top: 10px">
            <?php
                $Categories=['categories'=>['Jan','Feb','Mar']];
                $Series=[
                    ['name' => 'Summary', 'data' => [3325,980,345]],
                    ['name' => 'DOST-I', 'data' => [2000,980,345]],
                    ['name' => 'DOST-II', 'data' => [7065, 3500,4567]]
                ];
                Yii::$app->PostedData->GenerateChart("Trans","column","Transactions","Graph shows comparisons of SAMPLES on all regions including by laboratories and monthly distributions","/toplevel/statistics/transactions",$Categories,$Series,365,230,"sand-signika","0.f");  
            ?>
            <div class="overlay" onclick="location.href='/toplevel/statistics/accomplishments?type=Samples'">
                <div class="text">Click to proceed</div>
            </div>
        </div>
</div>   
<div class="<?= $mClass ?>">
        <div class="big-box rounded-corner mycontainer" style="margin-top: 10px">
            <?php
                $Categories=['categories'=>['Jan','Feb','Mar','Apr']];
                $Series=[
                    ['name' => 'DOST-I', 'data' => [1, 90, 4,13]],
                    ['name' => 'DOST-II', 'data' => [15, 67, 3,32]],
                    ['name' => 'DOST-III', 'data' => [15,8, 13,33]],
                    ['name' => 'DOST-IV', 'data' => [25, 87, 3,3]]
                ];
                Yii::$app->PostedData->GenerateChart("equip","column","Amount","Graph shows comparisons of TESTS on all regions including by laboratories and monthly distributions","/toplevel/statistics/equipment",$Categories,$Series);
            ?>
            <div class="overlay" onclick="location.href='/toplevel/statistics/accomplishments?type=Tests'">
                <div class="text">Click to proceed</div>
            
                
            </div>
        </div>
</div>   
<div class="<?= $mClass ?>">
    
        <div class="big-box rounded-corner mycontainer" style="margin-top: 10px">
           
            <?php
                $Categories=['categories'=>['Jan','Feb','Mar','Apr']];
                $Series=[
                    ['name' => 'DOST-I', 'data' => [8, 67, 45,13]],
                    ['name' => 'DOST-II', 'data' => [15, 167, 43,632]],
                    ['name' => 'DOST-III', 'data' => [95,80, 130,330]],
                    ['name' => 'DOST-IV', 'data' => [250, 817, 23,800]]
                ];
                Yii::$app->PostedData->GenerateChart("Req","column","# of Samples","Graph shows comparisons of CUSTOMERS on all regions including by laboratories and monthly distributions","/toplevel/statistics/request",$Categories,$Series,365,230,"sand-signika","0.f");
            ?>
            
           
            
            <div class="overlay" onclick="location.href='/toplevel/statistics/accomplishments?type=Customers'">
                <div class="text">Click to proceed</div>
            </div>
        </div>
         
</div>   
<div class="<?= $mClass ?>">
        <div class="big-box rounded-corner mycontainer" style="margin-top: 10px">
            <?php
                $Categories=['categories'=>['DOST-I','DOST-II','DOST-III','DOST-IV','DOST-V','DOST-VI','DOST-VII','DOST-VIII','DOST-IX']];
                $Series=[
                    [
                    'name'=>'RSTL',
                    'colorByPoint'=> true,
                    'type'=>'pie',
                        'data'=>[
                            ['name' => 'DOST-I', 'y' => 61.14,'sliced'=>true,'selected'=>true],
                            ['name' => 'DOST-II', 'y' => 230],
                            ['name' => 'DOST-III', 'y' => 130],
                            ['name' => 'DOST-IV', 'y' => 80],
                            ['name' => 'DOST-V', 'y' => 330],
                            ['name' => 'DOST-VI', 'y' => 630],
                            ['name' => 'DOST-VII', 'y' => 1230],
                            ['name' => 'DOST-VIII', 'y' => 210],
                            ['name' => 'DOST-IX', 'y' => 2230]
                        ]
                    ],
                ];
                Yii::$app->PostedData->GenerateChart("Customer","pie","# of Customers","Graph shows comparisons of NEW CUSTOMERS on all regions including by laboratories and monthly distributions","/toplevel/statistics/customers",$Categories,$Series);
            ?>
            <div class="overlay" onclick="location.href='/toplevel/statistics/accomplishments?type=New Customers'">
                <div class="text">Click to proceed</div>
            </div>
        </div>
</div>
<div class="<?= $mClass ?>">
        <div class="big-box rounded-corner mycontainer" style="margin-top: 10px">
             <?php
                $Categories=['categories'=>[2013,2014,2015,2016,2017],'title'=>'Year'];
                $Series=[
                    ['name' => 'DOST-I', 'data' => [18, 67, 45,13,90]],
                    ['name' => 'DOST-II', 'data' => [145, 267, 143,0,132]],
                    ['name' => 'DOST-III', 'data' => [295,180, 56,30,430]],
                    ['name' => 'DOST-IV', 'data' => [250, 217, 230,200,89]]
                ];
                Yii::$app->PostedData->GenerateChart("referral","column","# of Referral","Graph shows comparisons of FIRMS on all regions including by laboratories and monthly distributions","/toplevel/statistics/referral",$Categories,$Series,365,230,"sand-signika","0.f");
            ?>
            <div class="overlay" onclick="location.href='/toplevel/statistics/accomplishments?type=Firms'">
                <div class="text">Click to proceed</div>
            <
        </div>
    </div>
</div>
    

    
</div>

<style type="text/css">
  .centered {
  width: 150px;
  height: 150px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
 
 
}
</style>

<div class="row"> 
    
    
<div class="<?= $mClass ?>">
        <div class="big-box rounded-corner mycontainer" style="margin-top: 10px">
             <?php
                $Categories=['categories'=>[2013,2014,2015,2016,2017],'title'=>'Year'];
                $Series=[
                    ['name' => 'DOST-I', 'data' => [18, 667, 45,13,90]],
                    ['name' => 'DOST-II', 'data' => [145, 267, 143,0,132]],
                    ['name' => 'DOST-III', 'data' => [295,180, 56,30,430]],
                    ['name' => 'DOST-IV', 'data' => [250, 217, 230,200,89]]
                ];
                Yii::$app->PostedData->GenerateChart("referral2","column","# of Referral","Graph shows comparisons of all RDIs  by laboratories and monthly distributions","/toplevel/statistics/referral",$Categories,$Series,365,230,"sand-signika","0.f");
            ?>
            <div class="overlay" onclick="location.href='/toplevel/statistics/accomplishmentrdi'">
                <div class="text">Click to proceed</div>
            
        </div>
    </div>
</div>
    
    
    <div class="col-lg-4 col-xs-12">
        <div class="big-box rounded-corner mycontainer" style="margin-top: 10px">
            <div class="row" >
                <div class="col-md-6">
                     <img style="height:190px" src="/images/statisticalranking.png">
                </div>
                 <div class="col-md-6">
                     <div class="centered"><h5 style=" font-weight:bold;">Statistical Ranking (RSTLs)</h5></div>
                    
                </div>
            </div>
           
            <div class="overlay" onclick="location.href='/toplevel/statistics/topdata'">
                <div class="text">Click to proceed</div>
            
        </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-xs-12">
        <div class="big-box rounded-corner mycontainer" style="margin-top: 10px">
            <div class="row" >
                <div class="col-md-6">
                     <img style="height:190px" src="/images/statisticalranking.png">
                </div>
                 <div class="col-md-6">
                     <div class="centered"><h5 style=" font-weight:bold;">Statistical Ranking (RDIs)</h5></div>
                    
                </div>
            </div>
           
            <div class="overlay" onclick="location.href='/toplevel/statistics/topdatardi'">
                <div class="text">Click to proceed</div>
            
        </div>
        </div>
    </div>
</div>
    
 <!--
    <div class="col-lg-4 col-xs-12">
        <div class="big-box rounded-corner mycontainer" style="margin-top: 10px">
            <div class="row" >
                <div class="col-md-6">
                     <img style="height:190px" src="/images/statisticalranking.png">
                </div>
                 <div class="col-md-6">
                     <div class="centered"><h5 style=" font-weight:bold;">Accomplishments and Targets</h5></div>
                    
                </div>
            </div>
           
            <div class="overlay" onclick="location.href='/toplevel/statistics/accomplishment'">
                <div class="text">Click to proceed</div>
            
        </div>
        </div>
    </div>
</div>
 -->
    



 
