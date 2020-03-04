<?php
namespace app\modules\controllers;
use Yii;
use yii\helpers\ArrayHelper;
use app\components\Functions;
use app\models\Agency;
use app\models\Request;
use app\models\Stocks;
use app\models\HighchartThemes;
use miloschuman\highcharts\SeriesDataHelper;
use app\models\HighchartThemeUser;
use app\components\StatisticsComponents;
use app\models\Region;
use app\modules\components\Analytics;
use app\modules\models\forms\FeesCollection;
use yii\data\SqlDataProvider;
use DateTime;


class StatisticsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionEquipment(){
        $post= \Yii::$app->request->post();
        //$HighchartThemeUser=HighchartThemeUser::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $ChartComponents=new StatisticsComponents();
        if ($post) {
            $RegionID= $post['RegionID'];
            if($RegionID==-1){
                $AgencyID = -1;
            }else{
               $AgencyID = (int)$post['Agency'];
            }
            //$AgencyID=-1;
            $ChartTypeID = $post['ChartTypeID'];
            $ChartType = strtolower($post['ChartType']);
            $FrequencyID = $post['FrequencyID'];
            $Frequency = $post['Frequency'];
            $Year= $post['fYear'];
            $Year2= $post['fYear2'];
            $LabID= $post['Laboratories'];
            $highchart_theme_id=$post['highchart_theme_id'];
            $ShowCancelled=0;
            $FundingID=$post['FundingID'];
            $ShowAmount=$post['showamount'];
            //Get the Theme
            $Theme=$ChartComponents->SetHighchartTheme($highchart_theme_id);
        } else {
            $AgencyID = 0;
            $ChartTypeID = 5;
            $ChartType = "spline";
            $FrequencyID = 0;
            $Frequency = 'Select Quarter';
            $RegionID=0;
            $Year=(int)date("Y");
            $Year2=(int)date("Y")+1;
            $LabID=0;
            //$Theme="sand-signika";
            $highchart_theme_id=8;
            $ShowCancelled=0;
            $FundingID=0;
            $ShowAmount=1;
            //Get the Theme
            $Theme=$ChartComponents->SetHighchartTheme($highchart_theme_id);
        }
        $FeeType='Inventory Equipment';
        //Get the Theme
        /******************* StatisticsComponents Components  *****************/
        $InitTitle=$FeeType." ";
        $ChartComponents->SetFrequency($InitTitle, $FrequencyID, $Year, $Year2);
        $Quarters=$ChartComponents->GetQuarters();
        $ChartTitle=$ChartComponents->GetChartTitle();
        // RSTL Data
        $RSTLData=$ChartComponents->GetRSTLData($RegionID);
        $RSTLRows=$ChartComponents->GetRSTLRows();
        $LabData=$ChartComponents->GetLabs();
        $Agencies=$ChartComponents->GetAgencies();
        $FundingData=$ChartComponents->GetFundings(0);
        $ExcludeZero=0;
        /******************* StatisticsComponents Components  *****************/
        $PrevRSTLID=0;
        $CurrentRSTLID=0;
        $MainArr=[];
        if($AgencyID<>-1){
        foreach($Agencies as $Agency){
            $id=(int)$Agency['id'];
            if($FrequencyID==5){
                $mSeries=$this->GetEquipmentSeriesByYear($id, $Year,$Year2,$FundingID,$LabID, $ShowAmount);
                $mTot=$mSeries[1];
                if($mTot>0 || !$ExcludeZero){
                   $MainArr[$id]=$mSeries[0];
                }  
            }else{
                $mSeries=$this->GetEquipmentSeriesAmount($id, $Year,$FrequencyID,$FundingID, $LabID,$ShowAmount);
                $mTot=$mSeries[1];
                if($mTot>0 || !$ExcludeZero){
                   $MainArr[$id]=$mSeries[0];
                }
            }
        }
        }
        if($AgencyID==-1){
            if($FrequencyID==5){// Years
               $mSeries=$this->GetEquipmentSeriesByYear(-1, $Year,$Year2,$FundingID,$LabID,$ShowAmount);
               $mTot=$mSeries[1];
                if($mTot>0 || !$ExcludeZero){
                   $MainArr[-1]=$mSeries[0];
                }
            }else{
               $mSeries=$this->GetEquipmentSeriesAmount(-1, $Year,$FrequencyID, $FundingID,$LabID, $ShowAmount);
               $mTot=$mSeries[1];
                if($mTot>0 || !$ExcludeZero){
                   $MainArr[-1]=$mSeries[0];
                }
            }
        }
        //**********************************************************************
        $DataArr=[];
        if($AgencyID==-1){
            if(isset($MainArr[-1])){
                $Arr=[
                    'name'=>'Summary',
                    'data'=> $MainArr[-1]
                ];
                array_push($DataArr, $Arr);
            }
        }else{
            foreach($RSTLRows as $RSTLRow){
                $CurrentRSTLID=$RSTLRow['id'];
                if($AgencyID==0){
                    //if($CurrentRSTLID>0){
                    if($CurrentRSTLID>0 && isset($MainArr[$CurrentRSTLID])){
                        $Arr=[
                            'name'=>$RSTLRow['name'],
                            'data'=> $MainArr[$CurrentRSTLID]
                        ];
                        array_push($DataArr, $Arr);  
                    }
                }else{
                    //if($CurrentRSTLID==$AgencyID){
                    if($CurrentRSTLID>0 && isset($MainArr[$CurrentRSTLID])){
                        $Arr=[
                            'name'=>$RSTLRow['name'],
                            'data'=> $MainArr[$CurrentRSTLID]
                        ];
                        array_push($DataArr, $Arr);
                    }
                }
                $PrevRSTLID=$CurrentRSTLID;
            }
        }
        if($ShowAmount==1){
            $ChartSeriesVerticalLabel="Equipment Amount";
        }else{
            $ChartSeriesVerticalLabel="Inventory Equipment";
        }
        $Equipment=[
            'Agency'=>$AgencyID,
            'AgencyID'=>$AgencyID,
            'ChartTypeID'=>$ChartTypeID,
            'ChartType'=>$ChartType,
            'FrequencyID'=>$FrequencyID,
            'Frequency'=>$Frequency,
            'Quarter'=>$Quarters,
            'ChartTitle'=>$ChartTitle,
            'Series'=>$DataArr,
            'RegionID'=>$RegionID,
            'Year'=>$Year,
            'Year2'=>$Year2,
            'RSTLData'=>$RSTLData,
            'LabData'=>$LabData,
            'FundingData'=>$FundingData,
            'LabID'=>$LabID,
            'theme'=>$Theme,
            'highchart_theme_id'=>$highchart_theme_id,
            'Theme'=>$Theme,
            'FeeType'=>$FeeType,
            'ShowAmount'=>$ShowAmount,
            'FundingID'=>$FundingID,
            'ChartSeriesVerticalLabel'=>$ChartSeriesVerticalLabel
        ];
        //Get the list of themes
        $HighchartThemes=HighchartThemes::find()->orderBy('theme')->all();
        return $this->render('inventory-equipment',['Equipment'=>(object)$Equipment]); 
    }
    public function actionTransactions(){
        $post= \Yii::$app->request->post();
        //$HighchartThemeUser=HighchartThemeUser::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $ChartComponents=new StatisticsComponents();
        if ($post) {
            $RegionID= $post['RegionID'];
            if($RegionID==-1){
                $AgencyID = -1;
            }else{
               $AgencyID = (int)$post['Agency'];
            }
            $ChartTypeID = $post['ChartTypeID'];
            $ChartType = strtolower($post['ChartType']);
            $FrequencyID = $post['FrequencyID'];
            $Frequency = $post['Frequency'];
            $Year= $post['fYear'];
            $Year2= $post['fYear2'];
            $LabID= $post['Laboratories'];
            $highchart_theme_id=$post['highchart_theme_id'];
            $ShowCancelled=$post['showcancelled'];
            //Get the Theme
            $Theme=$ChartComponents->SetHighchartTheme($highchart_theme_id);
        } else {
            $AgencyID = 0;
            $ChartTypeID = 2;
            $ChartType = "column";
            $FrequencyID = 1;
            $Frequency = 'First Quarter';
            $RegionID=0;
            $Year=(int)date("Y");
            $Year2=(int)date("Y")+1;
            $LabID=0;
            //$Theme="sand-signika";
            $highchart_theme_id=8;
            $ShowCancelled=0;
            //Get the Theme
            $Theme=$ChartComponents->SetHighchartTheme($highchart_theme_id);
        }
        if ($ShowCancelled){
            $FeeType='Total Cancelled Transactions';
        }else{
            $FeeType='Total Transactions';
        }
        /******************* StatisticsComponents Components  *****************/
        $InitTitle=$FeeType." ";
        $ChartComponents->SetFrequency($InitTitle, $FrequencyID, $Year, $Year2);
        //$Quarters=$ChartComponents->GetQuarters();
        //$Quarters= ArrayHelper::toArray(Region::find()->all());
        $ChartTitle=$ChartComponents->GetChartTitle();
        // RSTL Data
        $RSTLData=$ChartComponents->GetRSTLData($RegionID);
        $RSTLRows=$ChartComponents->GetRSTLRows();
        $LabData=$ChartComponents->GetLabs();
        $Agencies=$ChartComponents->GetAgencies();
        $LabRows=$ChartComponents->GetLabRows($AgencyID);
        $ExcludeZero=0;
        //$Quarters=['I','II','III','IVA','IVB','V','VI','VII','VIII','IX','X','XI','XII','XIII','NCR','CAR','ARMM'];
        $Quarters=$ChartComponents->GetRegionArray();
        $RegionRows=$ChartComponents->GetRegionRows();
        $Analytics=new Analytics();
        $Categories=$Analytics->Categories("Region", $Quarters);
        $DataSeries=$Analytics->Series("Transactions", $Year,$Year2, $FrequencyID, $LabID);
        
        $Income=[
            'Agency'=>$AgencyID,
            'AgencyID'=>$AgencyID,
            'ChartTypeID'=>$ChartTypeID,
            'ChartType'=>$ChartType,
            'FrequencyID'=>$FrequencyID,
            'Frequency'=>$Frequency,
            'Quarter'=>$Quarters,
            'ChartTitle'=>$ChartTitle,
            'Categories'=>$Categories,
            'Series'=>$DataSeries,
            'RegionID'=>$RegionID,
            'Year'=>$Year,
            'Year2'=>$Year2,
            'RSTLData'=>$RSTLData,
            'LabData'=>$LabData,
            'LabID'=>$LabID,
            'theme'=>$Theme,
            'highchart_theme_id'=>$highchart_theme_id,
            'Theme'=>$Theme,
            'FeeType'=>$FeeType,
            'ShowCancelled'=>$ShowCancelled
        ];
        /******************* StatisticsComponents Components  *****************/
        
        $HighchartThemes=HighchartThemes::find()->orderBy('theme')->all();
        return $this->render('transactions',['Transactions'=>(object)$Income, 'HighchartThemes'=>$HighchartThemes]); 
    }
    private function GetInventorySeriesAmountByYear($RSTLID,$StartYear,$EndYear,$SupplyID, $LabID, $IsAmount,$IsOnHand){
        $Proc="spGetInventorySeriesAmountByRSTLYear(:mRSTLID,:mStartYear,:mEndYear,:mSupplyID,:mLabID)";
        $dbcon=Yii::$app->topdb;
        $DbParams=[
            'mRSTLID'=>$RSTLID,
            'mStartYear'=>$StartYear,
            'mEndYear'=>$EndYear, 
            'mSupplyID'=>$SupplyID,
            'mLabID'=>$LabID
        ];
        $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        if($IsAmount){
            $SeriesParam=['Total:float']; 
        }else{
            if($IsOnHand){
                $SeriesParam=['TotalQty:float']; 
            }else{
                $SeriesParam=['TotalUsed:float']; 
            }
        }
        $ReqArray=new SeriesDataHelper($dataProvider, $SeriesParam);
        return $ReqArray;
    }
    private function GetEquipmentSeriesAmount($RSTLID,$Year,$FrequencyID,$FundingID, $LabID,$IsAmount=true){
        $Proc="spGetEquipmentSeriesAmountByRSTL(:mRSTLID,:mYear,:mQuarter,:mFundingID,:mLabID)";
        $dbcon=Yii::$app->topdb;
        $DbParams=[
            'mRSTLID'=>$RSTLID,
            'mYear'=>$Year,
            'mQuarter'=>$FrequencyID, 
            'mFundingID'=>$FundingID,
            'mLabID'=>$LabID
        ];
        $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        if($IsAmount){
            $SeriesParam=['Total:float']; 
        }else{
            $SeriesParam=['TotalQty:float']; 
        }
        $ReqArray=new SeriesDataHelper($dataProvider, $SeriesParam);
        $Series=[
            0=>$ReqArray,
            1=>$Requests[0]['GrandTotal']
        ];
        return $Series;
    }
    private function GetSeriesRequestByYear($RSTLID,$StartYear,$EndYear, $LabID,$mPaymentTypeID, $FeeTypeID){
        $Proc="spGetSeriesTransactionByRSTLYear(:mRSTLID,:mStartYear,:mEndYear,:mLabID,:mFeeTypeID)";
        $dbcon=Yii::$app->topdb;
        $DbParams=['mRSTLID'=>$RSTLID,'mStartYear'=>$StartYear,'mEndYear'=>$EndYear,'mLabID'=>$LabID,'mFeeTypeID'=>$FeeTypeID];
        $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        if(isset($Requests[0]['GrandTotal'])){
            $GrandTotal=$Requests[0]['GrandTotal'];
        }else{
            $GrandTotal=0;
        }
        $Series=[
            0=>$ReqArray,
            1=>$GrandTotal
        ];
        return $Series;
    }
    private function GetSeriesSampleByYear($RSTLID,$StartYear,$EndYear, $LabID, $ShowCancelled){
        $Proc="spGetSeriesSamplesByRSTLYear(:mRSTLID,:mStartYear,:mEndYear,:mLabID,:mShowCancelled)";
        $dbcon=Yii::$app->labdb;
        $DbParams=[
            'mRSTLID'=>$RSTLID,
            'mStartYear'=>$StartYear,
            'mEndYear'=>$EndYear,
            'mLabID'=>$LabID,
            'mShowCancelled'=>$ShowCancelled
        ];
        $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        if(isset($Requests[0]['GrandTotal'])){
            $GrandTotal=$Requests[0]['GrandTotal'];
        }else{
            $GrandTotal=0;
        }
        $Series=[
            0=>$ReqArray,
            1=>$GrandTotal
        ];
        return $Series;
    }
    private function GetSeriesSample($RSTLID,$Year,$FrequencyID, $LabID,$ShowCancelled){
        $Proc="spGetSeriesSamplesByRSTL(:mRSTLID,:mYear,:mQuarter,:mLabID,:mShowCancelled)";
        $dbcon=Yii::$app->labdb;
        $DbParams=[
            'mRSTLID'=>$RSTLID,
            'mYear'=>$Year,
            'mQuarter'=>$FrequencyID,
            'mLabID'=>$LabID,
            'mShowCancelled'=>$ShowCancelled
        ];
        $Functions=new Functions();
        $Requests=$Functions->ExecuteStoredProcedureRows($Proc, $DbParams, $dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        $Series=[
            0=>$ReqArray,
            1=>$Requests[0]['GrandTotal']
        ];
        return $Series;
    }
    private function GetSeriesCustomers($CustomerTypeID,$BusinessNatureID,$ClassificationID){
        $Proc="spGetSeriesCustomerByRegion(:mCustomerTypeID,:mBusinessNatureID,:mClassificationID)";
        $dbcon=Yii::$app->labdb;
        $DbParams=[
            'mCustomerTypeID'=>$CustomerTypeID,
            'mBusinessNatureID'=>$BusinessNatureID,
            'mClassificationID'=>$ClassificationID];
        $Functions=new Functions();
        $Requests=$Functions->ExecuteStoredProcedureRows($Proc, $DbParams, $dbcon);
        //return ArrayHelper::map($Requests,'name', 'y');
        return $Requests;
    }
    private function GetSeriesTransactionSummary($RSTLID,$Year,$FrequencyID){
        $Proc="spGetSeriesTransactionByRSTLSummary(:mRSTLID,:mYear,:mQuarter,:mLabID)";
        $dbcon=Yii::$app->labdb;
        $DbParams=['mRSTLID'=>$RSTLID,'mYear'=>$Year,'mQuarter'=>$FrequencyID,'mLabID'=>0];
        $Functions=new Functions();
        $Requests=$Functions->ExecuteStoredProcedureRows($Proc, $DbParams, $dbcon);
       // $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        $Series=[
            0=>$ReqArray,
            1=>$Requests[0]['GrandTotal']
        ];
        return $Series;
    }
    private function GetSeriesTransaction($RSTLID,$Year,$FrequencyID, $LabID, $FeeTypeID){
        $Proc="spGetSeriesTransactionByRSTL(:mRSTLID,:mYear,:mQuarter,:mLabID,:mFeeType)";
        $dbcon=Yii::$app->labdb;
        $DbParams=['mRSTLID'=>$RSTLID,'mYear'=>$Year,'mQuarter'=>$FrequencyID,'mLabID'=>$LabID,'mFeeType'=>$FeeTypeID];
        $Functions=new Functions();
        $Requests=$Functions->ExecuteStoredProcedureRows($Proc, $DbParams, $dbcon);
       // $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        $Series=[
            0=>$ReqArray,
            1=>$Requests[0]['GrandTotal']
        ];
        return $Series;
    }
    private function GetSeriesAmountSummary($RSTLID,$Year,$FrequencyID, $LabID, $FeeTypeID){
        /*$Proc="spGetSeriesAmountByRSTLSummary(:mRSTLID,:mYear,:mQuarter,:mLabID,:mFeeType)";
        $dbcon=Yii::$app->labdb;
        $DbParams=['mRSTLID'=>$RSTLID,'mYear'=>$Year,'mQuarter'=>$FrequencyID,'mLabID'=>$LabID,'mFeeType'=>$FeeTypeID];
        $Functions=new Functions();
        $Requests=$Functions->ExecuteStoredProcedureRows($Proc, $DbParams, $dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        $Series=[
            0=>$ReqArray,
            1=>$Requests[0]['GrandTotal']
        ];
        */
        $dbcon=Yii::$app->labdb;
        $DbParams=['mRSTLID'=>$RSTLID,'mYear'=>$Year,'mQuarter'=>$FrequencyID,'mLabID'=>$LabID,'mFeeType'=>$FeeTypeID];
        $Functions=new Functions();
        $Proc="spGetSeriesAmountByRSTL(:mRSTLID,:mYear,:mQuarter,:mLabID,:mFeeType)";
        $_Request=$Functions->ExecuteStoredProcedureRows($Proc, $DbParams, $dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $_Request]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        $Series=[
            0=>$ReqArray,
            1=>$_Request[0]['GrandTotal']
        ];
        return $Series;
    }
    private function GetSeriesAmount($RSTLID,$Year,$FrequencyID, $LabID, $FeeTypeID){
        $Proc="spGetSeriesAmountByRSTL(:mRSTLID,:mYear,:mQuarter,:mLabID,:mFeeType)";
        $dbcon=Yii::$app->labdb;
        $DbParams=['mRSTLID'=>$RSTLID,'mYear'=>$Year,'mQuarter'=>$FrequencyID,'mLabID'=>$LabID,'mFeeType'=>$FeeTypeID];
        $Functions=new Functions();
        $Requests=$Functions->ExecuteStoredProcedureRows($Proc, $DbParams, $dbcon);
        //var_dump($DbParams);
        //echo "<pre>";
        //var_dump($Requests);
        //echo "</pre>";
        //exit;
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        $Series=[
            0=>$ReqArray,
            1=>$Requests[0]['GrandTotal']
        ];
        return $Series;
    }
    private function GetReferralSeriesAmount($RSTLID,$Year,$FrequencyID, $LabID,$ReferralTypeAmount){
        $Proc="spGetReferralSeriesAmountByRSTL(:mRSTLID,:mYear,:mQuarter,:mLabID,:mReferralTypeAmount)";
        $dbcon=Yii::$app->referraldb;
        $DbParams=['mRSTLID'=>$RSTLID,'mYear'=>$Year,'mQuarter'=>$FrequencyID,'mLabID'=>$LabID,'mReferralTypeAmount'=>$ReferralTypeAmount];
        $Functions=new Functions();
        $Requests=$Functions->ExecuteStoredProcedureRows($Proc, $DbParams, $dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        $Series=[
            0=>$ReqArray,
            1=>$Requests[0]['GrandTotal']
        ];
        return $Series;
    }
    private function GetReferralSeriesAmountByYear($RSTLID,$StartYear,$EndYear, $LabID,$ReferralTypeAmount){
        $Proc="spGetReferralSeriesAmountByRSTLYear(:mRSTLID,:mStartYear,:mEndYear,:mLabID,:mReferralTypeAmount)";
        $dbcon=Yii::$app->referraldb;
        $DbParams=['mRSTLID'=>$RSTLID,'mStartYear'=>$StartYear,'mEndYear'=>$EndYear,'mLabID'=>$LabID,'mReferralTypeAmount'=>$ReferralTypeAmount];
        $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        /*echo "<pre>";
        print_r($Requests);
        echo "</pre>";
        exit;
        */
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        if(isset($Requests[0]['GrandTotal'])){
            $GrandTotal=$Requests[0]['GrandTotal'];
        }else{
            $GrandTotal=0;
        }
        $Series=[
            0=>$ReqArray,
            1=>$GrandTotal
        ];
        return $Series;
    }
    private function GetEquipmentSeriesByYear($RSTLID,$StartYear,$EndYear,$FundingID, $LabID, $IsAmount){
        $Proc="spGetEquipmentSeriesAmountByRSTLYear(:mRSTLID,:mStartYear,:mEndYear,:mFundingID,:mLabID)";
        $dbcon=Yii::$app->topdb;
        $DbParams=['mRSTLID'=>$RSTLID,'mStartYear'=>$StartYear,'mEndYear'=>$EndYear,'mFundingID'=>$FundingID, 'mLabID'=>$LabID];
        $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        if($IsAmount){
            $SeriesParam=['Total:float']; 
        }else{
            $SeriesParam=['TotalQty:float']; 
        }
        $ReqArray=new SeriesDataHelper($dataProvider, $SeriesParam);
        $Series=[
            0=>$ReqArray,
            1=>$Requests[0]['GrandTotal']
        ];
        return $Series;
        
        //$Series=[
        //    0=>$ReqArray,
        //    1=>$GrandTotal
        //];
        //return $Series;
    }
    private function GetSeriesTransactionByYear($RSTLID,$StartYear,$EndYear, $FeeTypeID){
        $Proc="spGetSeriesTransactionByRSTLYear(:mRSTLID,:mStartYear,:mEndYear,:mLabID,:mFeeTypeID)";
        $dbcon=Yii::$app->labdb;
        $DbParams=['mRSTLID'=>$RSTLID,'mStartYear'=>$StartYear,'mEndYear'=>$EndYear,'mLabID'=>0,'mFeeTypeID'=>$FeeTypeID];
        $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        if(isset($Requests[0]['GrandTotal'])){
            $GrandTotal=$Requests[0]['GrandTotal'];
        }else{
            $GrandTotal=0;
        }
        $Series=[
            0=>$ReqArray,
            1=>$GrandTotal
        ];
        return $Series;
    }
    private function GetSeriesTransactionByYearSummary($RSTLID,$StartYear,$EndYear, $FeeTypeID){
        $Proc="spGetSeriesTransactionByRSTLYearSummary(:mRSTLID,:mStartYear,:mEndYear,:mLabID,:mFeeTypeID)";
        $dbcon=Yii::$app->labdb;
        $DbParams=['mRSTLID'=>$RSTLID,'mStartYear'=>$StartYear,'mEndYear'=>$EndYear,'mLabID'=>0,'mFeeTypeID'=>$FeeTypeID];
        $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $ReqArray=new SeriesDataHelper($dataProvider, ['Total:float']);
        if(isset($Requests[0]['GrandTotal'])){
            $GrandTotal=$Requests[0]['GrandTotal'];
        }else{
            $GrandTotal=0;
        }
        $Series=[
            0=>$ReqArray,
            1=>$GrandTotal
        ];
        return $Series;
    }
    private function GetSeriesAmountByYearSummary($RSTLID,$StartYear,$EndYear,$mPaymentTypeID, $FeeTypeID){
        $Proc="spGetSeriesAmountForExcelRSTLYearChartSummary(:mRSTLID,:mStartYear,:mEndYear,:mLabID,:mPaymentTypeID,:mFeeTypeID)";
        $dbcon=Yii::$app->labdb;
        $DbParams=['mRSTLID'=>$RSTLID,'mStartYear'=>$StartYear,'mEndYear'=>$EndYear,'mLabID'=>0,'mPaymentTypeID'=>$mPaymentTypeID,'mFeeTypeID'=>$FeeTypeID];
        $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $SeriesParam=['Total:float']; 
        $ReqArray=new SeriesDataHelper($dataProvider, $SeriesParam);
        $Series=[
            0=>$ReqArray,
            1=>$Requests[0]['GrandTotal']
        ];
        return $Series;
    }
    private function GetSeriesAmountByYear($RSTLID,$StartYear,$EndYear, $LabID,$mPaymentTypeID, $FeeTypeID){
        $Proc="spGetSeriesAmountForExcelRSTLYearChart(:mRSTLID,:mStartYear,:mEndYear,:mLabID,:mPaymentTypeID,:mFeeTypeID)";
        $dbcon=Yii::$app->topdb;
        $DbParams=['mRSTLID'=>$RSTLID,'mStartYear'=>$StartYear,'mEndYear'=>$EndYear,'mLabID'=>$LabID,'mPaymentTypeID'=>$mPaymentTypeID,'mFeeTypeID'=>$FeeTypeID];
        $Requests= \Yii::$app->Functions->ExecuteStoredProcedureRows($Proc,$DbParams,$dbcon);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $Requests]);
        $SeriesParam=['Total:float']; 
        $ReqArray=new SeriesDataHelper($dataProvider, $SeriesParam);
        $Series=[
            0=>$ReqArray,
            1=>$Requests[0]['GrandTotal']
        ];
        return $Series;
    }
    public function actionIncome(){
        $post= \Yii::$app->request->post();
        //$HighchartThemeUser=HighchartThemeUser::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $ChartComponents=new StatisticsComponents();
        if ($post) {
            $RegionID= $post['RegionID'];
            if($RegionID==-1){
                $AgencyID = -1;
            }else{
               $AgencyID = (int)$post['Agency'];
            }
            $ChartTypeID = $post['ChartTypeID'];
            $ChartType = strtolower($post['ChartType']);
            $FrequencyID = $post['FrequencyID'];
            $Frequency = $post['Frequency'];
            $Year= $post['fYear'];
            $Year2= $post['fYear2'];
            $LabID= $post['Laboratories'];
            $ReferralTypeAmount=1;
            $PaymentTypeID=$post['PaymentTypeID'];
            $FeeTypeID=$post['FeeTypeID'];
            $FeeType=$post['FeeType'];
            $highchart_theme_id=$post['highchart_theme_id'];
            //Get the Theme
            $Theme=$ChartComponents->SetHighchartTheme($highchart_theme_id);
        } else {
            $AgencyID = 0;
            $ChartTypeID = 3;
            $ChartType = "column";
            $FrequencyID = 1;
            $Frequency = 'Select Quarter';
            $RegionID=0;
            $Year=(int)date("Y");
            $Year2=(int)date("Y")+1;
            $LabID=0;
            //$Theme="sand-signika";
            $ReferralTypeAmount=1;
            $PaymentTypeID=1;
            $FeeTypeID=1;
            $FeeType='Total Fees';
            $highchart_theme_id=8;
            //Get the Theme
            $Theme=$ChartComponents->SetHighchartTheme($highchart_theme_id);
        }
        //Get the Theme
        /******************* StatisticsComponents Components  *****************/
        $InitTitle=$FeeType." ";
        $ChartComponents->SetFrequency($InitTitle, $FrequencyID, $Year, $Year2);
        $Quarters=$ChartComponents->GetQuarters();
        $ChartTitle=$ChartComponents->GetChartTitle();
        // RSTL Data
        $RSTLData=$ChartComponents->GetRSTLData($RegionID);
        $RSTLRows=$ChartComponents->GetRSTLRows();
        $LabData=$ChartComponents->GetLabs();
        $LabRows=$ChartComponents->GetLabRows($AgencyID);
        $Agencies=$ChartComponents->GetAgencies();
        $ExcludeZero=0;
        /******************* StatisticsComponents Components  *****************/
        $PrevRSTLID=0;
        $CurrentRSTLID=0;
        $MainArr=[];
        
        foreach($LabRows as $LabRow){
            if(isset($LabRow['lab_id'])){
                $id=(int)$LabRow['lab_id'];
            }else{
                $id=0;
            }
            if($AgencyID!=0){
                $mAgencyID=$AgencyID;
            }else{
                $mAgencyID=-1;
            }
            if($FrequencyID==5){
                //$mSeries=$this->GetSeriesAmountByYear($mAgencyID, $Year,$Year2,$id,$PaymentTypeID,$FeeTypeID);
                $mSeries=$this->GetSeriesAmountByYear($mAgencyID, $Year,$Year2,$id,$PaymentTypeID,$FeeTypeID);
                $mTot=$mSeries[1];
                if($mTot>0 || !$ExcludeZero){
                   $MainArr[$id]=$mSeries[0];
                }  
            }else{
                $mSeries=$this->GetSeriesAmount($mAgencyID, $Year,$FrequencyID, $id,$FeeTypeID);
                $mTot=$mSeries[1];
                if($mTot>0 || !$ExcludeZero){
                   $MainArr[$id]=$mSeries[0];
                }
            }
        }
        //**********************************************************************
        //Add Summary
        if($FrequencyID==5){
            $mSeries=$this->GetSeriesAmountByYearSummary($mAgencyID, $Year,$Year2,$PaymentTypeID,$FeeTypeID);
        }else{
            $mSeries=$this->GetSeriesAmountSummary($mAgencyID, $Year,$FrequencyID, 0,$FeeTypeID);
        }
        $MainArr[0]=$mSeries[0];
        //Add Summary Amount
        $DataArr=[];
        $_Arr = [
            'name' => "Summary",
            'data' => $MainArr[0]
        ];
        array_push($DataArr, $_Arr);
        foreach ($LabRows as $LabRow) {
            if(isset($LabRow['lab_id'])){
                $CurrentLabID=(int)$LabRow['lab_id'];
            }else{
                $CurrentLabID=0;
            }
            //$CurrentLabID = (int) $LabRow['LabID'];
            if ($AgencyID == 0) {
                //if($CurrentRSTLID>0){
                if ($CurrentLabID > 0 && isset($MainArr[$CurrentLabID])) {
                    $Arr = [
                        'name' => $LabRow['labcode'],
                        'data' => $MainArr[$CurrentLabID]
                    ];
                    array_push($DataArr, $Arr);
                }
            } else {
                //if($CurrentRSTLID==$AgencyID){
                if ($CurrentLabID > 0 && isset($MainArr[$CurrentLabID])) {
                    $Arr = [
                        'name' => $LabRow['labcode'],
                        'data' => $MainArr[$CurrentLabID]
                    ];
                    array_push($DataArr, $Arr);
                }
            }
           
            $PrevRSTLID = $CurrentLabID;
        }
        $Income=[
            'Agency'=>$AgencyID,
            'AgencyID'=>$AgencyID,
            'ChartTypeID'=>$ChartTypeID,
            'ChartType'=>$ChartType,
            'FrequencyID'=>$FrequencyID,
            'Frequency'=>$Frequency,
            'Quarter'=>$Quarters,
            'ChartTitle'=>$ChartTitle,
            'Series'=>$DataArr,
            'RegionID'=>$RegionID,
            'Year'=>$Year,
            'Year2'=>$Year2,
            'RSTLData'=>$RSTLData,
            'LabData'=>$LabData,
            'LabID'=>$LabID,
            'theme'=>$Theme,
            'ReferralTypeAmount'=>$ReferralTypeAmount,
            'PaymentTypeID'=>$PaymentTypeID,
            'FeeTypeID'=>$FeeTypeID,
            'highchart_theme_id'=>$highchart_theme_id,
            'Theme'=>$Theme,
            'FeeType'=>$FeeType
        ];
        //Get the list of themes
        $HighchartThemes=HighchartThemes::find()->orderBy('theme')->all();
        return $this->render('income',['Income'=>(object)$Income, 'HighchartThemes'=>$HighchartThemes]); 
    }
    public function actionSamples(){
         $post= \Yii::$app->request->post();
        //$HighchartThemeUser=HighchartThemeUser::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $ChartComponents=new StatisticsComponents();
        if ($post) {
            $RegionID= $post['RegionID'];
            if($RegionID==-1){
                $AgencyID = -1;
            }else{
               $AgencyID = (int)$post['Agency'];
            }
            $ChartTypeID = $post['ChartTypeID'];
            $ChartType = strtolower($post['ChartType']);
            $FrequencyID = $post['FrequencyID'];
            $Frequency = $post['Frequency'];
            $Year= $post['fYear'];
            $Year2= $post['fYear2'];
            $LabID= $post['Laboratories'];
            $highchart_theme_id=$post['highchart_theme_id'];
            $ShowCancelled=$post['showcancelled'];
            //Get the Theme
            $Theme=$ChartComponents->SetHighchartTheme($highchart_theme_id);
        } else {
            $AgencyID = 0;
            $ChartTypeID = 2;
            $ChartType = "column";
            $FrequencyID = 1;
            $Frequency = 'First Quarter';
            $RegionID=0;
            $Year=(int)date("Y");
            $Year2=(int)date("Y")+1;
            $LabID=0;
            //$Theme="sand-signika";
            $highchart_theme_id=8;
            $ShowCancelled=0;
            //Get the Theme
            $Theme=$ChartComponents->SetHighchartTheme($highchart_theme_id);
        }
        if ($ShowCancelled){
            $FeeType='Total Cancelled Samples';
        }else{
            $FeeType='Total Samples';
        }
        /******************* StatisticsComponents Components  *****************/
        $InitTitle=$FeeType." ";
        $ChartComponents->SetFrequency($InitTitle, $FrequencyID, $Year, $Year2);
        //$Quarters=$ChartComponents->GetQuarters();
        //$Quarters= ArrayHelper::toArray(Region::find()->all());
        $ChartTitle=$ChartComponents->GetChartTitle();
        // RSTL Data
        $RSTLData=$ChartComponents->GetRSTLData($RegionID);
        $RSTLRows=$ChartComponents->GetRSTLRows();
        $LabData=$ChartComponents->GetLabs();
        $Agencies=$ChartComponents->GetAgencies();
        $LabRows=$ChartComponents->GetLabRows($AgencyID);
        $ExcludeZero=0;
        //$Quarters=['I','II','III','IVA','IVB','V','VI','VII','VIII','IX','X','XI','XII','XIII','NCR','CAR','ARMM'];
        $Quarters=$ChartComponents->GetRegionArray();
        $RegionRows=$ChartComponents->GetRegionRows();
        $Analytics=new Analytics();
        $Categories=$Analytics->Categories("Region", $Quarters);
        $DataSeries=$Analytics->SampleSeries("Samples", $Year,$Year2, $FrequencyID, $LabID);
        
        $Income=[
            'Agency'=>$AgencyID,
            'AgencyID'=>$AgencyID,
            'ChartTypeID'=>$ChartTypeID,
            'ChartType'=>$ChartType,
            'FrequencyID'=>$FrequencyID,
            'Frequency'=>$Frequency,
            'Quarter'=>$Quarters,
            'ChartTitle'=>$ChartTitle,
            'Categories'=>$Categories,
            'Series'=>$DataSeries,
            'RegionID'=>$RegionID,
            'Year'=>$Year,
            'Year2'=>$Year2,
            'RSTLData'=>$RSTLData,
            'LabData'=>$LabData,
            'LabID'=>$LabID,
            'theme'=>$Theme,
            'highchart_theme_id'=>$highchart_theme_id,
            'Theme'=>$Theme,
            'FeeType'=>$FeeType,
            'ShowCancelled'=>$ShowCancelled
        ];
        /******************* StatisticsComponents Components  *****************/
        
        $HighchartThemes=HighchartThemes::find()->orderBy('theme')->all();
        return $this->render('samples',['Request'=>(object)$Income, 'HighchartThemes'=>$HighchartThemes]);
    }
    
    public function actionCustomers(){
        $post= \Yii::$app->request->post();
        //$HighchartThemeUser=HighchartThemeUser::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $ChartComponents=new StatisticsComponents();
        if ($post) {
            $RegionID= $post['RegionID'];
            $AgencyID = (int)$post['AgencyID'];
            $ChartTypeID = $post['ChartTypeID'];
            $ChartType = strtolower($post['ChartType']);
            $highchart_theme_id=$post['highchart_theme_id'];
            $activecustomer=$post['activecustomer'];
            $CustomerTypeID=$post['CustomerTypeID'];
            $BusinessNatureID=$post['BusinessNatureID'];
            $ClassificationID=$post['ClassificationID'];//IndustryTypeID
            //Get the Theme
            $Theme=$ChartComponents->SetHighchartTheme($highchart_theme_id);
        } else {
            $AgencyID = -1;
            $ChartTypeID = 6;
            $ChartType = "pie";
            $RegionID=0;
            $CustomerTypeID=1;
            $BusinessNatureID=0;
            $ClassificationID=0;
            //$Theme="sand-signika";
            $highchart_theme_id=8;
            $activecustomer=0;
            //Get the Theme
            $Theme=$ChartComponents->SetHighchartTheme($highchart_theme_id);
        }
        if ($activecustomer){
            $FeeType='Total Active Customers';
        }else{
            $FeeType='Total Customers';
        }
        //Get the Theme
        /******************* StatisticsComponents Components  *****************/
        $InitTitle=$FeeType." ";
        $Quarters=$ChartComponents->GetQuarters();
        $ChartTitle=$ChartComponents->GetChartTitle();
        // RSTL Data
        $RSTLData=$ChartComponents->GetRSTLData($RegionID);
        $RSTLRows=$ChartComponents->GetRSTLRows();
        $LabData=$ChartComponents->GetLabs();
        $Agencies=$ChartComponents->GetAgencies();
        $LabRows=$ChartComponents->GetLabRows($AgencyID);
        /******************* StatisticsComponents Components  *****************/
        $Analytics=new Analytics();
        $Categories=$Analytics->Categories("Region", $Quarters);
        $SeriesCustomers=$this->GetSeriesCustomers($CustomerTypeID, $BusinessNatureID, $ClassificationID);
        //echo "<pre>";
        //var_dump($SeriesCustomers);
        //echo "</pre>";
        //exit;
        $dataseries=[];
        foreach ($SeriesCustomers as $SeriesCustomer){
            array_push($dataseries, [
                'name'=>$SeriesCustomer['name'],
                'y'=>(int)$SeriesCustomer['total']
            ]);
        }
        $Series=[
            [
            'name'=>'Region',
            'colorByPoint'=> true,
            'type'=>$ChartType,
            'data'=>$dataseries
            ]
        ];
        //**********************************************************************
        $Customers=[
            'Agency'=>$AgencyID,
            'AgencyID'=>$AgencyID,
            'ChartTypeID'=>$ChartTypeID,
            'ChartType'=>$ChartType,
            'Categories'=>$Categories,
            'ChartTitle'=>$ChartTitle,
            'Series'=>$Series,
            'RegionID'=>$RegionID,
            'RSTLData'=>$RSTLData,
            'LabData'=>$LabData,
            'theme'=>$Theme,
            'highchart_theme_id'=>$highchart_theme_id,
            'Theme'=>$Theme,
            'FeeType'=>$FeeType,
            'activecustomer'=>$activecustomer,
            'CustomerTypeID'=>$CustomerTypeID,
            'BusinessNatureID'=>$BusinessNatureID,
            'ClassificationID'=>$ClassificationID
        ];
        //Get the list of themes
        $HighchartThemes=HighchartThemes::find()->orderBy('theme')->all();
        return $this->render('customers',['Customers'=>(object)$Customers,'Categories'=>$Categories,'Series'=>$Series]);
    }
    public function actionReferral(){
        $post= \Yii::$app->request->post();
        //echo "<pre>";
        //var_dump($post);
        //echo "</pre>";
        //exit;
        //$HighchartThemeUser=HighchartThemeUser::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $ChartComponents=new StatisticsComponents();
        $model=new FeesCollection();
        if ($post) {
            $model->ChartTitle=$post['ChartTitle'];
            $model->ChartTypeID=$post['ChartTypeID'];
            $model->ChartType = $post['ChartType'];
            $model->StartYear=$post['FrequencyYear'];
            $model->EndYear=$post['FrequencyYear2'];
            if($model->StartYear>$model->EndYear){
               $model->EndYear=$model->StartYear;
            }
            $model->FrequencyID=$post['FrequencyID'];
            $model->Frequency=$post['Frequency'];
            $model->HighchartThemeID=(int)$post['HighchartThemeID'];
            $model->LabID=$post['FeesCollection']['LabID'];
            $model->ActiveTab=$post['ActiveTab'];
            $model->ReferralMode=$post['FeesCollection']['ReferralMode']; //$post['FeesCollection']['ReferralMode'];
            $model->RegionID=$post['RegionID'];
            $model->Theme=$ChartComponents->SetHighchartTheme($model->HighchartThemeID);
        } else {
            $model->ChartTitle="Test";
            $model->ChartTypeID=3;
            $model->ChartType = "column";
            $model->EndYear=(int)date("Y");
            $model->StartYear=(int)date("Y");
            $model->FrequencyID=1;
            $model->Frequency='First Quarter';
            $model->HighchartThemeID=8;
            $model->LabID=0;
            $model->ActiveTab="tab0";
            $model->ReferralMode= 2;
            $model->RegionID=0;
            $model->Theme=$ChartComponents->SetHighchartTheme($model->HighchartThemeID);
        }
        /******************* StatisticsComponents Components  *****************/
        $InitTitle=" ";
        $ChartComponents->SetFrequency($InitTitle, $model->FrequencyID, $model->StartYear, $model->EndYear);
        $Analytics=new Analytics();
        //echo "StartYear" . $model->StartYear;
        //echo "EndYear" . $model->EndYear;
        //echo "FrequencyID" . $model->FrequencyID;
        //echo "LabID" . $model->LabID;
        //echo "ReferralMode" . $model->ReferralMode;
        switch($model->ActiveTab){
            case "tab0": //_feescollected
                $ReferralLab="Referral Fees";
                $model->ReferralMode=2;
                $DataSeries=$Analytics->ReferralSeries($ReferralLab, $model->StartYear,$model->EndYear, $model->FrequencyID, $model->LabID,$model->ReferralMode);
                break;
            case "tab1": //_referralcount
                if($model->ReferralMode==1){//Receiving
                    $ReferralLab="Receiving Laboratory(RL)";
                }else{//Accepting
                    $ReferralLab="Testing/Calibration Laboratory(TCL)";
                }
                $DataSeries=$Analytics->ReferralSeriesCount($ReferralLab, $model->StartYear,$model->EndYear, $model->FrequencyID, $model->LabID,$model->ReferralMode);
                break;
        }
        
        $model->Series=$DataSeries;
        $model->ChartTitle=$ChartComponents->GetChartTitle();
        $model->Quarter=$ChartComponents->GetRegionArray();
        $model->RSTLData=$ChartComponents->GetReferralAgencies();
        $model->LabData=$ChartComponents->GetLabs();
        $Categories=$Analytics->Categories("Region", $model->Quarter);
        /******************* StatisticsComponents Components  *****************/
        $HighchartThemes=HighchartThemes::find()->orderBy('theme')->all();
        return $this->render('referral',[
            'model'=>$model, 
            'post'=>$post,
            'HighchartThemes'=>$HighchartThemes
        ]);
    }
    
    public function actionAjaxchart(){
        $Post=Yii::$app->request->post();
        $Income= json_decode($Post['incjson']);
        $Categories= json_decode($Post['catjson']);
        $Series= json_decode($Post['serjson']);
        $titleLink=$Post['titlelink'];
        return Yii::$app->PostedData->GenerateChart($Income->ChartType, $Income->VerticalLabel, $Income->ChartTitle, $titleLink, $Categories, $Series,850,400,$Income->theme);
    }
    
    public function actionTopdata(){
        $dashArray = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 0 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
        $listLab=[];
        array_push($listLab,'All Laboratories');
        foreach ($dashArray as $col)
            {
               // $columnArray[]=$col['labname'];
                array_push($listLab,$col['labname']);
                 
            }
            
            
      // $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 2 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
         $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spRetrieveTopManagementTopData(8,0,0);')->queryAll();
        $listYear=array();
        $currentyear=2018;
        $index = 0;
        foreach ($arrayYear as $colYear)
            {
               // $columnArray[]=$col['labname'];
                array_push($listYear,$colYear['iyear']);
                if($currentyear==$colYear['iyear'])
               {
                    $curYearValue=$index;
             }
                $index++;
        
            }
        $listIncomeTran=['Fees','Transaction'];
        $listCustomerFirms=['Customer','Firms'];
        $listSampleTests=['Sample','Tests'];
        
        
        $now = new DateTime();
        $currentyear= $now->format('Y');
        $currentyear = 2018;
        
         $dataIncomeTrans = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopData(1,0,' . $currentyear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
         
          $dataCustomerFirms = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopData(3,0,' . $currentyear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
          
           $dataSampleTests = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopData(6,0,' . $currentyear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
         
         
        return $this->render('topdata',['listYear'=>$listYear,'curYearValue'=>$curYearValue,'listLab'=>$listLab,'listIncomeTran'=>$listIncomeTran,'listCustomerFirms'=>$listCustomerFirms,
            'listSampleTests'=>$listSampleTests,'dataIncomeTrans'=>$dataIncomeTrans,'dataCustomerFirms'=>$dataCustomerFirms ,'dataSampleTests'=>$dataSampleTests]
        );
    }
    
    public function actionTopdatareload(){
        
        $paramYear = Yii::$app->request->get('paramYear');
            $now = new DateTime();
        $currentyear= $now->format('Y');
        
        $dashArray = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 0 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
        $listLab=[];
        array_push($listLab,'All Laboratories');
        foreach ($dashArray as $col)
            {
               // $columnArray[]=$col['labname'];
                array_push($listLab,$col['labname']);
                 
            }
            
            
     //   $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 2 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
          $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spRetrieveTopManagementTopData(8,0,0);')->queryAll();
        $listYear=array();
     //  $currentyear=2015;
        $index = 0;
        foreach ($arrayYear as $colYear)
            {
               // $columnArray[]=$col['labname'];
                array_push($listYear,$colYear['iyear']);
            //    if($currentyear==$colYear['iyear'])
            //   {
            //        $curYearValue=$index;
           //  }
                $index++;
        
            }
        $listIncomeTran=['Fees','Transaction'];
        $listCustomerFirms=['Customer','Firms'];
        $listSampleTests=['Sample','Tests'];
        
        
    
    //    $currentyear = 2015;
        
         $dataIncomeTrans = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopData(1,0,' . $paramYear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
         
          $dataCustomerFirms = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopData(3,0,' . $paramYear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
          
           $dataSampleTests = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopData(6,0,' . $paramYear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
           
         if (Yii::$app->request->isAjax) {
         return $this->renderAjax('_gridAllTop',['listYear'=>$listYear,'listLab'=>$listLab,'listIncomeTran'=>$listIncomeTran,'listCustomerFirms'=>$listCustomerFirms,
            'listSampleTests'=>$listSampleTests,'dataIncomeTrans'=>$dataIncomeTrans,'dataCustomerFirms'=>$dataCustomerFirms ,'dataSampleTests'=>$dataSampleTests]
        );
         }
         
         
        
    }
    
    public function actionTopdataretrieve(){
         
          $paramMode = Yii::$app->request->get('paramMode');
          $paramModeInt=1;
          $paramYear = Yii::$app->request->get('paramYear');
           $paramType = Yii::$app->request->get('paramType');
           $loadGrid='';
        //  $currentyear=2018;
         switch ($paramMode) 
        {
            case 'Income':
               $paramModeInt=1;
                break;
            case 'Transaction':
                $paramModeInt=2;
                break;
            case 'Customer':
                $paramModeInt=3;
                break;
            case 'New Customer':
                $paramModeInt=4;
                break;
            case 'Firms':
                $paramModeInt=5;
                break;
            case 'Sample':
                $paramModeInt=6;
                break;
            case 'Tests':
                $paramModeInt=7;
                break;
         }
         
         
         $dataGenericTop = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopData(' .$paramModeInt . ',0,' . $paramYear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
         
       
              
          if (Yii::$app->request->isAjax) {
            switch ($paramType) 
            {
            case 'IncomeTrans':
              // $loadGrid = '_gridIncomeTrans';
                return $this->renderAjax('_gridIncomeTrans', [
                'dataIncomeTrans' => $dataGenericTop
                ]);
                break;
            case 'CustomerFirms':
                // $loadGrid = '_gridCustomerFirms';
                return $this->renderAjax('_gridCustomerFirms', [
                'dataCustomerFirms' => $dataGenericTop
                ]);
                break;
            case 'SampleTests':
               //  $loadGrid = '_gridSampleTests';
                return $this->renderAjax('_gridSampleTests', [
                'dataSampleTests' => $dataGenericTop
                ]);
                break;
            }
          
         
         
          
        }
       // return Yii::$app->PostedData->GenerateChart($Income->ChartType, $Income->VerticalLabel, $Income->ChartTitle, $titleLink, $Categories, $Series,850,400,$Income->theme);
    }
    
    public function actionTopdatardi(){
        $dashArray = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 0 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
        $listLab=[];
        array_push($listLab,'All Laboratories');
        foreach ($dashArray as $col)
            {
               // $columnArray[]=$col['labname'];
                array_push($listLab,$col['labname']);
                 
            }
            
            
   //     $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 2 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
          $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spRetrieveTopManagementTopData(8,0,0);')->queryAll();
        $listYear=array();
        $currentyear=2018;
        $index = 0;
        foreach ($arrayYear as $colYear)
            {
               // $columnArray[]=$col['labname'];
                array_push($listYear,$colYear['iyear']);
                if($currentyear==$colYear['iyear'])
               {
                    $curYearValue=$index;
             }
                $index++;
        
            }
        $listIncomeTran=['Fees','Transaction'];
        $listCustomerFirms=['Customer','Firms'];
        $listSampleTests=['Sample','Tests'];
        
        
        $now = new DateTime();
        $currentyear= $now->format('Y');
        $currentyear = 2018;
        
         $dataIncomeTrans = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopDataRDI(1,0,' . $currentyear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
         
          $dataCustomerFirms = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopDataRDI(3,0,' . $currentyear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
          
           $dataSampleTests = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopDataRDI(6,0,' . $currentyear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
         
         
        return $this->render('topdatardi',['listYear'=>$listYear,'curYearValue'=>$curYearValue,'listLab'=>$listLab,'listIncomeTran'=>$listIncomeTran,'listCustomerFirms'=>$listCustomerFirms,
            'listSampleTests'=>$listSampleTests,'dataIncomeTrans'=>$dataIncomeTrans,'dataCustomerFirms'=>$dataCustomerFirms ,'dataSampleTests'=>$dataSampleTests]
        );
    }
    
    public function actionTopdataretrieverdi(){
         
          $paramMode = Yii::$app->request->get('paramMode');
          $paramModeInt=1;
          $paramYear = Yii::$app->request->get('paramYear');
           $paramType = Yii::$app->request->get('paramType');
           $loadGrid='';
        //  $currentyear=2018;
         switch ($paramMode) 
        {
            case 'Income':
               $paramModeInt=1;
                break;
            case 'Transaction':
                $paramModeInt=2;
                break;
            case 'Customer':
                $paramModeInt=3;
                break;
            case 'New Customer':
                $paramModeInt=4;
                break;
            case 'Firms':
                $paramModeInt=5;
                break;
            case 'Sample':
                $paramModeInt=6;
                break;
            case 'Tests':
                $paramModeInt=7;
                break;
         }
         
         
         $dataGenericTop = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopDataRDI(' .$paramModeInt . ',0,' . $paramYear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
         
       
              
          if (Yii::$app->request->isAjax) {
            switch ($paramType) 
            {
            case 'IncomeTrans':
              // $loadGrid = '_gridIncomeTrans';
                return $this->renderAjax('_gridIncomeTrans', [
                'dataIncomeTrans' => $dataGenericTop
                ]);
                break;
            case 'CustomerFirms':
                // $loadGrid = '_gridCustomerFirms';
                return $this->renderAjax('_gridCustomerFirms', [
                'dataCustomerFirms' => $dataGenericTop
                ]);
                break;
            case 'SampleTests':
               //  $loadGrid = '_gridSampleTests';
                return $this->renderAjax('_gridSampleTests', [
                'dataSampleTests' => $dataGenericTop
                ]);
                break;
            }
          
         
         
          
        }
       // return Yii::$app->PostedData->GenerateChart($Income->ChartType, $Income->VerticalLabel, $Income->ChartTitle, $titleLink, $Categories, $Series,850,400,$Income->theme);
    }
    
    public function actionTopdatareloadrdi()
     {
        
        $paramYear = Yii::$app->request->get('paramYear');
            $now = new DateTime();
        $currentyear= $now->format('Y');
        
        $dashArray = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 0 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
        $listLab=[];
        array_push($listLab,'All Laboratories');
        foreach ($dashArray as $col)
            {
               // $columnArray[]=$col['labname'];
                array_push($listLab,$col['labname']);
                 
            }
            
            
     //   $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 2 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
          $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spRetrieveTopManagementTopData(8,0,0);')->queryAll();
        $listYear=array();
     //  $currentyear=2015;
        $index = 0;
        foreach ($arrayYear as $colYear)
            {
               // $columnArray[]=$col['labname'];
                array_push($listYear,$colYear['iyear']);
            //    if($currentyear==$colYear['iyear'])
            //   {
            //        $curYearValue=$index;
           //  }
                $index++;
        
            }
        $listIncomeTran=['Fees','Transaction'];
        $listCustomerFirms=['Customer','Firms'];
        $listSampleTests=['Sample','Tests'];
        
        
    
    //    $currentyear = 2015;
        
         $dataIncomeTrans = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopDataRDI(1,0,' . $paramYear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
         
          $dataCustomerFirms = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopDataRDI(3,0,' . $paramYear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
          
           $dataSampleTests = new SqlDataProvider([
            'sql' => 'Call eulims_lab.spRetrieveTopManagementTopDataRDI(6,0,' . $paramYear . ');',
            
            'totalCount' => 10,
           'pagination' => [
                'pageSize' => 0
            ],
           
        ]);
           
         if (Yii::$app->request->isAjax) {
         return $this->renderAjax('_gridAllTopRDI',['listYear'=>$listYear,'listLab'=>$listLab,'listIncomeTran'=>$listIncomeTran,'listCustomerFirms'=>$listCustomerFirms,
            'listSampleTests'=>$listSampleTests,'dataIncomeTrans'=>$dataIncomeTrans,'dataCustomerFirms'=>$dataCustomerFirms ,'dataSampleTests'=>$dataSampleTests]
        );
         }
         
         
         
         
        
    }
       
  
    
     public function actionAccomplishments()
    {
       $pResultType = Yii::$app->request->get('type');
       $currentType = $pResultType;
       
       $currentType = 'Samples';
       
       //echo $pID;
       //exit;
       $now = new DateTime();
       $currentyear= $now->format('Y');
       $mainArray=array();
       $currentyear = 2019;
       $mainArray = $this->GenerateSamplesData($currentyear, 'Samples',false);
            
       $dataTables = $mainArray['dataTables'];
       $listYear=$mainArray['listYear'];
       $listRstl=$mainArray['listRstl'];
       $listlab=$mainArray['listlab'];
       $dataColumn= $mainArray['dataColumn'];
       $dataPieGraph=$mainArray['dataPieGraph'];
       $dataBar= $mainArray['dataBar'];
       $listMonths=$mainArray['listMonths'];
       $initialRegion=$mainArray['initialRegion'];
       $curYearValue =$mainArray['curYearValue'];
       $currentyear=$mainArray['currentyear'];
       $listIndicator=$mainArray['listIndicator'];
       
      $listTemp = '2015,2016,2017,2018,2019';
   //  $dataArrayRstl = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $listTemp));
      // $listTemp = implode (", ", $listRstl);
      //$dataArrayRstl = explode(", ", $listTemp);
        if (Yii::$app->request->isAjax)
            {
            return $this->renderAjax('accomplishments',['listYear'=>$listYear,'listRstl'=>$listRstl,'listlab'=>$listlab,'dataTables'=>$dataTables,
                  'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,
                  'dataBar'=> $dataBar,'listMonths'=>$listMonths,'initialRegion'=>$initialRegion,'curYearValue'=> $curYearValue,'selectedYear'=>$currentyear,'currentType'=>$currentType,'listIndicator'=>$listIndicator,'pTurn'=>'$pTurn','monthCount'=>'']);
            }
        
        else
        {
              return $this->render('accomplishments',['listYear'=>$listYear,'listRstl'=>$listRstl,'listlab'=>$listlab,'dataTables'=>$dataTables,
                  'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,
                  'dataBar'=> $dataBar,'listMonths'=>$listMonths,'initialRegion'=>$initialRegion,'curYearValue'=> $curYearValue,'selectedYear'=>$currentyear,'currentType'=>$currentType,'listIndicator'=>$listIndicator,'pTurn'=>'$pTurn','monthCount'=>'']);
        }
   
                
             
         
    }
    
     public function actionSubyear()
     {
      $pResultType = Yii::$app->request->get('type');
      $currentType = $pResultType;
      $pYear = Yii::$app->request->get('paramYear');
      
      $pTurn = Yii::$app->request->get('paramTurn');
      $boolExpand=false;
      
      if($pTurn=='on')
      {
          $boolExpand = true;
      }
      
      
      $currentType = Yii::$app->request->get('paramIndicator');
      $mainArray=array();
       $mainArray = $this->GenerateSamplesData($pYear,$currentType,$boolExpand);
            
       $dataTables = $mainArray['dataTables'];
       $listYear=$mainArray['listYear'];
       $listRstl=$mainArray['listRstl'];
       $listlab=$mainArray['listlab'];
       $dataColumn= $mainArray['dataColumn'];
       $dataPieGraph=$mainArray['dataPieGraph'];
       $dataBar= $mainArray['dataBar'];
       $listMonths=$mainArray['listMonths'];
       $initialRegion=$mainArray['initialRegion'];
       $curYearValue =$mainArray['curYearValue'];
       $currentyear=$mainArray['currentyear'];
       
      
     
      // $dataArrayRstl =array_map($listRstl); // array_map(function($v){ return (string) trim($v, "'"); }, explode(",", $listRstl));
     //   $dataArrayRstl = explode(", ", $listRstl); //array_map(function($v){ return (string) trim($v, "'"); }, explode(",", $rows['yeararray']));
       
         
      if (Yii::$app->request->isAjax)
            {
            return $this->renderAjax('_subyear',['listYear'=>$listYear,'listRstl'=>$listRstl,'listlab'=>$listlab,'dataTables'=>$dataTables,
                  'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,
                  'dataBar'=> $dataBar,'listMonths'=>$listMonths,'initialRegion'=>$initialRegion,'curYearValue'=> $curYearValue,'selectedYear'=>$currentyear,'currentType'=>$currentType,'pTurn'=>$pTurn,'monthCount'=>'']);
            }
        
        else
        {
              return $this->render('_subyear',['listYear'=>$listYear,'listRstl'=>$listRstl,'listlab'=>$listlab,'dataTables'=>$dataTables,
                  'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,
                  'dataBar'=> $dataBar,'listMonths'=>$listMonths,'initialRegion'=>$initialRegion,'curYearValue'=> $curYearValue,'selectedYear'=>$currentyear,'currentType'=>$currentType,'pTurn'=>$pTurn,'monthCount'=>'']);
        }
     }
    
   
    public function GenerateSamplesData($passYear,$passType,$boolExpand)
    {
        $strExpand = '';
        if($boolExpand)
        {
            $strExpand = 'expand';
        }
        
            
        $initialRegion="";
        $paramYear = $passYear; 
        
        $arrayYear =array();
       // $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 2 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
        $arrayYear = Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('accyear','".  $passType  ."'," . 0 . ",'','','Accomplishments');")->queryAll();
        $listYear=array();
        $currentyear=$passYear;
        $index = 0;
        
        $arrayRstl = Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('regionlist','".  $passType  ."'," . $paramYear . ",'','','Accomplishments');")->queryAll();
        
        
         $dataAccSamples = new SqlDataProvider([
            'sql' => "Call eulims_lab.spRetrieveAccomplishmentData('data". $strExpand ."','". $passType ."'," . $paramYear .  ",'',,'','Accomplishments');",
            'totalCount' => 10,
          'pagination' => [
                'pageSize' => 0
           ],
        ]);
        
      
      // $currentyear = $paramYear;    
            
        foreach ($arrayYear as $colYear)
            {
               // $columnArray[]=$col['labname'];
                array_push($listYear,$colYear['iyear']);
                if($paramYear==$colYear['iyear'])
               {
                    $curYearValue=$index;
               }
                $index++;
        
            }
        
        $dataTables = new SqlDataProvider([
            'sql' => "Call eulims_lab.spRetrieveAccomplishmentData('data". $strExpand  ."','" . $passType ."'," . $paramYear .  ",'DOST-IX','','Accomplishments');",
            'totalCount' => 10,
          'pagination' => [
                'pageSize' => 0
           ],
        ]);
        
        // ------------------------------------START BAR GRAPH
        $dataBarQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('bar". $strExpand ."','". $passType ."'," . $paramYear . ",'','','Accomplishments');")->queryAll();
        
        $dataBar=array();
        $listRstl=array();
         
        foreach ($dataBarQuery  as $eachRow)
            {
              $recData=array();
            //  $recFeesData['type']='column';
              $recData['name']=$eachRow['name'] . ' ( ' . $eachRow['legend'] . ' )';
              $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $eachRow['data']));
              $recData['data']=$result;  //$eachRow['data'];;
               $recData['color']=$eachRow['color'];
             array_push($listRstl,$eachRow['name']);
             array_push($dataBar,$recData);
            }; 
        
        // -----------------------------------END BAR GRAPH
            
       $initialRegion = $listRstl[0];  //Initial Region 
        // ------------------------------------START COLUMN GRAPH    
        $dataColumnQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('columnrstl','" . $passType ."'," . $paramYear . ",'" . $initialRegion ."','','Accomplishments');")->queryAll();
        
        $dataColumn=array();
        $listlab =array();
        
        
         
        foreach ($dataColumnQuery  as $eachRow)
            {
              $recSamplesData=array();
              $recSamplesData['type']='column';
              $recSamplesData['name']=$eachRow['name'];
              $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $eachRow['data']));
              $recSamplesData['data']=$result;
               $recSamplesData['color']=$eachRow['color'];
             array_push($dataColumn,$recSamplesData);
             array_push($listlab,$eachRow['name']);
            }
            
         
            
        // ------------------------------------END COLUMN GRAPH 
            
            $dataPieSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('pieall','" . $passType ."'," . $paramYear . ",'" . $initialRegion ."','','Accomplishments');")->queryAll();
          
        // ------------------------------------START PIE GRAPH  
            $dataPieGraph=array();
            foreach ($dataPieSamplesQuery as $rows)
                 {
                     $arrayGraphPieRec=array();
                     $arrayGraphPieRec['name']= $rows['month'];
                     $arrayGraphPieRec['y']= (int)$rows['count'];
                     $arrayGraphPieRec['sliced']= 'sliced';
                     $arrayGraphPieRec['color']= $rows['monthcolor'];
                     array_push($dataPieGraph,$arrayGraphPieRec);
                 }
                 
         // ------------------------------------END PIE GRAPH          
        
         $listIndicator=array("Samples","Tests","Customers","New Customers","Firms","Fees","CSI");
         $listMonths =array("All","January","February","March","April","May","June","July","August","September","October","November","December");
      
         
       
        $mainArray = array();
        $mainArray['listYear']=$listYear;
        $mainArray['listRstl']=$listRstl;
        $mainArray['listlab']=$listlab;
        $mainArray['dataTables']=$dataTables; 
        $mainArray['dataColumn']=$dataColumn;
        $mainArray['dataPieGraph']=$dataPieGraph;
        $mainArray['dataBar']=$dataBar;
        $mainArray['listMonths']=$listMonths;
        $mainArray['initialRegion']=$initialRegion;
        $mainArray['curYearValue']= $curYearValue;
        $mainArray['currentyear'] = $currentyear;
        $mainArray['listIndicator'] = $listIndicator;
      
        return $mainArray;
        
          
    }
            
    public function actionSubcolumnpie()
    {
        $pResultType = Yii::$app->request->get('type');
        $currentType = $pResultType;
      
        $pYear = Yii::$app->request->get('paramYear');
        $pRstl = Yii::$app->request->get('paramRstl');
        
        
        $dataBarSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('bar','" . $pRstl . "'," . $pYear . ",'','','Accomplishments');")->queryAll();
        
      
        $listRstl=array();
         
        foreach ($dataBarSamplesQuery  as $eachRow)
            {
             array_push($listRstl,$eachRow['name']);
            }; 
 
        $dataColumnQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('columnrstl','". $currentType ."'," . $pYear . ",'" . $pRstl ."','','Accomplishments');")->queryAll();
       
        $dataColumn=array();
        $listlab =array();
         
        foreach ($dataColumnQuery  as $eachRow)
            {
              $recSamplesData=array();
              $recSamplesData['type']='column';
              $recSamplesData['name']=$eachRow['name'];
              $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $eachRow['data']));
              $recSamplesData['data']=$result;
               $recSamplesData['color']=$eachRow['color'];
             array_push($dataColumn,$recSamplesData);
             array_push($listlab,$eachRow['name']);
            }
            
            $dataPieSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('pieall','" . $currentType ."'," . $pYear . ",'" . $pRstl ."','','Accomplishments');")->queryAll();
          
            $dataPieGraph=array();
            foreach ($dataPieSamplesQuery as $rows)
                 {
                     $arrayGraphPieRec=array();
                     $arrayGraphPieRec['name']= $rows['month'];
                     $arrayGraphPieRec['y']= (int)$rows['count'];
                     $arrayGraphPieRec['sliced']= 'sliced';
                     $arrayGraphPieRec['color']= $rows['monthcolor'];
                     array_push($dataPieGraph,$arrayGraphPieRec);
                 }
                 
           $listMonths =array("All","January","February","March","April","May","June","July","August","September","October","November","December");
           
           if (Yii::$app->request->isAjax)
            {
           return $this->renderAjax('_subcolumnpie',['dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,
            'initialRegion'=>$pRstl,'selectedYear'=>$pYear,'listRstl'=>$listRstl,'listMonths'=>$listMonths,'currentType'=>$currentType,'monthCount'=>'']);
            }
        
        else
        {
               return $this->render('_subcolumnpie',['dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,
            'initialRegion'=>$pRstl,'selectedYear'=>$pYear,'listRstl'=>$listRstl,'listMonths'=>$listMonths,'currentType'=>$currentType,'monthCount'=>'']);
        }
                 
       
    }
    
    public function actionSubpie()
    {
        $pResultType = Yii::$app->request->get('type');
        $currentType = $pResultType;
        $pRstl = Yii::$app->request->get('paramRstl');
        $pMonth = Yii::$app->request->get('paramMonth');
        $pYear = Yii::$app->request->get('paramYear');
        
        $monthCount='';
        if ($pMonth == "All")
        {
         $dataPieSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('pieall','". $currentType ."'," . $pYear . ",'" . $pRstl ."','','Accomplishments');")->queryAll();
          
            $dataPieGraph=array();
            foreach ($dataPieSamplesQuery as $rows)
                 {
                     $arrayGraphPieRec=array();
                     $arrayGraphPieRec['name']= $rows['month'];
                     $arrayGraphPieRec['y']= (int)$rows['count'];
                     $arrayGraphPieRec['sliced']= 'sliced';
                     $arrayGraphPieRec['color']= $rows['monthcolor'];
                     array_push($dataPieGraph,$arrayGraphPieRec);
                 }
                 
        }
        else
        {
             $counterMonth=0;
            $dataPieSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('piemonth','" . $currentType ."'," . $pYear . ",'" .$pRstl."','". $pMonth . "','Accomplishments');")->queryAll();
            $dataPieGraph=array();
            foreach ($dataPieSamplesQuery as $rows)
                 {
                     $arrayGraphPieRec=array();
                     $arrayGraphPieRec['name']= $rows['lab'];
                     $arrayGraphPieRec['y']= (int)$rows['counter'];
                     $counterMonth = $counterMonth + (int)$rows['counter'];
                     $arrayGraphPieRec['sliced']= 'sliced';
                    $arrayGraphPieRec['color']= $rows['color'];
                     array_push($dataPieGraph,$arrayGraphPieRec);
                 }
                 
                   $monthCount= '( ' . Yii::$app->request->get('paramMonth') . ' : ' . $counterMonth . ' )';
        }
        
        
        
          if (Yii::$app->request->isAjax)
            {
              return $this->renderAjax('_subpie',['dataPieGraph'=>$dataPieGraph,'selectedYear'=>$pYear,'initialRegion'=>$pRstl,'currentType'=>$currentType,'monthCount'=>$monthCount]);
            }
        
            else
            {
                  return $this->render('_subpie',['dataPieGraph'=>$dataPieGraph,'selectedYear'=>$pYear,'initialRegion'=>$pRstl,'currentType'=>$currentType,'monthCount'=>$monthCount]);
            }
    }
    
   public function actionAccomplishmentrdi()
   {
       $now = new DateTime();
       $currentyear= $now->format('Y');
       $currentRDI = 'ITDI';
       $currentyear = 2019;
       $mainArray = $this->GenerateRDIData($currentyear,'samples',$currentRDI);
       $selectedYear = $currentyear;
        $listYear = $mainArray['listYear'];
        $dataTables = $mainArray['dataTables']; 
        $dataColumn = $mainArray['dataColumn'];
        $dataPieGraph= $mainArray['dataPieGraph'];
        $dataBarGraph = $mainArray['dataBarGraph'];
        
        $curYearValue = $mainArray['curYearValue'];
        $currentyear = $mainArray['currentyear'];
        $listIndicator = $mainArray['listIndicator'];
        
        $listMonths = $mainArray['listMonths'];
        $listRDI = $mainArray['listRDI'];
            
       if (Yii::$app->request->isAjax)
            {
              return $this->renderAjax('accomplishmentrdi',['listYear'=>$listYear,'curYearValue'=>$curYearValue,'dataTables'=>$dataTables,'dataBarGraph'=>$dataBarGraph,'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'listIndicator'=>$listIndicator,'listMonths'=>$listMonths,'listRDI'=>$listRDI,'CurrentIndicator'=>'Samples','selectedYear'=>$selectedYear,'currentRDI'=>$currentRDI,'monthCount'=>'']);
            }
        
            else
            {
                  return $this->render('accomplishmentrdi',['listYear'=>$listYear,'curYearValue'=>$curYearValue,'dataTables'=>$dataTables,'dataBarGraph'=>$dataBarGraph,'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'listIndicator'=>$listIndicator,'listMonths'=>$listMonths,'listRDI'=>$listRDI,'CurrentIndicator'=>'Samples','selectedYear'=>$selectedYear,'currentRDI'=>$currentRDI,'monthCount'=>'']);
            }
   }
   
   
   public function GenerateRDIData($passYear,$passIndicator,$passRDI)
   {
       
        $arrayYear =array();
       // $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 2 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
       $arrayYear = Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('rdiyear','',0,'',0,'','Accomplishments');")->queryAll();
        $listYear=array();
        $currentyear=$passYear;
        $paramYear=$passYear;
        $index = 0;
        
        
         foreach ($arrayYear as $colYear)
            {
               // $columnArray[]=$col['labname'];
                array_push($listYear,$colYear['iyear']);
                if($paramYear==$colYear['iyear'])
               {
                    $curYearValue=$index;
               }
                $index++;
        
            }
        
        $arrayRDI = Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('listrdi','',0,'',0,'','Accomplishments')")->queryAll();
        $listRDI=array();
        
        foreach ($arrayRDI as $rowRDI)
            {
                array_push($listRDI,$rowRDI['rdi']);
            }
     //   $arrayRstl = Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('regionlist','".  $passType  ."'," . $paramYear . ",'','');")->queryAll();
        
         $dataTables = new SqlDataProvider([
            'sql' => "Call eulims_lab.spRetrieveAccomplishmentData_RDI('data',''," . $passYear .",'',0,'','Accomplishments');",
            'totalCount' => 10,
          'pagination' => [
                'pageSize' => 0
           ],
        ]);
         
         
     
          
        $dataBarQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('bar','" . $passIndicator . "'," . $passYear . ",'',0,'','Accomplishments');")->queryAll();
        
        $dataBarGraph=array();
    //    $listRstl=array();
         
        foreach ($dataBarQuery  as $eachRow)
            {
              $recData=array();
            //  $recFeesData['type']='column';
            //  $recData['name']=$eachRow['legend'];
              $recData['name']= $eachRow['name'] . ' ( ' . $eachRow['legend'] . ' )';
              $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $eachRow['data']));
              $recData['data']=$result;  //$eachRow['data'];;
               $recData['color']=$eachRow['color'];
          //   array_push($listRstl,$eachRow['name']);
             array_push($dataBarGraph,$recData);
            }; 
            
    
      // $currentyear = $paramYear;    
            
        
            
        $dataColumnQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('columnrdi','" . $passIndicator . "'," . $passYear . ",'" . $passRDI .  "',0,'','Accomplishments')")->queryAll();
        
        $dataColumn=array();
      //  $listlab =array();
        
        
         
        foreach ($dataColumnQuery  as $eachRow)
            {
              $recSamplesData=array();
              $recSamplesData['type']='column';
              $recSamplesData['name']=$eachRow['name'];
              $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $eachRow['data']));
              $recSamplesData['data']=$result;
               $recSamplesData['color']=$eachRow['color'];
             array_push($dataColumn,$recSamplesData);
         //    array_push($listlab,$eachRow['name']);
            }
            
            
             $dataPieSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('pieall','" . $passIndicator . "'," . $passYear . ",'" . $passRDI . "',0,'','Accomplishments');")->queryAll();
          
        // ------------------------------------START PIE GRAPH  
            $dataPieGraph=array();
            foreach ($dataPieSamplesQuery as $rows)
                 {
                     $arrayGraphPieRec=array();
                     $arrayGraphPieRec['name']= $rows['month'];
                     $arrayGraphPieRec['y']= (int)$rows['count'];
                     $arrayGraphPieRec['sliced']= 'sliced';
                     $arrayGraphPieRec['color']= $rows['monthcolor'];
                     array_push($dataPieGraph,$arrayGraphPieRec);
                 }
                 
        $listIndicator=array("Samples","Tests","Customers","New Customers","Firms","Fees","CSI");
        $listMonths =array("All","January","February","March","April","May","June","July","August","September","October","November","December");
            
        $mainArray = array();
        
        
        $mainArray['listYear']=$listYear;
        
        $mainArray['dataTables']=$dataTables; 
        $mainArray['dataColumn']=$dataColumn;
        $mainArray['dataPieGraph']=$dataPieGraph;
        $mainArray['dataBarGraph']=$dataBarGraph;
        
        //$mainArray['listMonths']=$listMonths;
       // $mainArray['initialRegion']=$initialRegion;
        $mainArray['curYearValue']= $curYearValue;
        $mainArray['currentyear'] = $currentyear;
        $mainArray['listIndicator'] = $listIndicator;
        $mainArray['listMonths'] = $listMonths;
         $mainArray['listRDI'] = $listRDI;
        return $mainArray;
            
            
   }
   
    public function actionSubyearrdi()
    {
    //  $pResultIndicator = Yii::$app->request->get('indicator');
    //  $pResultIndicator = str_replace(' ', '', $pResultIndicator);
    //  $CurrentIndicator = strtolower($pResultIndicator) ;
      
      $pYear = Yii::$app->request->get('paramYear');
      $currentRDI = 'ITDI';
      
        $ResultIndicator = Yii::$app->request->get('indicator');
        
        
        $mainArray = $this->GenerateRDIData($pYear,'samples',$currentRDI);
       
        $listYear = $mainArray['listYear'];
        $dataTables = $mainArray['dataTables']; 
        $dataColumn = $mainArray['dataColumn'];
        $dataPieGraph= $mainArray['dataPieGraph'];
        $dataBarGraph = $mainArray['dataBarGraph'];
        
        $curYearValue = $mainArray['curYearValue'];
        $currentyear = $mainArray['currentyear'];
        $listIndicator = $mainArray['listIndicator'];
        
        $listMonths = $mainArray['listMonths'];    
        $listRDI = $mainArray['listRDI'];  
     
         
        
         if (Yii::$app->request->isAjax)
            {
              return $this->renderAjax('_subyearrdi',['listYear'=>$listYear,'curYearValue'=>$curYearValue,'dataTables'=>$dataTables,'dataBarGraph'=>$dataBarGraph,'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'listMonths'=>$listMonths,'listIndicator'=>$listIndicator,'listRDI'=>$listRDI,'CurrentIndicator'=>'Samples','selectedYear'=>$pYear,'currentRDI'=>$currentRDI,'monthCount'=>'']);
            }
        
            else
            {
                  return $this->render('_subyearrdi',['listYear'=>$listYear,'curYearValue'=>$curYearValue,'dataTables'=>$dataTables,'dataBarGraph'=>$dataBarGraph,'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'listMonths'=>$listMonths,'listIndicator'=>$listIndicator,'listRDI'=>$listRDI,'CurrentIndicator'=>'Samples','selectedYear'=>$pYear,'currentRDI'=>$currentRDI,'monthCount'=>'']);
            }
    }
    
     public function actionIndicatorsubyearrdi()
     {
            //  $pResultIndicator = Yii::$app->request->get('indicator');
    //  $pResultIndicator = str_replace(' ', '', $pResultIndicator);
    //  $CurrentIndicator = strtolower($pResultIndicator) ;
         
     //  = 'ITDI';
       $currentRDI = Yii::$app->request->get('paramRDI');
      $pYear = Yii::$app->request->get('paramYear');
      $pIndicator = Yii::$app->request->get('paramIndicator');
      $pIndicator = str_replace(' ', '', $pIndicator);
      
       $CurrentIndicator = Yii::$app->request->get('paramIndicator');
      
      
      $passIndicator =strtolower($pIndicator);
      $passYear = $pYear;
      
      
       $dataBarQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('bar','" . $passIndicator . "'," . $passYear . ",'',0,'','Accomplishments');")->queryAll();
        
        $dataBarGraph=array();
    //    $listRstl=array();
         
        foreach ($dataBarQuery  as $eachRow)
            {
              $recData=array();
            //  $recFeesData['type']='column';
              $recData['name']=$eachRow['name'] . ' ( ' .$eachRow['legend']. ' )';
              $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $eachRow['data']));
              $recData['data']=$result;  //$eachRow['data'];;
               $recData['color']=$eachRow['color'];
          //   array_push($listRstl,$eachRow['name']);
             array_push($dataBarGraph,$recData);
            }; 
            
    
      // $currentyear = $paramYear;    
            
        
            
        $dataColumnQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('columnrdi','" . $passIndicator . "'," . $passYear . ",'" . $currentRDI . "',0,'','Accomplishments')")->queryAll();
        
        $dataColumn=array();
      //  $listlab =array();
        
        
         
        foreach ($dataColumnQuery  as $eachRow)
            {
              $recSamplesData=array();
              $recSamplesData['type']='column';
              $recSamplesData['name']=$eachRow['name'];
              $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $eachRow['data']));
              $recSamplesData['data']=$result;
               $recSamplesData['color']=$eachRow['color'];
             array_push($dataColumn,$recSamplesData);
         //    array_push($listlab,$eachRow['name']);
            }
            
            
             $dataPieSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('pieall','" . $passIndicator . "'," . $passYear . ",'" . $currentRDI . "',0,'','Accomplishments');")->queryAll();
          
        // ------------------------------------START PIE GRAPH  
            $dataPieGraph=array();
            foreach ($dataPieSamplesQuery as $rows)
                 {
                     $arrayGraphPieRec=array();
                     $arrayGraphPieRec['name']= $rows['month'];
                     $arrayGraphPieRec['y']= (int)$rows['count'];
                     $arrayGraphPieRec['sliced']= 'sliced';
                     $arrayGraphPieRec['color']= $rows['monthcolor'];
                     array_push($dataPieGraph,$arrayGraphPieRec);
                 }
                 
        $listIndicator=array("Samples","Tests","Customers","New Customers","Firms","Fees","CSI");
        $listMonths =array("All","January","February","March","April","May","June","July","August","September","October","November","December");
         
         if (Yii::$app->request->isAjax)
            {
              return $this->renderAjax('_indicatorsubyearrdi',['dataBarGraph'=>$dataBarGraph,'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'listMonths'=>$listMonths,'listIndicator'=>$listIndicator,'CurrentIndicator'=>$CurrentIndicator,'selectedYear'=>$pYear,'currentRDI'=>$currentRDI,'monthCount'=>'']);
            }
        
            else
            {
                  return $this->render('_indicatorsubyearrdi',['dataBarGraph'=>$dataBarGraph,'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'listMonths'=>$listMonths,'listIndicator'=>$listIndicator,'CurrentIndicator'=>$CurrentIndicator,'selectedYear'=>$pYear,'currentRDI'=>$currentRDI,'monthCount'=>'']);
            }
     }
    public function actionSubcolumnpierdi()
    {
      $pYear = Yii::$app->request->get('paramYear');
      $pIndicator = Yii::$app->request->get('paramIndicator');
      $CurrentIndicator =Yii::$app->request->get('paramIndicator');
      $pRDI = Yii::$app->request->get('paramRDI');
      
      $pIndicator = str_replace(' ', '', $pIndicator);
      
      
      $passIndicator =strtolower($pIndicator);
      $passYear = $pYear;
      
     
      
       $dataColumnQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('columnrdi','" . $passIndicator . "'," . $passYear . ",'" .  $pRDI . "',0,'','Accomplishments')")->queryAll();
        
        $dataColumn=array();
      //  $listlab =array();
        
        
         
        foreach ($dataColumnQuery  as $eachRow)
            {
              $recSamplesData=array();
              $recSamplesData['type']='column';
              $recSamplesData['name']=$eachRow['name'];
              $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $eachRow['data']));
              $recSamplesData['data']=$result;
               $recSamplesData['color']=$eachRow['color'];
             array_push($dataColumn,$recSamplesData);
         //    array_push($listlab,$eachRow['name']);
            }
            
            
             $dataPieSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('pieall','" . $passIndicator . "'," . $passYear . ",'" . $pRDI . "',0,'','Accomplishments');")->queryAll();
          
        // ------------------------------------START PIE GRAPH  
            $dataPieGraph=array();
            foreach ($dataPieSamplesQuery as $rows)
                 {
                     $arrayGraphPieRec=array();
                     $arrayGraphPieRec['name']= $rows['month'];
                     $arrayGraphPieRec['y']= (int)$rows['count'];
                     $arrayGraphPieRec['sliced']= 'sliced';
                     $arrayGraphPieRec['color']= $rows['monthcolor'];
                     array_push($dataPieGraph,$arrayGraphPieRec);
                 }
                 
      
          $listMonths =array("All","January","February","March","April","May","June","July","August","September","October","November","December");
          
          if (Yii::$app->request->isAjax)
            {
              return $this->renderAjax('_subcolumnpierdi',['listMonths'=>$listMonths,'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'CurrentIndicator'=>$CurrentIndicator,'selectedYear'=>$pYear,'currentRDI'=>$pRDI,'monthCount'=>'']);
            }
        
            else
            {
                  return $this->render('_subcolumnpierdi',['listMonths'=>$listMonths,'dataColumn'=>$dataColumn,'dataPieGraph'=>$dataPieGraph,'CurrentIndicator'=>$CurrentIndicator,'selectedYear'=>$pYear,'currentRDI'=>$pRDI,'monthCount'=>'']);
            }
    }
    
     public function actionSubpierdi()
     {
         //  data: {paramYear:strYear,paramIndicator:strIndicator,paramRDI:strRDI,paramMonth:strMonth},

        $pYear = Yii::$app->request->get('paramYear');
        $pIndicator = Yii::$app->request->get('paramIndicator');
        $pRDI = Yii::$app->request->get('paramRDI');
        $pMonth = Yii::$app->request->get('paramMonth');
        
        $pMonth = substr($pMonth,0,3);

        $pIndicator = str_replace(' ', '', $pIndicator);


        $passIndicator =strtolower($pIndicator);
        $passYear = $pYear;
         $monthCount='';
        
        if ($pMonth == "All")
        {
           $dataPieSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('pieall','" . $passIndicator . "'," . $passYear . ",'" . $pRDI . "',0,'','Accomplishments');")->queryAll();
           
            $dataPieGraph=array();
            foreach ($dataPieSamplesQuery as $rows)
                 {
                     $arrayGraphPieRec=array();
                     $arrayGraphPieRec['name']= $rows['month'];
                     $arrayGraphPieRec['y']= (int)$rows['count']; 
                     $arrayGraphPieRec['sliced']= 'sliced';
                     $arrayGraphPieRec['color']= $rows['monthcolor'];
                     array_push($dataPieGraph,$arrayGraphPieRec);
                 }
                 
        }
        else
        {
           
            $counterMonth=0;
            $dataPieSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_RDI('piemonth','" . $passIndicator . "'," . $passYear . ",'" . $pRDI . "',0,'" . strtolower($pMonth) . "','Accomplishments');")->queryAll();
            $dataPieGraph=array();
            foreach ($dataPieSamplesQuery as $rows)
                 {
                     $arrayGraphPieRec=array();
                     $arrayGraphPieRec['name']= $rows['lab'];
                     $arrayGraphPieRec['y']= (int)$rows['counter'];
                     $counterMonth = $counterMonth + (int)$rows['counter'];
                     $arrayGraphPieRec['sliced']= 'sliced';
                    $arrayGraphPieRec['color']= $rows['color'];
                    array_push($dataPieGraph,$arrayGraphPieRec);
                 }
                 
                  $monthCount= '( ' . Yii::$app->request->get('paramMonth') . ' : ' . $counterMonth . ' )';
        }
        
        
                 

            if (Yii::$app->request->isAjax)
              {
                return $this->renderAjax('_subpierdi',['dataPieGraph'=>$dataPieGraph,'CurrentIndicator'=>$pIndicator,'selectedYear'=>$pYear,'currentRDI'=>$pRDI,'monthCount'=>$monthCount]);
              }

              else
              {
                    return $this->render('_subpierdi',['dataPieGraph'=>$dataPieGraph,'CurrentIndicator'=>$pIndicator,'selectedYear'=>$pYear,'currentRDI'=>$pRDI,'monthCount'=>$monthCount]);
              }
     }
     
     
     
     public function actionAccomplishmentperrstl()
     {
         //  data: {paramYear:strYear,paramIndicator:strIndicator,paramRDI:strRDI,paramMonth:strMonth},
         
       $arrayYear =array();
       // $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 2 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
        $arrayYear = Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('accyear','".  'samples'  ."'," . 0 . ",'','','Accomplishments');")->queryAll();
        $listYear=array();
          $labtype='';
        
        foreach ($arrayYear as $colYear)
            {
               // $columnArray[]=$col['labname'];
                array_push($listYear,$colYear['iyear']);
              //  if($paramYear==$colYear['iyear'])
              // {
             //       $curYearValue=$index;
             //  }
            //    $index++;
            }
       
      $indiType = '';
      
      $curType = Yii::$app->user->identity->type;
      
      if($curType == 'ITDI' || $curType == 'FPRDI'  || $curType == 'FNRI' || $curType == 'MIRDC' || $curType == 'PNRI' || $curType == 'PTRI' )
        {
            $indiType = strtolower($curType);
              $labtype='rdi';
        }
        else
        {
             $indiType = 'rstl';
               $labtype='rstl';
        }   
      
      $dataLineSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('line" . $indiType . "','" . $curType . "','" . "samples" . "',0,'Accomplishments')")->queryAll();
      //$dataLineTestsQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('linetests','" .  "DOST-IX" . "','" . "tests" . "',0)")->queryAll();
      //$dataLineCustomerQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('linecustomer','" .  "DOST-IX" . "','" . "customers" . "',0)")->queryAll();
      
        // ------------------------------------START PIE GRAPH  
        
      foreach ($dataLineSamplesQuery as $rows)
      {
       $arrayLineRec =array();
       $arrayLineRec['name'] = 'Samples';
       $arrayLineRec['data'] = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['dataarray']));
       $dataArrayYear = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['yeararray']));
       
      }
      
      
   
         
            
     
         $dataColumnQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('column". $indiType ."','" .  $curType . "','" . "samples" . "',0,'Accomplishments')")->queryAll();
       //  $dataColumnTestsQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('column','" .  "DOST-IX" . "','" . "tests" . "',0)")->queryAll();
       //  $dataColumnCustomersQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('column','" .  "DOST-IX" . "','" . "customers" . "',0)")->queryAll();
   
         $dataColumnGraph=array();
         
            foreach ($dataColumnQuery as $rows)
                 {
                        
                     $arrayColumnRec=array();
                     
                     $arrayColumnRec['name']= $rows['name'];
                     $arrayColumnRec['data']=  array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['data']));
                  //   $arrayGraphPieRec['sliced']= 'sliced';
                     $arrayColumnRec['stack']= $rows['stack'];
                     array_push($dataColumnGraph,$arrayColumnRec);
                 }
                 
          $listIndicator=array("Samples","Tests","Customers","New Customers","Firms","Fees","CSI");       
           
         $dataAccomp=array();
         $columarrstring='';     
         if($indiType=='rstl')
         {
          $columarrstring = 'columnacctar' . $indiType;
         }
         else
         {
             $columarrstring = 'columnacctarrdi';
         }
         
         
         
           $dataColumnQueryAcc =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('" . $columarrstring . "','" .  $curType . "','" . 'samples' . "',0,'Accomplishments')")->queryAll();
         foreach ($dataColumnQueryAcc as $rows)
                 {
                     $arrayColumnRecAcc=array();
                     $arrayColumnRecAcc['name']= 'Accomplishments';
                     $arrayColumnRecAcc['data']=  array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['data']));
                     $arrayColumnRecAcc['color']= '#4FC3F7';
                     $arrayColumnRecAcc['pointPadding']= 0.3;
                     $arrayColumnRecAcc['pointPlacement']= -0.2;
                     array_push($dataAccomp,$arrayColumnRecAcc);
                 }
         
         $dataTargets=array();
         $dataColumnQueryTar =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('". $columarrstring . "','" .  $curType . "','" . 'samples' . "',0,'Targets')")->queryAll();
         foreach ($dataColumnQueryTar as $rows)
                 {
                     $arrayColumnRecTar=array();
                     $arrayColumnRecTar['name']= 'Targets';
                     $arrayColumnRecTar['data']=  array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['data']));
                     $arrayColumnRecTar['color']= '#4CAF50';
                     $arrayColumnRecTar['pointPadding']= 0.4;
                     $arrayColumnRecTar['pointPlacement']= -0.2;
                     array_push($dataTargets,$arrayColumnRecTar);
                 }
           $listIndicatorAcc=array('Samples','Tests','Customers','Firms','Fees','CSI','New Customers');         
         if (Yii::$app->request->isAjax)
              {
                return $this->renderAjax('accomplishmentperrstl',['dataArrayYear'=>$dataArrayYear,'arrayLineRec'=>$arrayLineRec,'dataColumnGraph'=>$dataColumnGraph,'listIndicator'=>$listIndicator,'curIndicator'=>'Samples','listYear'=>$listYear,'listIndicatorAcc'=>$listIndicatorAcc,'dataAccomp'=>$dataAccomp,'dataTargets'=>$dataTargets]);
              }

              else
              {
                    return $this->render('accomplishmentperrstl',['dataArrayYear'=>$dataArrayYear,'arrayLineRec'=>$arrayLineRec,'dataColumnGraph'=>$dataColumnGraph,'listIndicator'=>$listIndicator,'curIndicator'=>'Samples','listYear'=>$listYear,'listIndicatorAcc'=>$listIndicatorAcc,'dataAccomp'=>$dataAccomp,'dataTargets'=>$dataTargets]);
              }
     }
     
     
      public function actionLinecolumnperrstl()
      {
          $CurrentIndicator =Yii::$app->request->get('paramIndicator');
          $pIndicator = str_replace(' ', '', $CurrentIndicator);
            $passIndicator =strtolower($pIndicator);
            
        $indiType = '';
          $listYear=array();
         $labtype='';
      
        $curType = Yii::$app->user->identity->type;
      
        if($curType == 'ITDI' || $curType == 'FPRDI'  || $curType == 'FNRI' || $curType == 'MIRDC' || $curType == 'PNRI' || $curType == 'PTRI' )
        {
            $indiType = strtolower($curType);
            $labtype='rdi';
        }
        else
        {
             $indiType = 'rstl';
             $labtype='rstl';
        }   
          
         
          $dataLineSamplesQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('line" . $indiType . "','" .  $curType . "','" . strtolower($passIndicator) . "',0,'Accomplishments')")->queryAll();
      //$dataLineTestsQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('linetests','" .  "DOST-IX" . "','" . "tests" . "',0)")->queryAll();
      //$dataLineCustomerQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('linecustomer','" .  "DOST-IX" . "','" . "customers" . "',0)")->queryAll();
      
        // ------------------------------------START PIE GRAPH  
        
      foreach ($dataLineSamplesQuery as $rows)
      {
       $arrayLineRec =array();
       $arrayLineRec['name'] = 'Samples';
       $arrayLineRec['data'] = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['dataarray']));
       $dataArrayYear = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['yeararray']));
       
      }
      
       
         $dataColumnQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('column" . $indiType . "','" .  $curType . "','" . strtolower($passIndicator) . "',0,'Accomplishments')")->queryAll();
     
         $dataColumnGraph=array();
         
            foreach ($dataColumnQuery as $rows)
                 {
                        
                     $arrayColumnRec=array();
                     
                     $arrayColumnRec['name']= $rows['name'];
                     $arrayColumnRec['data']=  array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['data']));
                  //   $arrayGraphPieRec['sliced']= 'sliced';
                     $arrayColumnRec['stack']= $rows['stack'];
                   //  $arrayColumnRec['color']= $rows['red'];
                     array_push($dataColumnGraph,$arrayColumnRec);
                 }
          
            $listIndicator=array("Samples","Tests","Customers","New Customers","Firms","Fees","CSI");       
                 
         $dataAccomp=array();
         $dataColumnQueryAcc =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('columnacctar". $labtype ."','" .  $curType . "','" . strtolower($passIndicator) . "',0,'Accomplishments')")->queryAll();
        
         foreach ($dataColumnQueryAcc as $rows)
                 {
                     $arrayColumnRecAcc=array();
                     $arrayColumnRecAcc['name']= 'Accomplishments';
                     $arrayColumnRecAcc['data']=  array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['data']));
                     $arrayColumnRecAcc['color']= '#4FC3F7';
                     $arrayColumnRecAcc['pointPadding']= 0.3;
                     $arrayColumnRecAcc['pointPlacement']= -0.2;
                     array_push($dataAccomp,$arrayColumnRecAcc);
                 }
         
         $dataTargets=array();
         $dataColumnQueryTar =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentDataPerRSTL('columnacctar". $labtype ."','" .  $curType . "','" . strtolower($passIndicator) . "',0,'Targets')")->queryAll();
         foreach ($dataColumnQueryTar as $rows)
                 {
                     $arrayColumnRecTar=array();
                     $arrayColumnRecTar['name']= 'Targets';
                     $arrayColumnRecTar['data']=  array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['data']));
                     $arrayColumnRecTar['color']= '#4CAF50';
                     $arrayColumnRecTar['pointPadding']= 0.4;
                     $arrayColumnRecTar['pointPlacement']= -0.2;
                     array_push($dataTargets,$arrayColumnRecTar);
                 }
           $listIndicatorAcc=array('Samples','Tests','Customers','Firms','Fees','CSI','New Customers');        
                 
           if (Yii::$app->request->isAjax)
              {
                return $this->renderAjax('_linecolumnperrstl',['dataArrayYear'=>$dataArrayYear,'arrayLineRec'=>$arrayLineRec,'dataColumnGraph'=>$dataColumnGraph,'curIndicator'=>$CurrentIndicator,'listYear'=>$listYear,'listIndicatorAcc'=>$listIndicatorAcc,'dataAccomp'=>$dataAccomp,'dataTargets'=>$dataTargets]);
              }

              else
              {
                    return $this->render('_linecolumnperrstl',['dataArrayYear'=>$dataArrayYear,'arrayLineRec'=>$arrayLineRec,'dataColumnGraph'=>$dataColumnGraph,'curIndicator'=>$CurrentIndicator,'listYear'=>$listYear,'listIndicatorAcc'=>$listIndicatorAcc,'dataAccomp'=>$dataAccomp,'dataTargets'=>$dataTargets]);
              }
      }
      
      public function actionDashboard()
      {
          $redirectPage ="";
          if(Yii::$app->user->identity->ismanagement &&  (Yii::$app->user->identity->type=='Top'))
          {
              $redirectPage ="_topdashboard";
          }
          
          if((Yii::$app->user->identity->ismanagement) &&  ((Yii::$app->user->identity->type)!='Top'))
            {
                if($this->checkRDI(Yii::$app->user->identity->type)==true)
                {
                   $redirectPage ="_rstltopdashboard";   
                }
                else
                {
                     $redirectPage ="_rditopdashboard";   
                }
                   
            }
          
      if (Yii::$app->request->isAjax)
              {
                return $this->renderAjax($redirectPage);
              }

              else
              {
                    return $this->render($redirectPage);
              }
          
      }
      
      

        function checkRDI($string) 
        {
            $arr = array("ITDI","FPRDI","MIRDC","FNRI","PNRI","PTRI");
            
            foreach($arr as $a) {
                if(strpos($a,$string) !== false) {
                    return false;
                } 
            }
            return true;
        }


      
      public function actionOverallaccomplishment()
      {
          
        $arrayYear =array();
       // $arrayYear = Yii::$app->db->createCommand('Call eulims_lab.spGetDashboardDetails('. 2 .','. 11 . ',' . 0 .',' . 0 .');')->queryAll();
         $arrayYear = Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('overallyear','',0,'');")->queryAll();
        $listYear=array();
        $listYearLine=array();
        
       array_push($listYearLine,'All');
        
       $now = new DateTime();
       $currentyear= $now->format('Y');
       $yearIndex =0;
       $index=0;
        $currentyear=2019;
       $yearmode='';
		
	foreach ($arrayYear as $colYear)
            {
                array_push($listYear,$colYear['iyear']);
                array_push($listYearLine,$colYear['iyear']);
                if($currentyear==$colYear['iyear'])
               {
                    $yearIndex=$index;
               }
                $index++;
        
            }
          
          
          $dataTables = new SqlDataProvider([
            'sql' => "Call eulims_lab.spRetrieveAccomplishmentData_Overall('overalldata',''," . $currentyear .  ",'Accomplishments');",
            'totalCount' => 10,
          'pagination' => [
                'pageSize' => 0
           ],
        ]);
          
       $dataColumnQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('overallcolumn','" . 'samples' ."'," . $currentyear . ",'Accomplishments');")->queryAll();
        
        $dataColumnOverall=array();
        $listlab =array();
        
        
         
        foreach ($dataColumnQuery  as $eachRow)
            {
              $recColumn=array();
              $recColumn['type']='column';
              $recColumn['name']=$eachRow['name'];
              $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $eachRow['data']));
              $recColumn['data']=$result;
              $recColumn['color']=$eachRow['color']; //'#7cb5ec' #f45b5b;//  
             array_push($dataColumnOverall,$recColumn);
           
            }; 
            
         $dataPieQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('overallrstlpie','". 'samples' ."'," . $currentyear . ",'Accomplishments');")->queryAll();
          
            $dataPieOverall=array();
            foreach ($dataPieQuery as $rows)
                 {
                     $arrayPieRec=array();
                 //    $arrayPieRec['name']= $rows['name'];
                     $arrayPieRec['name']= str_replace('DOST','R', $rows['name']);
                     $arrayPieRec['y']= (int)$rows['data'];
                     $arrayPieRec['sliced']= 'sliced';
                     $arrayPieRec['color']= $rows['color'];
                     array_push($dataPieOverall,$arrayPieRec);
                 }
                
           $listDost=array("RSTL","RDI");  
           $listCluster=array("North Luzon","South Luzon","Visayas","Mindanao","RDI"); 
           $listType=array("Accomplishments","Targets");  
           $listIndicator=array("Samples","Tests","Customers","New Customers","Firms","Fees","CSI");   
           
           
        $dataLineQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('clusterlinenorth','". 'samples' ."'," . 0 . ",'Accomplishments');")->queryAll();
        $dataLineArray = array();
        foreach ($dataLineQuery as $rows)
                 {
                     $arrayLineRec=array();
                 //    $arrayPieRec['name']= $rows['name'];
                     $arrayLineRec['name']=  $rows['name'];
                     $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['data']));
                     $arrayLineRec['data']=$result;
                     array_push($dataLineArray,$arrayLineRec);
                 }
          
      $labType = 'RSTL';
          
      if (Yii::$app->request->isAjax)
              {
                return $this->renderAjax('overallaccomplishment',['dataTables'=>$dataTables,'listYear'=>$listYear,'dataColumnOverall'=>$dataColumnOverall,'dataPieOverall'=>$dataPieOverall,'listDost'=>$listDost,'listType'=>$listType,'listIndicator'=>$listIndicator,'yearIndex'=>$yearIndex,'curType'=>'Accomplishments'
                    ,'curYear'=>$currentyear,'curIndicator'=>'samples','pTurn'=>'$pTurn','dataLineArray'=>$dataLineArray,'labType'=>$labType,'listCluster'=>$listCluster,'pCluster'=>'North Luzon','listYearLine'=>$listYearLine,'yearmode'=>$yearmode]);
              }

              else
              {
                    return $this->render('overallaccomplishment',['dataTables'=>$dataTables,'listYear'=>$listYear,'dataColumnOverall'=>$dataColumnOverall,'dataPieOverall'=>$dataPieOverall,'listDost'=>$listDost,'listType'=>$listType,'listIndicator'=>$listIndicator,'yearIndex'=>$yearIndex,'curType'=>'Accomplishments'
                        ,'curYear'=>$currentyear,'curIndicator'=>'samples','pTurn'=>'$pTurn','dataLineArray'=>$dataLineArray,'labType'=>$labType,'listCluster'=>$listCluster,'pCluster'=>'North Luzon','listYearLine'=>$listYearLine,'yearmode'=>$yearmode]);
              }
          
      }
      public function actionSubyearoverall()
      {
          $pYear = Yii::$app->request->get('paramYear');
          $pType ='Accomplishments';// Yii::$app->request->get('paramType');
          $pTurn = Yii::$app->request->get('paramTurn');
          
          $yearmode='';
          $boolExpand=false;
          $strExpand ='';
          $strPage = '_subyearoverall';
            if($pTurn=='on')
            {
                $boolExpand = true;
                $strExpand = 'expand';
                $strPage = '_subyearoverallexpand';
            }
                   
          $dataTables = new SqlDataProvider([
            'sql' => "Call eulims_lab.spRetrieveAccomplishmentData_Overall('overalldata',''," . $pYear .  ",'". $pType ."');",
            'totalCount' => 10,
          'pagination' => [
                'pageSize' => 0
           ],
        ]);
          
       $dataColumnQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('overallcolumn','" . 'samples' ."'," . $pYear . ",'". $pType ."');")->queryAll();
        
        $dataColumnOverall=array();
        $listlab =array();
        
        
         
        foreach ($dataColumnQuery  as $eachRow)
            {
              $recColumn=array();
              $recColumn['type']='column';
              $recColumn['name']=$eachRow['name'];
              $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $eachRow['data']));
              $recColumn['data']=$result;
              $recColumn['color']=$eachRow['color'];
             array_push($dataColumnOverall,$recColumn);
           
            }
            
         $dataPieQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('overallrstlpie" . $strExpand  . "','". 'samples' ."'," . $pYear . ",'" . $pType . "');")->queryAll();
          
            $dataPieOverall=array();
            foreach ($dataPieQuery as $rows)
                 {
                     $arrayPieRec=array();
                 //    $arrayPieRec['name']= $rows['name'];
                     $arrayPieRec['name']= str_replace('DOST','R', $rows['name']);
                     $arrayPieRec['y']= (int)$rows['data'];
                     $arrayPieRec['sliced']= 'sliced';
                     $arrayPieRec['color']= $rows['color'];
                     array_push($dataPieOverall,$arrayPieRec);
                 }
                
           $listDost=array("RSTL","RDI");   
           $listCluster=array("North Luzon","South Luzon","Visayas","Mindanao","RDI"); 
            $listIndicator=array("Samples","Tests","Customers","New Customers","Firms","Fees","CSI"); 
            
        $dataLineQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('clusterlinenorth','". 'samples' ."'," . 0 . ",'Accomplishments');")->queryAll();
        $dataLineArray = array();
        foreach ($dataLineQuery as $rows)
                 {
                     $arrayLineRec=array();
                 //    $arrayPieRec['name']= $rows['name'];
                     $arrayLineRec['name']=  $rows['name'];
                     $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['data']));
                     $arrayLineRec['data']=$result;
                     array_push($dataLineArray,$arrayLineRec);
                 }
          
      $labType = 'RSTL';
      
      $arrayYear = Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('overallyear','',0,'');")->queryAll();
      $listYearLine=array();
        
      array_push($listYearLine,'All');
      
      foreach ($arrayYear as $colYear)
            {
                array_push($listYearLine,$colYear['iyear']);
            }
           
          
      if (Yii::$app->request->isAjax)
              {
                return $this->renderAjax($strPage,['dataTables'=>$dataTables,'dataColumnOverall'=>$dataColumnOverall,'dataPieOverall'=>$dataPieOverall,'listDost'=>$listDost,'listIndicator'=>$listIndicator,'curType'=>$pType,'curYear'=>$pYear,'curIndicator'=>'samples','pTurn'=>$pTurn,'dataLineArray'=>$dataLineArray,'labType'=>$labType,'listCluster'=>$listCluster,'listYearLine'=>$listYearLine,'yearmode'=>$yearmode]);
              }

              else
              {
                    return $this->render($strPage,['dataTables'=>$dataTables,'dataColumnOverall'=>$dataColumnOverall,'dataPieOverall'=>$dataPieOverall,'listDost'=>$listDost,'listIndicator'=>$listIndicator,'curType'=>$pType,'curYear'=>$pYear,'curIndicator'=>'samples','pTurn'=>$pTurn,'dataLineArray'=>$dataLineArray,'labType'=>$labType,'listCluster'=>$listCluster,'listYearLine'=>$listYearLine,'yearmode'=>$yearmode]);
              }
          
      }
      
      public function actionSubcolumnpieoverall()
      {
          $pYear = Yii::$app->request->get('paramYear');
          $pType ='Accomplishments';//Yii::$app->request->get('paramType');
          $pInd = Yii::$app->request->get('paramIndicator');
          $pIndicator = Yii::$app->request->get('paramIndicator');  
          $pTurn = Yii::$app->request->get('paramTurn');
          
          
          $pIndicator = str_replace(' ', '', $pIndicator);
          $yearmode = '';
          
          $boolExpand=false;
          $strExpand ='';
            if($pTurn=='on')
            {
                $boolExpand = true;
                $strExpand = 'expand';
            }
      
      // $CurrentIndicator = Yii::$app->request->get('paramIndicator');
      
      
      $passIndicator =strtolower($pIndicator);
          
          
       $dataColumnQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('overallcolumn','" . $passIndicator ."'," . $pYear . ",'". $pType ."');")->queryAll();
        
        $dataColumnOverall=array();
        $listlab =array();
        
        
         
        foreach ($dataColumnQuery  as $eachRow)
            {
              $recColumn=array();
              $recColumn['type']='column';
              $recColumn['name']=$eachRow['name'];
              $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $eachRow['data']));
              $recColumn['data']=$result;
              $recColumn['color']=$eachRow['color'];
             array_push($dataColumnOverall,$recColumn);
           
            }
            
         $dataPieQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('overallrstlpie" . $strExpand . "','". $passIndicator ."'," . $pYear . ",'" . $pType . "');")->queryAll();
          
            $dataPieOverall=array();
            foreach ($dataPieQuery as $rows)
                 {
                     $arrayPieRec=array();
                 //    $arrayPieRec['name']= $rows['name'];
                     $arrayPieRec['name']= str_replace('DOST','R', $rows['name']);
                     $arrayPieRec['y']= (int)$rows['data'];
                     $arrayPieRec['sliced']= 'sliced';
                     $arrayPieRec['color']= $rows['color'];
                     array_push($dataPieOverall,$arrayPieRec);
                 }
                
           $listDost=array("RSTL","RDI");   
           $listCluster=array("North Luzon","South Luzon","Visayas","Mindanao","RDI"); 
           
            $dataLineQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('clusterlinenorth','". $passIndicator ."'," . 0 . ",'Accomplishments');")->queryAll();
        $dataLineArray = array();
        foreach ($dataLineQuery as $rows)
                 {
                     $arrayLineRec=array();
                 //    $arrayPieRec['name']= $rows['name'];
                     $arrayLineRec['name']=  $rows['name'];
                     $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['data']));
                     $arrayLineRec['data']=$result;
                     array_push($dataLineArray,$arrayLineRec);
                 }
          
      $labType = 'RSTL';
      
      $arrayYear = Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('overallyear','',0,'');")->queryAll();
      $listYearLine=array();
        
      array_push($listYearLine,'All');
      
      foreach ($arrayYear as $colYear)
            {
                array_push($listYearLine,$colYear['iyear']);
            }
           
          
      if (Yii::$app->request->isAjax)
              {
                return $this->renderAjax('_subcolumnpieoverall',['dataColumnOverall'=>$dataColumnOverall,'dataPieOverall'=>$dataPieOverall,'listDost'=>$listDost,'curType'=>$pType,'curYear'=>$pYear,'curIndicator'=>$pInd,'pTurn'=>$pTurn,'dataLineArray'=>$dataLineArray,'labType'=>$labType,'listCluster'=>$listCluster,'listYearLine'=>$listYearLine,'yearmode'=>$yearmode]);
              }

              else
              {
                return $this->render('_subcolumnpieoverall',['dataColumnOverall'=>$dataColumnOverall,'dataPieOverall'=>$dataPieOverall,'listDost'=>$listDost,'curType'=>$pType,'curYear'=>$pYear,'curIndicator'=>$pInd,'pTurn'=>$pTurn,'dataLineArray'=>$dataLineArray,'labType'=>$labType,'listCluster'=>$listCluster,'listYearLine'=>$listYearLine,'yearmode'=>$yearmode]);
              }
          
      }
      
      public function actionSubpieoverall()
      {
          $stringDost='';
          $stringDostLine = '';
          $pDost = Yii::$app->request->get('paramDost');
          $pYear = Yii::$app->request->get('paramYear');
          $pIndicator = Yii::$app->request->get('paramIndicator');
          $pType ='Accomplishments';// Yii::$app->request->get('paramType');
          
          if($pDost == 'RSTL')
          {
          $stringDost = 'overallrstlpie';
          $stringDostLine = 'overalllinerstl';
          $listCluster=array("South Luzon","North Luzon","Visayas","Mindanao"); 
          $listClusterRDI=array("RDI"); 
          }
          
           if($pDost == 'RDI')
          {
          $stringDost = 'overallrdipie';
          $stringDostLine='overalllinerdi';
          $listCluster=array("South Luzon","North Luzon","Visayas","Mindanao"); 
          $listClusterRDI=array("RDI"); 
          }
          
         // $dataPieQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData('" . $stringDost . "','". 'samples' ."'," . 2017 . ",'','');")->queryAll();
         $dataPieQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('" .$stringDost. "','". $pIndicator ."'," . $pYear . ",'" . $pType  . "');")->queryAll();
           
          
            $dataPieOverall=array();
            foreach ($dataPieQuery as $rows)
                 {
                     $arrayPieRec=array();
                     $arrayPieRec['name']= str_replace('DOST','R', $rows['name']);
                     $arrayPieRec['y']= (int)$rows['data'];
                     $arrayPieRec['sliced']= 'sliced';
                     $arrayPieRec['color']= $rows['color'];
                     array_push($dataPieOverall,$arrayPieRec);
                 }
                 
                 
    $dataLineQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('" . $stringDostLine. "','". $pIndicator ."'," . 0 . ",'Accomplishments');")->queryAll();
        $dataLineArray = array();
        foreach ($dataLineQuery as $rows)
                 {
                     $arrayLineRec=array();
                 //    $arrayPieRec['name']= $rows['name'];
                     $arrayLineRec['name']=  $rows['name'];
                     $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['data']));
                     $arrayLineRec['data']=$result;
                     array_push($dataLineArray,$arrayLineRec);
                 }
          
      $labType =  $pDost;
      
       
                 
           if (Yii::$app->request->isAjax)
              {
                return $this->renderAjax('_subpieoverall',['dataPieOverall'=>$dataPieOverall,'curType'=>$pType,'curYear'=>$pYear,'curIndicator'=>$pIndicator,'dataLineArray'=>$dataLineArray,'labType'=>$pDost,'listCluster'=>$listCluster]);
              }

              else
              {
                    return $this->render('_subpieoverall',['dataPieOverall'=>$dataPieOverall,'curType'=>$pType,'curYear'=>$pYear,'curIndicator'=>$pIndicator,'dataLineArray'=>$dataLineArray,'labType'=>$pDost,'listCluster'=>$listCluster]);
              }
          
      }
      
       public function actionClusterline()
      {
        $pCluster = Yii::$app->request->get('paramCluster');
        $pIndicator = Yii::$app->request->get('paramIndicator');
        $strClusterYear = Yii::$app->request->get('paramClusterYear'); 
        
        $strClusterMode='';
        $strYearMode='';
        $strSelectedYear =0;
        if($strClusterYear == 'All')
        {
            $strYearMode = '';
        }
        else
        {
            $strYearMode='year';
            $strSelectedYear = $strClusterYear;
        }
        
       // $pCluster= $pCluster . $strYearMode;
        
        $linecate = Array();
        
        $linecate = ['2016','2017','2018','2019'];
        $strCluster = 'RSTL';
        switch($pCluster)
        {
            case 'North Luzon':
                $strClusterMode='clusterlinenorth' . $strYearMode;
                break;
             case 'South Luzon':
                $strClusterMode='clusterlinesouth' . $strYearMode;
                break;
             case 'Visayas':
                $strClusterMode='clusterlinevis' . $strYearMode;
                break;
             case 'Mindanao':
                 $strClusterMode='clusterlinemin' . $strYearMode;
                break;
             case 'RDI':
                 $strClusterMode='clusterlinerdi' . $strYearMode;
                 $strCluster = 'RDI';
                break;
             
        }
        
        $dataLineQuery =  Yii::$app->db->createCommand("Call eulims_lab.spRetrieveAccomplishmentData_Overall('". $strClusterMode ."','". $pIndicator ."'," . $strSelectedYear . ",'Accomplishments');")->queryAll();
        $dataLineArray = array();
        foreach ($dataLineQuery as $rows)
                 {
                     $arrayLineRec=array();
                 //    $arrayPieRec['name']= $rows['name'];
                     $arrayLineRec['name']=  $rows['name'];
                      $arrayLineRec['color']=  $rows['color'];
                     $result = array_map(function($v){ return (int) trim($v, "'"); }, explode(",", $rows['data']));
                     $arrayLineRec['data']=$result;
                     array_push($dataLineArray,$arrayLineRec);
                 }
                 
             
                 
                 
          if (Yii::$app->request->isAjax)
              {
                return $this->renderAjax('_subclusterline',['dataLineArray'=>$dataLineArray,'curIndicator'=>$pIndicator,'pCluster'=>$pCluster,'yearmode'=>$strYearMode,'strCluster'=>$strCluster]);
              }

              else
              {
                    return $this->render('_subclusterline',['dataLineArray'=>$dataLineArray,'curIndicator'=>$pIndicator,'pCluster'=>$pCluster,'yearmode'=>$strYearMode,'strCluster'=>$strCluster]);
              } 
      }
      
      public function actionIndustry()
      {
          
           $listCluster=array("South Luzon","North Luzon","Visayas","Mindanao"); 
            $dataTreeArray = array();
            
            
                     $arrayRec=array();
                      $arrayRec['id']=  '';
                      $arrayRec['name']= '';
                      $arrayRec['color']='';
                     array_push($dataTreeArray,$arrayRec);
            
           
           
      if (Yii::$app->request->isAjax)
              {
                return $this->renderAjax('industry2');
              }

              else
              {
                    return $this->render('industry2');
              }
      }

      
}
