<?php

namespace app\controllers;

use Yii;
use app\models\PollingUnit;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AnnouncedPuResults;

/**
 * PollingUnitController implements the CRUD actions for PollingUnit model.
 */
class PollingUnitController extends Controller
{
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

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PollingUnit::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new PollingUnit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uniqueid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionGet_results($id)
    {
        $countresults = AnnouncedPuResults::find()
            ->where(['polling_unit_uniqueid' => $id])
            ->count();
        $results= AnnouncedPuResults::find()
            ->where(['polling_unit_uniqueid' => $id])
            ->all();
        if($countresults>0){
            foreach($results as $result){
                echo"<tr>
                        <th>".$result->party_abbreviation."</th>
                        <td>".$result->party_score."</td>
                     </tr>";
            }
        }
        else{
            echo "<tr><td>--No result for the selected polling unit--</tr></tr>";
        }
    }
    protected function findModel($id)
    {
        if (($model = PollingUnit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
