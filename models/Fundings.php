<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_fundings".
 *
 * @property integer $FundingID
 * @property string $FundingName
 * @property string $FundingCode
 *
 * @property Equipment[] $equipments
 */
class Fundings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_fundings';
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
            [['FundingName', 'FundingCode'], 'required'],
            [['FundingName'], 'string', 'max' => 200],
            [['FundingCode'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FundingID' => 'Funding ID',
            'FundingName' => 'Funding Name',
            'FundingCode' => 'Funding Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::className(), ['FundingID' => 'FundingID']);
    }
}
