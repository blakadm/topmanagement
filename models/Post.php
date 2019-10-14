<?php

namespace app\models;

use Yii;
use mdm\admin\models\User;

/**
 * This is the model class for table "tbl_post".
 *
 * @property integer $PostID
 * @property string $PostTitle
 * @property string $DateCreated
 * @property string $PostContent
 * @property integer $UserID
 *
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PostTitle', 'DateCreated', 'PostContent', 'UserID'], 'required'],
            [['DateCreated'], 'safe'],
            [['PostContent'], 'string'],
            [['UserID'], 'integer'],
            [['PostTitle'], 'string', 'max' => 100],
            [['UserID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['UserID' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PostID' => 'Post ID',
            'PostTitle' => 'Title',
            'DateCreated' => 'Date Created',
            'PostContent' => 'Content',
            'UserID' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'UserID']);
    }
}
