<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "guide".
 *
 * @property integer $id
 * @property string $title
 * @property string $author
 * @property string $slug
 * @property string $image_url
 * @property string $description
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $created_at
 * @property integer $updated_at
 *
 */

class Guide extends ActiveRecord
{
    const STATUS_DELETED = false;
    const STATUS_ACTIVE = true;

    public $temp_image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%guide}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'author', 'meta_keywords', 'meta_description'], 'required'],
            [['description','image_url'], 'string'],
            [['title', 'author', 'slug'], 'string', 'max' => 255],
            [['temp_image'], 'safe'],
            [['temp_image'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'author' => 'Author',
            'image_url' => 'Image',
            'temp_image' => 'Image',
            'description' => 'Description',
            'meta_keywords' => 'SEO Keywords',
            'meta_description' => 'SEO description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return url
     */
    public function getRoute()
    {
        return ['guide/slug', 'slug' => $this->slug];
    }
}
