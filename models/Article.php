<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\article\models;

use Yii;
use yii\db\ActiveRecord;
use yuncms\tag\models\Tag;
use yuncms\system\models\Category;
use yuncms\user\models\Collection;
use yuncms\user\models\User;

/**
 * Class Article
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $title
 * @property string $sub_title
 * @property string $description
 * @property string $content
 * @property int $status
 * @property int $comments
 * @property int $supports
 * @property int $collections
 * @property int $views
 *
 * @property int $created_at
 * @property int $updated_at
 * @property int $published_at
 *
 * @property int $category_id
 *
 * @package yuncms\article\models
 */
class Article extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior'
            ],
            'tag' => [
                'class' => 'yuncms\tag\behaviors\TagBehavior',
                'tagValuesAsArray' => true,
                'tagRelation' => 'tags',
                'tagValueAttribute' => 'id',
                'tagFrequencyAttribute' => 'frequency',
            ],
            'blameable' => [
                'class' => 'yii\behaviors\BlameableBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id', 'content'], 'required'],
            [['title', 'sub_title', 'cover', 'description'], 'filter', 'filter' => 'trim'],
            ['is_top', 'boolean'],
            ['is_best', 'boolean'],
            [['is_best', 'is_top'], 'default', 'value' => false],
            ['status', 'default', 'value' => self::STATUS_PENDING],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_PENDING]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('article', 'Title'),
            'sub_title' => Yii::t('article', 'Sub Title'),
            'description' => Yii::t('article', 'Description'),
            'category_id' => Yii::t('article', 'Category'),
            'cover' => Yii::t('article', 'Cover'),
            'status' => Yii::t('article', 'Status'),
            'comments' => Yii::t('article', 'Comments'),
            'supports' => Yii::t('article', 'Supports'),
            'collections' => Yii::t('article', 'Collections'),
            'views' => Yii::t('article', 'Views'),
            'is_top' => Yii::t('article', 'Is Top'),
            'is_best' => Yii::t('article', 'Is Best'),
            'content' => Yii::t('article', 'Content'),
            'created_at' => Yii::t('article', 'Created At'),
            'updated_at' => Yii::t('article', 'Updated At'),
            'published_at' => Yii::t('article', 'Published At'),
        ];
    }

    public function isActive()
    {
        return $this->status == static::STATUS_ACTIVE;
    }

    /**
     * 是否是作者
     * @return bool
     */
    public function isAuthor()
    {
        return $this->user_id == Yii::$app->user->id;
    }

    /**
     * 审核通过
     * @return int
     */
    public function setPublished()
    {
        //记录动态
        doing($this->user_id, 'create_article', get_class($this), $this->id, $this->title, mb_substr(strip_tags($this->content), 0, 200));
        return $this->updateAttributes(['status' => static::STATUS_ACTIVE, 'published_at' => time()]);
    }

    /**
     * Category Relation
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Tag Relation
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('{{%article_tag}}', ['article_id' => 'id']);
    }

    /**
     * Collection Relation
     * @return \yii\db\ActiveQueryInterface
     */
    public function getCollections()
    {
        return $this->hasMany(Collection::className(), ['model_id' => 'id'])->onCondition(['model' => static::className()]);
    }

    /**
     * User Relation
     * @return \yii\db\ActiveQueryInterface
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Favorite Relation
     * @return \yii\db\ActiveQueryInterface
     */
    public function getCollection()
    {
        return $this->hasOne(Collection::className(), ['model_id' => 'id'])->onCondition(['model' => get_class($this)]);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_PENDING => Yii::t('article', 'Status Pending'),
            self::STATUS_ACTIVE => Yii::t('article', 'Status Active'),
        ];
    }

    /**
     * 保存后生成短网址
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->updateAttributes(['uuid' => $this->generateKey()]);
            /* 用户文章数+1 */
            Yii::$app->user->identity->extend->updateCounters(['articles' => 1]);
        }
        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * 生成key
     */
    protected function generateKey()
    {
        $result = sprintf("%u", crc32($this->id));
        $key = '';
        while ($result > 0) {
            $s = $result % 62;
            if ($s > 35) {
                $s = chr($s + 61);
            } elseif ($s > 9 && $s <= 35) {
                $s = chr($s + 55);
            }
            $key .= $s;
            $result = floor($result / 62);
        }
        return $key;
    }

    public function afterDelete()
    {
        $this->user->extend->updateCounters(['articles' => -1]);
        parent::afterDelete();
    }
}