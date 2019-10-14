<?php

namespace app\modules\controllers;

use yii\web\Controller;

/**
 * Default controller for the `toplevel` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {        
       // $redirectPage="";
        
        if(\Yii::$app->user->identity->ismanagement==false)
        //return $this->render('index'); //toplevel/data/statistics
      //  return $this->redirect('/toplevel/data/statistics');
             return $this->redirect('/toplevel/statistics/accomplishmentperrstl');
        else
            return $this->redirect('/toplevel/statistics/dashboard');
        
        
        
        
    }
}
