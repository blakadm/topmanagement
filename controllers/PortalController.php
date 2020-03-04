<?php

namespace app\controllers;

use app\models\Agency;
use kartik\mpdf\Pdf;
use cinghie\articles\models\ItemsGlobalSearch;
use Yii;

class PortalController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
     /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
       return $this->render('about');
    }
     /**
     * Displays about page.
     *
     * @return string
     */
    public function actionServices()
    {
        return $this->render('services');
    }
     /**
     * Displays about page.
     *
     * @return string
     */
    public function actionCustomer()
    {
        return $this->render('customer');
    }
     /**
     * Displays about page.
     *
     * @return string
     */
    public function actionReferral()
    {
        return $this->render('referral');
    }
     public function actionContact()
    {
        return $this->render('contact');
    }
     /**
     * Displays about page.
     *
     * @return string
     */
    public function actionMembers()
    {
        return $this->render('members');
    }
    public function actionNewmembers()
    {
        return $this->render('newmembers');
    }
    
    public function actionJoinus()
    {
        return $this->render('joinus');
    }
    public function actionNetwork()
    {
       
                   // var interthai = L.marker([13.783021, 100.549303]).bindPopup('Intertek Testing Services (Thailand) Ltd.'),
                    // sgsthai    = L.marker([13.705946, 100.543918]).bindPopup('SGS Thailand Limited'),
                    // interviet    = L.marker([10.804265, 106.667437]).bindPopup('Intertek Vietnam'),

        

        // $bicycleRental = [
        //     'type'=> 'FeatureCollection',
        //     'features'=> [
        //         [
        //             'geometry'=> [
        //                 'type'=> 'Point',
        //                 'coordinates'=> [
        //                     100.549303, 13.783021
        //                 ]
        //             ],
        //             'type'=> 'Feature',
        //             'properties'=> [
        //                 'popupContent'=> ' Thailand'
        //             ],
        //             'id'=>1
        //         ],
        //         [
        //             'geometry'=> [
        //                 'type'=> 'Point',
        //                 'coordinates'=> [
        //                    106.667437, 10.804265
        //                 ]
        //             ],
        //             'type'=> 'Feature',
        //             'properties'=> [
        //                 'popupContent'=> ' Vietnam'
        //             ],
        //             'id'=> 2
        //         ],
        //         [
        //             'geometry'=> [
        //                 'type'=> 'Point',
        //                 'coordinates'=> [
        //                     55.042288,24.865035
        //                 ]
        //             ],
        //             'type'=> 'Feature',
        //             'properties'=> [
        //                 'popupContent'=> '3'
        //             ],
        //             'id'=> 3
        //         ],
        //     ]
        // ];

        //                 var dost1 = L.marker([]).bindPopup('Department of Science and Technology - Region I'),
    //                 dost2 = L.marker([]).bindPopup('Department of Science and Technology - Region II'),
    //                 dost3 = L.marker([]).bindPopup('Department of Science and Technology - Region III'),
        // $geodost = [
        //     'type'=> 'FeatureCollection',
        //     'features'=> [
        //         [
        //             'geometry'=> [
        //                 'type'=> 'Point',
        //                 'coordinates'=> [
        //                     120.315835, 16.607972
        //                 ]
        //             ],
        //             'type'=> 'Feature',
        //             'properties'=> [
        //                 'popupContent'=> ' DOST I'
        //             ],
        //             'id'=>1
        //         ],
        //         [
        //             'geometry'=> [
        //                 'type'=> 'Point',
        //                 'coordinates'=> [
        //                     121.752502, 17.652242
        //                 ]
        //             ],
        //             'type'=> 'Feature',
        //             'properties'=> [
        //                 'popupContent'=> ' DOST II'
        //             ],
        //             'id'=> 2
        //         ],
        //         [
        //             'geometry'=> [
        //                 'type'=> 'Point',
        //                 'coordinates'=> [
        //                     120.657300, 15.066352
        //                 ]
        //             ],
        //             'type'=> 'Feature',
        //             'properties'=> [
        //                 'popupContent'=> 'DOST III'
        //             ],
        //             'id'=> 3
        //         ],
        //     ]
        // ];
        $agenciesDost = Agency::find()->where(['membertab'=>1])->orWhere(['membertab'=>4])->all(); 
        $agenciesInter = Agency::find()->where(['membertab'=>3])->all(); 
        $agenciesNonDost = Agency::find()->where(['membertab'=>2])->all(); 

        $geojsonDost = array( 'type' => 'FeatureCollection', 'features' => array());
        $geojsonInter = array( 'type' => 'FeatureCollection', 'features' => array());
        $geojsonNonDost = array( 'type' => 'FeatureCollection', 'features' => array());

        $initialInter=array();
        $initialDost=array();
        $initialNonDost=array();

        foreach ($agenciesDost as $recdost) 
        {

            $fullHtml = '<div class="div' . strtolower($recdost->code)  . '">
            <div class="row">
                        <div class="col-sm-4 col-xs-4">
                            <img src="/images/members/' . strtolower($recdost->code)  . '.png" class="img-responsive"/>'
                    .  '</div>'
                    .  '<div class="col-sm-18" style="color:#000;font-size:small">'
                        . '<ul>'
                            . '<li><a target="_blank"  href="' . $recdost->website . '">' . $recdost->website . '</a></li>'
                            . '<li>' . $recdost->address . '</li>'
                            . '<li>' . $recdost->contact . '</li>'
                         //   . '<li><input type="button  href="#" onclick="plotmap();">' . $Agency->geo_location  .'</a></li>'
                        //      . '<li><input id="btnMap" click="changeIcon()" data-value="13.783021,100.549303" type="button" value="View on Map">' . '</li>'
                        . '<ul>'
                     . '</div>'
                . '</div></div>';
        
        $splitarray =  explode(',', $recdost->geo_location);
        $initialDost = $splitarray;
        $geoarray = array(
            'type' => 'Feature',
            'properties' => array(
              'popupContent' => $fullHtml,
            //  'marker-color' => '#f00',
            //'marker-size' => 'small'
            ),
            'geometry' => array(
              'type' => 'Point',
              'coordinates' => array( 
                $splitarray[1],
                $splitarray[0]
              )
            )
          );
          array_push($geojsonDost['features'], $geoarray);
        }

        foreach ($agenciesInter as $recdost) 
        {
            $fullHtml = '<div class="div' . strtolower($recdost->code)  . '">
            <div class="row">
                        <div class="col-sm-4 col-xs-4">
                            <img src="/images/members/' . strtolower($recdost->code)  . '.png" class="img-responsive"/>'
                    .  '</div>'
                    .  '<div class="col-sm-18" style="color:#000;font-size:small">'
                        . '<ul>'
                            . '<li><a target="_blank"  href="' . $recdost->website . '">' . $recdost->website . '</a></li>'
                            . '<li>' . $recdost->address . '</li>'
                            . '<li>' . $recdost->contact . '</li>'
                         //   . '<li><input type="button  href="#" onclick="plotmap();">' . $Agency->geo_location  .'</a></li>'
                        //      . '<li><input id="btnMap" click="changeIcon()" data-value="13.783021,100.549303" type="button" value="View on Map">' . '</li>'
                        . '<ul>'
                     . '</div>'
                . '</div></div>';
        $splitarray =  explode(',', $recdost->geo_location);
        $initialInter = $splitarray;
        $geoarray = array(
            'type' => 'Feature',
            'properties' => array(
              'popupContent' => $fullHtml ,
            //  'marker-color' => '#f00',
            //'marker-size' => 'small'
            ),
            'geometry' => array(
              'type' => 'Point',
              'coordinates' => array( 
                $splitarray[1],
                $splitarray[0]
              )
            )
          );
          array_push($geojsonInter['features'], $geoarray);
        }

        foreach ($agenciesNonDost as $recdost) 
        {

        $fullHtml = '<div class="div' . strtolower($recdost->code)  . '">
            <div class="row">
                        <div class="col-sm-4 col-xs-4">
                            <img src="/images/members/' . strtolower($recdost->code)  . '.png" class="img-responsive"/>'
                    .  '</div>'
                    .  '<div class="col-sm-18" style="color:#000;font-size:small">'
                        . '<ul>'
                            . '<li><a target="_blank"  href="' . $recdost->website . '">' . $recdost->website . '</a></li>'
                            . '<li>' . $recdost->address . '</li>'
                            . '<li>' . $recdost->contact . '</li>'
                         //   . '<li><input type="button  href="#" onclick="plotmap();">' . $Agency->geo_location  .'</a></li>'
                        //      . '<li><input id="btnMap" click="changeIcon()" data-value="13.783021,100.549303" type="button" value="View on Map">' . '</li>'
                        . '<ul>'
                     . '</div>'
                . '</div></div>';
        
        //echo $fullHtml;
        $splitarray =  explode(',', $recdost->geo_location);
        $initialNonDost = $splitarray;
        $geoarray = array(
            'type' => 'Feature',
            'properties' => array(
              'popupContent' => $fullHtml,
            //  'marker-color' => '#f00',
            //'marker-size' => 'small'
            ),
            'geometry' => array(
              'type' => 'Point',
              'coordinates' => array( 
                $splitarray[1],
                $splitarray[0]
              )
            )
          );
          array_push($geojsonNonDost['features'], $geoarray);
        }

  


        return $this->render('network',['geojsonDost'=>$geojsonDost,'geojsonInter'=>$geojsonInter,'geojsonNonDost'=>$geojsonNonDost,
        'initialDost'=>$initialDost,'initialNonDost'=>$initialNonDost,'initialInter'=>$initialInter]);
    }
     /**
     * Displays about page.
     *
     * @return string
     */
    public function actionPayment()
    {
        return $this->render('epayment');
    }
     /**
     * Displays about page.
     *
     * @return string
     */
    public function actionSupport()
    {
        return $this->render('support');
    }
     /**
     * Displays about page.
     *
     * @return string
     */
    public function actionNewsfeed()
    {
        //$searchModel= Items::find()->orderBy(['created'=>SORT_DESC])->all();
        $searchModel = new ItemsGlobalSearch();
        $searchModel->state=1;
        if(Yii::$app->request->queryParams==''){
            $Param="";
        }else{
            $Param=Yii::$app->request->queryParams;
        }
        $dataProvider = $searchModel->search($Param);
        return $this->render('newsfeed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
    }
    
     public function actionNewscontent()
     {
         
        $pTitle = Yii::$app->request->get('articletitle');
         
        $art = \app\models\ArticleItems::find()->where(['title'=>$pTitle])->one(); 
        
         if (Yii::$app->request->isAjax)
              {
                return $this->renderAjax('_newscontent',['articles'=>$art]);
              }

              else
              {
                    return $this->render('_newscontent',['articles'=>$art]);
              }
        
     }

     public function actionInstructions(){
      return $this->render('instructions');
  }
}
