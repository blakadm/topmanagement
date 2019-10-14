<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_purpose".
 *
 * @property integer $PurposeID
 * @property string $Purpose
 * @property integer $Status
 *
 * @property Request[] $requests
 */
class Purpose extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_purpose';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('topdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Purpose', 'Status'], 'required'],
            [['Status'], 'integer'],
            [['Purpose'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PurposeID' => 'Purpose ID',
            'Purpose' => 'Purpose',
            'Status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['PurposeID' => 'PurposeID']);
    }
}
