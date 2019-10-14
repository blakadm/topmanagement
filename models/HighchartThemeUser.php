<?php

namespace app\models;

use Yii;
use mdm\admin\models\User;
/**
 * This is the model class for table "tbl_highchart_theme_user".
 *
 * @property integer $theme_user_id
 * @property integer $user_id
 * @property integer $highchart_theme_id
 *
 * @property User $user
 * @property HighchartThemes $highchartTheme
 */
class HighchartThemeUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_highchart_theme_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'highchart_theme_id'], 'required'],
            [['user_id', 'highchart_theme_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['highchart_theme_id'], 'exist', 'skipOnError' => true, 'targetClass' => HighchartThemes::className(), 'targetAttribute' => ['highchart_theme_id' => 'highchart_theme_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'theme_user_id' => 'Theme User ID',
            'user_id' => 'User ID',
            'highchart_theme_id' => 'Highchart Theme ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHighchartTheme()
    {
        return $this->hasOne(HighchartThemes::className(), ['highchart_theme_id' => 'highchart_theme_id']);
    }
}
