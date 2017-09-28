<?php

namespace app\controllers;

use Yii;
use app\models\AnnouncedPuResults;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AnnouncedPuForm;
use app\models\AddResultForm;
use app\models\States;
use app\models\Lga;
use app\models\Ward;


class AnnouncedPuResultsController extends Controller
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

    public function actionView()
    {
        $model=new AnnouncedPuForm();
        return $this->render('view',['model'=>$model]);
    }

    public function actionAdd_result()
    {
        $model = new AddResultForm();
        if ($model->load(Yii::$app->request->post())) {
            $lga_id=Yii::$app->request->post('lga_id');
            $uniquewardid=Yii::$app->request->post('uniquewardid');
            $polling_unit_name=Yii::$app->request->post('polling_unit_name');
            $polling_unit_description=yii::$app->request->post('polling_unit_description');
            $entered_by_user=Yii::$app->request->post('entered_by_user');
            $date_entered=date('y-m-d');
            $user_ip_address=Yii::$app->request->userIP;
            $user_location=$this->ActionGet_location($user_ip_address);
            $lat = (is_object($user_location))?$user_location->latitude:0;
            $long = (is_object($user_location))?$user_location->longitude:0;
            $polling_unit_is_created=Yii::$app->db->createCommand()->insert('polling_unit', [
                'lga_id' =>$lga_id,
                'uniquewardid' =>$uniquewardid,
                'polling_unit_name' =>$polling_unit_name,
                'polling_unit_description' => $polling_unit_description,
                'lat' => $lat,
                'long' => $long,
                'entered_by_user' =>$entered_by_user,
                'date_entered' =>$date_entered,
                'user_ip_address' =>$user_ip_address,
            ])->execute();
            if($polling_unit_is_created){
                $polling_unit_uniqueid=Yii::$app->db->getLastInsertId();
                $results=[
                    'PDP'=>new AnnouncedPuResults(),
                    'DPP'=>new AnnouncedPuResults(),
                    'ACN'=>new AnnouncedPuResults(),
                    'PPA'=>new AnnouncedPuResults(),
                    'CDC'=>new AnnouncedPuResults(),
                    'JP'=>new AnnouncedPuResults(),
                    'ANPP'=>new AnnouncedPuResults(),
                    'LABO'=>new AnnouncedPuResults(),
                    'CPP'=>new AnnouncedPuResults(),
                ];
                $results['PDP']->party_score=Yii::$app->request->post('PDP');
                $results['DPP']->party_score=Yii::$app->request->post('DPP');
                $results['ACN']->party_score=Yii::$app->request->post('ACN');
                $results['PPA']->party_score=Yii::$app->request->post('PPA');
                $results['CDC']->party_score=Yii::$app->request->post('CDC');
                $results['JP']->party_score=Yii::$app->request->post('JP');
                $results['ANPP']->party_score=Yii::$app->request->post('ANPP');
                $results['LABO']->party_score=Yii::$app->request->post('LABO');
                $results['CPP']->party_score=Yii::$app->request->post('CPP');
                foreach ($results as $key=>$result){
                    $result->party_abbreviation=$key;
                    $result->polling_unit_uniqueid=$polling_unit_uniqueid;
                    $result->entered_by_user=$entered_by_user;
                    $result->date_entered=$date_entered;
                    $result->date_entered=$date_entered;
                    $result->user_ip_address=$user_ip_address;
                    $result->save();
                }
                $state_name=States::find()->where(['state_id' => Yii::$app->request->post('state_id')])->one()['state_name'];
                $lga_name=Lga::find()->where(['lga_id' => $lga_id])->one()['lga_name'];
                $ward_name=Ward::find()->where(['uniqueid' => $uniquewardid])->one()['ward_name'];
                return $this->render('success',[
                    'results'=>$results,'lga_name'=>$lga_name,
                    'ward_name'=>$ward_name,'polling_unit_name'=>$polling_unit_name,
                    'state_name'=>$state_name]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function ActionGet_location($ip_address){
        $ip  = $ip_address;
        $url = "http://freegeoip.net/json/".$ip;
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $data = curl_exec($ch);
        curl_close($ch);
        if ($data) {
            $location = json_decode($data);
            return $location;
        }
    }

    protected function findModel($id)
    {
        if (($model = AnnouncedPuResults::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
