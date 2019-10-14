<?php

/*
 * Project Name: onelab.gov.ph * 
 * Copyright(C)2018 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 02 23, 18 , 9:59:11 AM * 
 * Module: ChartComponents * 
 */

namespace app\components;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\Agency;
use app\models\HighchartThemeUser;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use app\components\Functions;
use app\components\Yii2Excel;
use app\models\Sampletype;
/**
 * Description of ChartComponents
 *
 * @author OneLab
 */
class StatisticsComponents {
    private $Quarters=[];
    private $ChartTitle="";
    private $RSTLRows;
    private $LabRows;
    public function SetFrequency($InitTitle, $FrequencyID, $Year, $Year2){
        switch ($FrequencyID) {
            case 0:
                $this->Quarters=['Jan','Feb','Mar','Apr','May','June','Jul','Aug','Sep','Oct','Nov','Dec'];
                $this->ChartTitle=$InitTitle."(".$Year.")";
                break;
            case 1:
                $this->Quarters=['Jan','Feb','Mar'];
                $this->ChartTitle=$InitTitle."(First Quarter ".$Year.")";
                break;
            case 2:
                $this->Quarters=['Apr','May','June'];
                $this->ChartTitle=$InitTitle."(Second Quarter ".$Year.")";
                break;
            case 3:
                $this->Quarters=['Jul','Aug','Sep'];
                $this->ChartTitle=$InitTitle."(Third Quarter ".$Year.")";
                break;
            case 4:
                $this->Quarters=['Oct','Nov','Dec'];
                $this->ChartTitle=$InitTitle."(Fourth Quarter ".$Year.")";
                break;
            case 5:
                for($i=$Year;$i<=$Year2;$i++){
                    array_push($this->Quarters, $i);
                }
                $this->ChartTitle=$InitTitle."(".$Year."-".$Year2.")";
                break;
        }
    }
    public function GetQuarters(){
        return $this->Quarters;
    }
    public function GetChartTitle(){
        return $this->ChartTitle;
    }
    public function GetReferralAgencies(){
        $ProcRSTL="spGenerateRSTLForReferral()";
        $con=Yii::$app->db;
        $Params=[];
        $this->RSTLRows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcRSTL,$Params,$con);
        $RSTLData=ArrayHelper::map($this->RSTLRows,'id','name');
        return $RSTLData;
    }
    public function GetRSTLData($RegionID){
        $ProcRSTL="spGenerateRSTL(:RegionID)";
        $con=Yii::$app->db;
        $Params=['RegionID'=>$RegionID];
        $this->RSTLRows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcRSTL,$Params,$con);
        $RSTLData=ArrayHelper::map($this->RSTLRows,'id','name');
        return $RSTLData;
    }
    public function GetRSTLRows(){
        return $this->RSTLRows;
    }
    public function GetLabRows($rstl_id){
        $ProcLab="spGenerateLaboratoriesList(:rstl_id)";
        $conLab=Yii::$app->topdb;
        $LabParams=['rstl_id'=>$rstl_id];
        $LabRows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,$LabParams,$conLab);
        //$LabData=ArrayHelper::map($this->LabRows,'LabID','LabName');
        //return $LabRows;
        return $LabRows;
    }
    public function GetRegionRows(){
        $ProcLab="spGetRegions()";
        $conLab=Yii::$app->db;
        $RegionRows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,[],$conLab);
        return $RegionRows;
    }
    public function GetRegionArray(){
        $ProcLab="spGetRegions()";
        $conLab=Yii::$app->db;
        $Rows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,[],$conLab);
        $RegionRows=[];
        foreach($Rows as $Row){
            array_push($RegionRows, $Row['region']);
        }
        //return $LabRows;
        return $RegionRows;
    }
    /**
     * 
     * @param integer $LabID
     * @return model
     */
    public function GetLabs($LabID=0){
        $ProcLab="spGenerateLaboratories(:LabID)";
        $conLab=Yii::$app->topdb;
        $LabParams=['LabID'=>$LabID];
        $this->LabRows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,$LabParams,$conLab);
        $LabData=ArrayHelper::map($this->LabRows,'LabID','LabName');
        return $LabData;
    }
    public function GetFundings($FundingID){
        $ProcLab="spGenerateFundings(:mFundingID)";
        $conLab=Yii::$app->topdb;
        $LabParams=['mFundingID'=>$FundingID];
        $FundingRows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,$LabParams,$conLab);
        $LabData=ArrayHelper::map($FundingRows,'FundingID','FundingName');
        return $LabData;
    }
    /**
     * 
     * @param integer $Activated
     * @return model
     */
    public function GetAgencies($Activated=1){
        $Agencies=Agency::findAll(["activated"=>$Activated]);
        return $Agencies;
    }
    public function GetSampleType(){
        $ProcLab="spGetSampleType()";
        $conLab=Yii::$app->topdb;
        $this->LabRows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,[],$conLab);
        $SampletypeData=ArrayHelper::map($this->LabRows,'SampleTypeID','SampleType');
        return $SampletypeData;
    }
    public function SetHighchartTheme($highchart_theme_id=0){
        $HighchartThemeUser=HighchartThemeUser::find()->where(['user_id'=>Yii::$app->user->id])->one();
        if ($HighchartThemeUser) {
            //Update
            if($highchart_theme_id!=0){
               $HighchartThemeUser->highchart_theme_id = $highchart_theme_id;
            }
            $HighchartThemeUser->save();
        } else {//New
            $HighchartThemeUser = new HighchartThemeUser();
            $HighchartThemeUser->user_id = Yii::$app->user->id;
            $HighchartThemeUser->highchart_theme_id = $highchart_theme_id;
            $HighchartThemeUser->save();
        }
        return $HighchartThemeUser->highchartTheme->theme;
    }
    public function IncomeExportToExcel($RSTLID,$StartYear, $EndYear,$LabID,$FeeTypeID,$PaymentTypeID){
        $Params=[
            'mRSTLID'=>(int)$RSTLID,
            'mStartYear'=>(int)$StartYear,
            'mEndYear'=>(int)$EndYear,
            'mLabID'=>(int)$LabID,
            'mPaymentTypeID'=>(int)$PaymentTypeID,
            'mFeeTypeID'=>(int)$FeeTypeID
        ]; 
         
        /*$Params=[
            'mRSTLID'=>0,
            'mStartYear'=>2013,
            'mEndYear'=>2018,
            'mLabID'=>0,
            'mPaymentTypeID'=>1,
            'mFeeTypeID'=>1
        ]; 
         * 
         */
        $Diff=($EndYear-$StartYear)+1;
        $Proc="spGetSeriesAmountForExcelRSTLYear(:mRSTLID,:mStartYear,:mEndYear,:mLabID,:mPaymentTypeID,:mFeeTypeID)";
        $Yii2Excel=new Yii2Excel($Diff);
        $Yii2Excel->CreateHeader("FEES Collected of RSTL", "Department of Science & Technology");
        $Yii2Excel->GenerateDetails($Proc,$Params, \Yii::$app->topdb);
        $Filename=$Yii2Excel->ExportToExcel();
        return $Filename;
    }
}
