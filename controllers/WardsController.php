<?php

namespace app\controllers;

use Yii;
use app\models\Ward;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PollingUnit;

class WardsController extends Controller
{

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

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Ward::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Ward();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uniqueid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionGet_polling_units($id)
    {
        $countpus = PollingUnit::find()
            ->where(['uniquewardid' => $id])
            ->count();
        $pus = PollingUnit::find()
            ->where(['uniquewardid' => $id])
            ->all();
        if($countpus>0){
            echo "<option>--Select A polling unit--</option>";
            foreach($pus as $pu){
                echo "<option value='".$pu->uniqueid."'>".$pu->polling_unit_name."(".$pu->polling_unit_number.")</option>";
            }
        }
        else{
            echo "<option>No Polling Unit</option>";
        }
    }
    protected function findModel($id)
    {
        if (($model = Ward::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
