<?php

namespace app\controllers;

use Yii;
use app\models\States;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Lga;


class StatesController extends Controller
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
            'query' => States::find(),
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
        $model = new States();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->state_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionGet_lgas($id)
    {
        $countlgas = Lga::find()
            ->where(['state_id' => $id])
            ->count();
        $lgas = Lga::find()
            ->where(['state_id' => $id])
            ->all();
        if($countlgas>0){
            echo "<option>--Select LGA--</option>";
            foreach($lgas as $lga){
                echo "<option value='".$lga->lga_id."'>".$lga->lga_name."</option>";
            }
        }
        else{
            echo "<option>--Select LGA--</option>";
        }
    }
    public function actionGet_states()
    {
        $states = States::find()->all();
            echo "<option>--Select A State--</option>";
            foreach($states as $state){
                echo "<option value='".$state->state_id."'>".$state->state_name."</option>";
            }

    }
    protected function findModel($id)
    {
        if (($model = States::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
