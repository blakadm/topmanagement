<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "tbl_announcement".
 *
 * @property integer $AnnouncementID
 * @property integer $AnnouncementTypeID
 * @property string $Title
 * @property string $Announcement
 * @property string $StartDate
 * @property string $EndDate
 *
 * @property \app\models\AnnouncementType $announcementType
 */
class Announcement extends \yii\db\ActiveRecord
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
            'announcementType'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AnnouncementTypeID', 'Title', 'Announcement', 'StartDate', 'EndDate'], 'required'],
            [['AnnouncementTypeID'], 'integer'],
            [['Announcement'], 'string'],
            [['StartDate', 'EndDate'], 'safe'],
            [['Title'], 'string', 'max' => 30],
            [['StartDate', 'EndDate'], 'unique', 'targetAttribute' => ['StartDate', 'EndDate'], 'message' => 'The combination of Start Date and End Date has already been taken.'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_announcement';
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
            'AnnouncementID' => Yii::t('app', 'Announcement ID'),
            'AnnouncementTypeID' => Yii::t('app', 'AnnouncementType'),
            'Title' => Yii::t('app', 'Title'),
            'Announcement' => Yii::t('app', 'Announcement'),
            'StartDate' => Yii::t('app', 'Start Date'),
            'EndDate' => Yii::t('app', 'End Date'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncementType()
    {
        return $this->hasOne(AnnouncementType::className(), ['AnnouncementTypeID' => 'AnnouncementTypeID']);
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
     * @return \app\models\AnnouncementQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\AnnouncementQuery(get_called_class());
        return $query->where(['deleted_by' => 0]);
    }
}
