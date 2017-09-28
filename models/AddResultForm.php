<?php
namespace app\models;

use yii\base\Model;
/**
 * Signup form
 */
class AddResultForm extends Model
{
    public $entered_by_user;
    public $state_id;
    public $lga_id;
    public $uniquewardid;
    public $polling_unit_name;
    public $polling_unit_description;
    public $PDP;
    public $DPP;
    public $ACN;
    public $PPA;
    public $CDC;
    public $JP;
    public $ANPP;
    public $LABO;
    public $CPP;

    public function rules()
    {
        return [
            [['entered_by_user','state_id','lga_id','uniquewardid','polling_unit_name',
            'PDP','DPP', 'ACN', 'PPA', 'CDC', 'JP', 'ANPP', 'LABO', 'CPP',
            ], 'required'],
            ['entered_by_user', 'string', 'min' => 8, 'max' => 32],
            [['PDP','DPP', 'ACN', 'PPA', 'CDC', 'JP', 'ANPP', 'LABO', 'CPP',], 'integer', 'max' => 99999999],
        ];
    }
    public function attributeLabels()
    {
        return [
            'entered_by_user'=>'Username',
            'state_id'=>'State',
            'lga_id'=>'LGA',
            'uniquewardid'=>'Ward',
            'polling_unit_name'=>'Polling Unit Name',
            'polling_unit_description'=>'Polling Unit Description',
            'PDP'=>'PDP Score',
            'DPP'=>'DPP Score',
            'ACN'=>'ACN Score',
            'PPA'=>'PPA Score',
            'CDC'=>'CDC Score',
            'JP'=>'JP Score',
            'ANPP'=>'ANPP Score',
            'LABO'=>'LABO Score',
            'CPP'=>'CPP Score',
        ];
    }
    public function save_result()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
