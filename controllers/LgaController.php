<?php

namespace app\controllers;

use Yii;
use app\models\Lga;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Ward;
use app\models\AnnouncedPuForm;
use app\models\PollingUnit;
use app\models\AnnouncedPuResults;


class LgaController extends Controller
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
            'query' => Lga::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView()
    {
        $model=new AnnouncedPuForm();
        return $this->render('view',['model'=>$model]);
    }


    public function actionGet_wards($id)
    {
        $countwards = Ward::find()
            ->where(['lga_id' => $id])
            ->count();
        $wards = Ward::find()
            ->where(['lga_id' => $id])
            ->all();
        if($countwards>0){
            echo "<option>--Select A Ward--</option>";
            foreach($wards as $ward){
                echo "<option value='".$ward->uniqueid."'>".$ward->ward_name."</option>";
            }
        }
        else{
            echo "<option>--Select A Ward-</option>";
        }
    }
    public function actionGet_total_result_from_pu($id)
    {
        $countpus = PollingUnit::find()
            ->where(['lga_id' => $id])
            ->count();
        $pus = PollingUnit::find()
            ->where(['lga_id' => $id])
            ->all();
        if($countpus>0){
            $PDP=0;$DPP=0;$ACN=0;$PPA=0;$CDC=0;$JP=0;$ANPP=0;$LABO=0;$CPP=0;
            foreach($pus as $pu){
                $countresults = AnnouncedPuResults::find()
                    ->where(['polling_unit_uniqueid' => $pu->uniqueid])
                    ->count();
                $results= AnnouncedPuResults::find()
                    ->where(['polling_unit_uniqueid' => $pu->uniqueid])
                    ->all();
                if($countresults>0){
                    foreach($results as $result){
                        switch($result->party_abbreviation){
                            case "PDP" : $PDP+=(int)$result->party_score; break;
                            case "DPP" : $DPP+=(int)$result->party_score; break;
                            case "ACN" : $ACN+=(int)$result->party_score; break;
                            case "PPA" : $PPA+=(int)$result->party_score; break;
                            case "CDC" : $CDC+=(int)$result->party_score; break;
                            case "JP" : $JP+=(int)$result->party_score; break;
                            case "ANPP" : $ANPP+=(int)$result->party_score; break;
                            case "LABO" : $LABO+=(int)$result->party_score; break;
                            case "CPP" : $CPP+=(int)$result->party_score; break;
                        }
                    }
                }
                ///give back the result after the loop

            }
                echo"<tr>
                            <th>PDP</th>
                            <td>".$PDP."</td>
                      </tr>
                      <tr>
                            <th>DPP</th>
                            <td>".$DPP."</td>
                      </tr>
                      <tr>
                            <th>ACN</th>
                            <td>".$ACN."</td>
                      </tr>
                      <tr>
                            <th>PPA</th>
                            <td>".$PPA."</td>
                      </tr>
                      <tr>
                            <th>CDC</th>
                            <td>".$CDC."</td>
                      </tr>
                      <tr>
                            <th>JP</th>
                            <td>".$JP."</td>
                      </tr>
                      <tr>
                            <th>ANPP</th>
                            <td>".$ANPP."</td>
                      </tr>
                      <tr>
                            <th>LABO</th>
                            <td>".$LABO."</td>
                      </tr>
                      <tr>
                            <th>CPP</th>
                            <td>".$CPP."</td>
                      </tr>";
        }
        else{
            //change this to table form
            echo "<tr><td>--This LGA have no polling unit--</tr></tr>";
        }
    }
    protected function findModel($id)
    {
        if (($model = Lga::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
