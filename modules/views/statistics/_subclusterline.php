<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
/* 
 * Project Name: Top_Management * 
 * Copyright(C)2019 Department of Science & Technology -IX * 

 *  * Developer: Eng'r Nolan F. Sunico  * 
 * 02 11, 19 , 1:35:06 PM * 
 * Module: _target * 
 */
//echo $sampleDataTarget;

?>


<div id="divLineClusterOverall">
    
    <?php
    
    switch($pCluster)
        {
            case 'North Luzon':
                 if($yearmode == 'year')
                {
                    echo $this->render('_clusterline4year',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
                }
                else
                {
                    echo $this->render('_clusterline4',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
                }
                
                break;
            case 'South Luzon':
                if($yearmode == 'year')
                {
                     echo $this->render('_clusterline3year',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
                }
                else
                {
                    echo $this->render('_clusterline3',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
                }
                break;
            case 'Visayas':
                if($yearmode == 'year')
                {
                     echo $this->render('_clusterline3year',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
                }
                else
                {
                    echo $this->render('_clusterline3',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
                }
                break;
            case 'Mindanao':
                if($yearmode == 'year')
                {
                    echo $this->render('_clusterline6year',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
                }
                else
                {
                    echo $this->render('_clusterline6',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
                }
                 
                break;
            case 'RDI':
                if($yearmode == 'year')
                {
                    echo $this->render('_clusterline6year',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
                }
                else
                {
                     echo $this->render('_clusterline6',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
                }
               
                break;
            
            
          //  case 'South Luzon':
          //     echo $this->render('_clusterline3year',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
           //     break;
         //   case 'Visayasyear':
         //        echo $this->render('_clusterline3year',['dataLineArray'=>$dataLineArray,'curIndicator' => $curIndicator]);
         //       break;
        }
    ?>
                   
</div>