<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_logintrail".
 *
 * @property integer $id
 * @property string $username
 * @property string $date
 */
class Logintrail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_logintrail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['username'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'date' => 'Date',
        ];
    }
}
