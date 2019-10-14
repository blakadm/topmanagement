<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_equipmentstatus".
 *
 * @property integer $EquipmentStatusID
 * @property string $EquipmentStatus
 * @property string $Description
 *
 * @property Equipment[] $equipments
 */
class Equipmentstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_equipmentstatus';
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
            [['EquipmentStatus', 'Description'], 'required'],
            [['EquipmentStatus', 'Description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EquipmentStatusID' => 'Equipment Status ID',
            'EquipmentStatus' => 'Equipment Status',
            'Description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::className(), ['EquipmentStatusID' => 'EquipmentStatusID']);
    }
}
