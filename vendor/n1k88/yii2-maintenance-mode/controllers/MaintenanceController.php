<?php
/**
 * @author n1k88 (Nico Schefu�) <redirectn1k@gmail.com>
 * @link https://github.com/n1k88/yii2-maintenance-mode
 * @version 1.1.2
 */
namespace n1k88\maintenance\controllers;

class MaintenanceController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }
}
