<?php

namespace app\controllers;
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
}
