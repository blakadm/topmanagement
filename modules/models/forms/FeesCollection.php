<?php

/*
 * Project Name: Top_Management * 
 * Copyright(C)2018 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 11 27, 18 , 10:42:29 AM * 
 * Module: Feescollected * 
 */
namespace app\modules\models\forms; 
use yii\base\Model;
/**
 * Description of Feescollected
 * @property integer $ReferralMode
 * @property integer $ChartTypeID
 * @property integer $FrequencyID
 * @property integer $Quarter
 * @property integer $RegionID
 * @property integer $StartYear
 * @property integer $EndYear
 * @property integer $LabID
 * @property integer $HighchartThemeID
 * @property string $ChartTitle
 * @property string $Theme
 * @property string $Frequency
 * @property string $ActiveTab
 * 
 * @property $Series
 * @property $LabData
 * @property $RSTLData
 * @author OneLab
 */
class FeesCollection extends Model{
    public $ReferralMode;
    public $ChartTypeID;
    public $ChartType;
    public $FrequencyID;
    public $Frequency;
    public $Quarter;
    public $ChartTitle;
    public $Series;
    public $RegionID;
    public $StartYear;
    public $EndYear;
    public $LabData;
    public $RSTLData;
    public $LabID;
    public $Theme;
    public $HighchartThemeID;     
    public $ActiveTab;
  
}
