<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_supplies".
 *
 * @property integer $SupplyID
 * @property string $SupplyName
 * @property integer $LabID
 * @property string $Description
 *
 * @property Stocks[] $stocks
 */
class Supplies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_supplies';
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
            [['SupplyName', 'LabID', 'Description'], 'required'],
            [['LabID'], 'integer'],
            [['SupplyName', 'Description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SupplyID' => 'Supply ID',
            'SupplyName' => 'Supply Name',
            'LabID' => 'Lab ID',
            'Description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stocks::className(), ['SupplyID' => 'SupplyID']);
    }
}
