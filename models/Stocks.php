<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_stocks".
 *
 * @property integer $StockID
 * @property integer $RSTLID
 * @property integer $LabID
 * @property integer $OrigStockID
 * @property string $StockCode
 * @property integer $SupplyID
 * @property string $BrandName
 * @property integer $QuantityOnHand
 * @property integer $QuantityUsed
 * @property double $Amount
 * @property string $LatestDateConsumed
 *
 * @property Supplies $supply
 */
class Stocks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_stocks';
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
            [['RSTLID', 'OrigStockID', 'StockCode', 'SupplyID', 'BrandName', 'QuantityOnHand', 'LatestDateConsumed'], 'required'],
            [['RSTLID', 'LabID', 'OrigStockID', 'SupplyID', 'QuantityOnHand', 'QuantityUsed'], 'integer'],
            [['Amount'], 'number'],
            [['LatestDateConsumed'], 'safe'],
            [['StockCode'], 'string', 'max' => 50],
            [['BrandName'], 'string', 'max' => 255],
            [['RSTLID', 'OrigStockID'], 'unique', 'targetAttribute' => ['RSTLID', 'OrigStockID'], 'message' => 'The combination of Rstlid and Orig Stock ID has already been taken.'],
            [['SupplyID'], 'exist', 'skipOnError' => true, 'targetClass' => Supplies::className(), 'targetAttribute' => ['SupplyID' => 'SupplyID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'StockID' => 'Stock ID',
            'RSTLID' => 'Rstlid',
            'LabID' => 'Lab ID',
            'OrigStockID' => 'Orig Stock ID',
            'StockCode' => 'Stock Code',
            'SupplyID' => 'Supply ID',
            'BrandName' => 'Brand Name',
            'QuantityOnHand' => 'Quantity On Hand',
            'QuantityUsed' => 'Quantity Used',
            'Amount' => 'Amount',
            'LatestDateConsumed' => 'Latest Date Consumed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupply()
    {
        return $this->hasOne(Supplies::className(), ['SupplyID' => 'SupplyID']);
    }
}
