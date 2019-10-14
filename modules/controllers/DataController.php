<?php

namespace app\modules\controllers;

class DataController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionReferral(){
        return $this->render('referral');
    }
    public function actionCustomers(){
        return $this->render('customers');
    }
    public function actionRquest(){
        return $this->render('request');
    }
    public function actionStatistics(){
        return $this->render('statistics');
    }
    public function actionEquipment(){
        return $this->render('equipment');
    }
    public function actionMembers(){
        return $this->render('members');
    }
}
