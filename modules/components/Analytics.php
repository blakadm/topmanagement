<?php

/*
 * Project Name: Top_Management * 
 * Copyright(C)2018 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 09 23, 18 , 6:33:08 PM * 
 * Module: Analytics * 
 */
namespace app\modules\components;
use Yii;
use miloschuman\highcharts\SeriesDataHelper;
/**
 * Description of Analytics
 *
 * @author OneLab
 */
class Analytics {
    public $region_rows;
    public function GetRegionRows(){
        $ProcLab="spGetRegions()";
        $conLab=Yii::$app->db;
        $Rows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,[],$conLab);
        $this->region_rows=[];
        foreach($Rows as $Row){
            array_push($this->region_rows, $Row['region']);
        }
        //return $LabRows;
        return $this->region_rows;
    }
    /**
     * 
     * @param String $Title
     * @param String $Category
     * @return array
     */
    public function Categories($Title,$Category){
        $Categories = ['title'=>['text'=>$Title],'categories' =>$Category];
        return $Categories;
    }
    public function ReferralSeriesCount($SeriesName,$StartYear,$EndYear, $Quarter,$LabID, $ReferralMode){
        $ProcLab="spGetSeriesReferralCountByRegion(:mStartYear,:mEndYear,:mQuarter,:mLabID, :mReferralMode)";
        $conLab=Yii::$app->referraldb;
        $Param=[
            'mStartYear'=>$StartYear,
            'mEndYear'=>$EndYear,
            'mQuarter'=>$Quarter,
            'mLabID'=>$LabID,
            'mReferralMode'=>$ReferralMode
        ];
        $rows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,$Param,$conLab);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $rows]);
        $Series=new SeriesDataHelper($dataProvider, ['total:int']);
        $_Arr = [
            [
                'name' => $SeriesName,
                'data' => $Series
            ]
        ];
        return $_Arr;
    }
    public function ReferralCustomerSeries($SeriesName,$StartYear,$EndYear, $Quarter,$LabID, $ReferralMode){
        $ProcLab="spGetSeriesReferralFeesByRegion(:mStartYear,:mEndYear,:mQuarter,:mLabID, :mReferralMode)";
        $conLab=Yii::$app->referraldb;
        $Param=[
            'mStartYear'=>$StartYear,
            'mEndYear'=>$EndYear,
            'mQuarter'=>$Quarter,
            'mLabID'=>$LabID,
            'mReferralMode'=>$ReferralMode
        ];
        $rows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,$Param,$conLab);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $rows]);
        $Series=new SeriesDataHelper($dataProvider, ['total:int']);
        $_Arr = [
            [
                'name' => $SeriesName,
                'data' => $Series
            ]
        ];
        return $_Arr;
    }
    public function ReferralSeries($SeriesName,$StartYear,$EndYear, $Quarter,$LabID, $ReferralMode){
        $ProcLab="spGetSeriesReferralFeesByRegion(:mStartYear,:mEndYear,:mQuarter,:mLabID, :mReferralMode)";
        $conLab=Yii::$app->referraldb;
        $Param=[
            'mStartYear'=>$StartYear,
            'mEndYear'=>$EndYear,
            'mQuarter'=>$Quarter,
            'mLabID'=>$LabID,
            'mReferralMode'=>$ReferralMode
        ];
        $rows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,$Param,$conLab);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $rows]);
        $Series=new SeriesDataHelper($dataProvider, ['total:int']);
        $_Arr = [
            [
                'name' => $SeriesName,
                'data' => $Series
            ]
        ];
        return $_Arr;
    }
    public function SampleSeries($SeriesName,$StartYear,$EndYear, $Quarter,$LabID){
        $ProcLab="spGetSeriesSamplesByRegion(:mStartYear,:mEndYear,:mQuarter,:mLabID)";
        $conLab=Yii::$app->labdb;
        $Param=[
            'mStartYear'=>$StartYear,
            'mEndYear'=>$EndYear,
            'mQuarter'=>$Quarter,
            'mLabID'=>$LabID
        ];
        $rows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,$Param,$conLab);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $rows]);
        $Series=new SeriesDataHelper($dataProvider, ['total:int']);
        $_Arr = [
            [
                'name' => $SeriesName,
                'data' => $Series
            ]
        ];
        return $_Arr;
    }
    public function Series($SeriesName,$StartYear,$EndYear, $Quarter,$LabID){
        $ProcLab="spGetSeriesTransactionByRegion(:mStartYear,:mEndYear,:mQuarter,:mLabID)";
        $conLab=Yii::$app->labdb;
        $Param=[
            'mStartYear'=>$StartYear,
            'mEndYear'=>$EndYear,
            'mQuarter'=>$Quarter,
            'mLabID'=>$LabID
        ];
        $rows=Yii::$app->Functions->ExecuteStoredProcedureRows($ProcLab,$Param,$conLab);
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $rows]);
        $Series=new SeriesDataHelper($dataProvider, ['total:int']);
        $_Arr = [
            [
                'name' => $SeriesName,
                'data' => $Series
            ]
        ];
        return $_Arr;
    }
}
