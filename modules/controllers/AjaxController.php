<?php

/*
 * Project Name: onelab.gov.ph * 
 * Copyright(C)2018 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 03 2, 18 , 9:47:16 AM * 
 * Module: AjaxController * 
 */

namespace app\modules\controllers;

use mdm\admin\models\User;
use app\components\StatisticsComponents;
use app\components\Functions;
use app\components\Yii2Excel;
/**
 * Description of AjaxController
 * ExcelSheet $Sheet
 * @author OneLab
 */
class AjaxController extends \yii\web\Controller{
    // Public Functions ********************************************************
    public function actionStatistics()
    {
        //header("Content-Disposition: attachment; filename=user.xlsx");
        //header("Content-Type: application/vnd.ms-excel");
        $POST= \Yii::$app->request->post();
        //var_dump($POST);
        //exit;
        $ExportType= strtolower($POST['type']);
        switch($ExportType){
            case "income":
                $this->ExportIncome($POST);
                break;
        }
    }
    
    public function actionTest(){
        \Yii::$app->response->format= \yii\web\Response::FORMAT_JSON;
        //$Yii2Excel=new Yii2Excel();
        //$Yii2Excel->CreateHeader("FEES Collected of RSTL", "Department of Science & Technology");
        //$Filename=$Yii2Excel->ExportToExcel();
        //return $Filename;
        $lab=new \app\models\Lab();
        $rows=$lab->find()->all();
        return $rows;
    }
    // *************************************************************************
    private function ExportIncome($POST){    
        //Create download folder if not exist
        if (!file_exists('download')) {
            mkdir('download', 0777, true);
        }
        /*
        echo "<pre>";
        var_dump($POST);
        echo "</pre>";
        exit;
        */
        $StatComp=new StatisticsComponents();
        $Filename=$StatComp->IncomeExportToExcel($POST['AgencyID'],$POST['fYear'], $POST['fYear2'],$POST['LabID'],$POST['FeeTypeID'],$POST['PaymentTypeID']);
        echo "/$Filename";
    }
}