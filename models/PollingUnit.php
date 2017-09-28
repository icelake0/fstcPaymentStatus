<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "polling_unit".
 *
 * @property integer $uniqueid
 * @property integer $polling_unit_id
 * @property integer $lga_id
 * @property integer $uniquewardid
 * @property string $polling_unit_number
 * @property string $polling_unit_name
 * @property string $polling_unit_description
 * @property string $lat
 * @property string $long
 * @property string $entered_by_user
 * @property string $date_entered
 * @property string $user_ip_address
 */
class PollingUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'polling_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['polling_unit_id', 'lga_id', 'uniquewardid'], 'integer'],
            [['lga_id','date_entered',], 'required'],
            [['polling_unit_description', 'uniquewardid'], 'string'],
            [['polling_unit_number', 'polling_unit_name', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
            [['lat', 'long'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uniqueid' => 'Uniqueid',
            'polling_unit_id' => 'Polling Unit ID',
            'lga_id' => 'Lga ID',
            'uniquewardid' => 'Uniquewardid',
            'polling_unit_number' => 'Polling Unit Number',
            'polling_unit_name' => 'Polling Unit Name',
            'polling_unit_description' => 'Polling Unit Description',
            'lat' => 'Lat',
            'long' => 'Long',
            'entered_by_user' => 'Entered By User',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User Ip Address',
        ];
    }
}
