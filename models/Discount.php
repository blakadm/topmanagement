<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_discount".
 *
 * @property integer $DiscountID
 * @property string $DiscountType
 * @property double $Rate
 * @property integer $Status
 *
 * @property Request[] $requests
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_discount';
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
            [['DiscountType', 'Rate'], 'required'],
            [['Rate'], 'number'],
            [['Status'], 'integer'],
            [['DiscountType'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DiscountID' => 'Discount ID',
            'DiscountType' => 'Discount Type',
            'Rate' => 'Rate',
            'Status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['DiscountID' => 'DiscountID']);
    }
}
