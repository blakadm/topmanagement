<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_paymenttype".
 *
 * @property integer $PaymentTypeID
 * @property string $PaymentType
 *
 * @property Request[] $tblRequests
 */
class Paymenttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_paymenttype';
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
            [['PaymentType'], 'required'],
            [['PaymentType'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PaymentTypeID' => 'Payment Type ID',
            'PaymentType' => 'Payment Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['PaymentTypeID' => 'PaymentTypeID']);
    }
}
