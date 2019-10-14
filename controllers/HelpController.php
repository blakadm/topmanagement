<?php

namespace app\controllers;

use Yii;
use app\models\Documentation;
use app\models\DocumentationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * HelpController implements the CRUD actions for Documentation model.
 */
class HelpController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Documentation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documentation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionShow($id)
    {
        return $this->render('show', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new Documentation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Documentation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->DocumentationID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Documentation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->DocumentationID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Documentation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionSearch(){
        $Post=Yii::$app->request->post();
        if($Post){
             $SearchParam=$Post['SearchTopic'];
             $SQL = "SELECT * FROM `tbl_documentation` WHERE `Title` LIKE CONCAT('%','".$SearchParam."','%') OR ";
             $SQL.="`DocumentContent` LIKE CONCAT('%','".$SearchParam."','%');";
             $model = Documentation::findBySql($SQL)->all();
        }else{
           $model= Documentation::findAll(['DocumentationID'=>-1]);
        }
        return $this->render('searchdocs', [
                'model' => $model,
        ]);
    }
    public function actionPostimage(){
        /*******************************************************
        * Only these origins will be allowed to upload images *
        ******************************************************/
        $accepted_origins = array("https://web.onelab.ph/");
        //$accepted_origins = array("http://onelab.gov.ph.local", "http://127.0.0.1", "https://web.onelab.ph/");
        /*         * *******************************************
         * Change this line to set the upload folder *
         * ******************************************* */
        $imageFolder = "/images/newsfeed/";
        reset($_FILES);
        $temp = current($_FILES);
        //echo json_encode(array('location' => $temp['tmp_name']));
        //exit;
        if (is_uploaded_file($temp['tmp_name'])) {
            
            /*if (isset($_SERVER['HTTP_ORIGIN'])) {
                // same-origin requests won't set an origin. If the origin is set, it must be valid.
                if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                } else {
                    header("HTTP/1.0 403 Origin Denied");
                    return;
                }
            }
             * 
             */
            
            /*
              If your script needs to receive cookies, set images_upload_credentials : true in
              the configuration and enable the following two headers.
             */
            // header('Access-Control-Allow-Credentials: true');
            // header('P3P: CP="There is no P3P policy."');
            // Sanitize input
           /* if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.0 500 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.0 500 Invalid extension.");
                return;
            }
            * 
            */
            //echo json_encode(array('location' => realpath(Yii::getAlias('@web'))));
            //exit;
            // Accept upload if there was no origin, or if it is an accepted origin
            $filetoaccess = $imageFolder . $temp['name'];
            $filetowrite = realpath(Yii::getAlias('@web')).'/images/newsfeed/'. $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);
            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
            echo json_encode(array('location' => $filetoaccess));
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.0 500 Server Error");
        }
    }

    /**
     * actionManual
     * @return mixed 
     */
    public function actionManual(){
        return $this->render('manual');
    }
    /**
     * actionAccess
     * @return mixed 
     */
    public function actionAccess(){
        return $this->render('access');
    }
    /**
     * Finds the Documentation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documentation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documentation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
