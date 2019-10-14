<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_classification".
 *
 * @property integer $ClassificationID
 * @property string $Classification
 * @property string $Description
 *
 * @property Equipment[] $equipments
 */
class Classification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_classification';
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
            [['Classification', 'Description'], 'required'],
            [['Classification'], 'string', 'max' => 100],
            [['Description'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ClassificationID' => 'Classification ID',
            'Classification' => 'Classification',
            'Description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::className(), ['ClassificationID' => 'ClassificationID']);
    }
}
