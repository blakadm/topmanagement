<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "tbl_announcementtype".
 *
 * @property integer $AnnouncementTypeID
 * @property string $AnnouncementType
 * @property string $CSSClass
 *
 * @property \app\models\Announcement[] $tblAnnouncements
 */
class AnnouncementType extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deleted_by' => \Yii::$app->user->id,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
        $this->_rt_softrestore = [
            'deleted_by' => 0,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'tblAnnouncements'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AnnouncementType'], 'string', 'max' => 30],
            [['CSSClass'], 'string', 'max' => 50],
            [['AnnouncementType'], 'unique'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_announcementtype';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AnnouncementTypeID' => Yii::t('app', 'AnnouncementType'),
            'AnnouncementType' => Yii::t('app', 'AnnouncementType'),
            'CSSClass' => Yii::t('app', 'Cssclass'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblAnnouncements()
    {
        return $this->hasMany(\app\models\Announcement::className(), ['AnnouncementTypeID' => 'AnnouncementTypeID']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'AnnouncementTypeID',
            ],
        ];
    }

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->where(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->where('age>30')->all();
     * ```
     */

    /**
     * @inheritdoc
     * @return \app\models\AnnouncementTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\AnnouncementTypeQuery(get_called_class());
        return $query->where(['deleted_by' => 0]);
    }
}
