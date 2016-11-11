<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $title
 * @property string $logo_url
 * @property string $image_url
 * @property string $description
 * @property string $website_url
 * @property string $type_of_games
 * @property string $bonus_offer
 * @property string $software
 * @property string $support
 * @property string $currencies
 * @property string $languages
 * @property double $rating
 * @property string $review
 * @property integer $feature_mobile
 * @property integer $feature_instant_play
 * @property integer $feature_download
 * @property integer $feature_live_casino
 * @property integer $feature_vip_program
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 */

class Company extends ActiveRecord
{
    const STATUS_DELETED = false;
    const STATUS_ACTIVE = true;

    public $temp_image;
    public $temp_image_logo;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company}}';
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
            [['title', 'website_url', 'meta_keywords', 'meta_description'], 'required'],
            [['bonus_offer','software', 'type_of_games', 'support', 'currencies', 'languages' ], 'required'],
            [['feature_mobile', 'feature_instant_play', 'feature_download', 'feature_live_casino', 'feature_vip_program' ], 'required'],
            [['rating'], 'required'],
            [['review','description','logo_url', 'website_url', 'image_url', 'meta_keywords', 'meta_description'], 'string'],
            [['bonus_offer','software', 'type_of_games', 'support', 'currencies', 'languages' ], 'string'],
            [['feature_mobile', 'feature_instant_play', 'feature_download', 'feature_live_casino', 'feature_vip_program' ], 'boolean'],
            [['rating'], 'number', 'max' => 5],
            [['title', 'slug'], 'string', 'max' => 255],
            [['temp_image','temp_image_logo'], 'safe'],
            [['temp_image','temp_image_logo'], 'file', 'extensions'=>'jpg, gif, png'],
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
            'description' => 'Description',
            'website_url' => 'Website',
            'image_url' => 'Image',
            'logo_url' => 'Logo',
            'rating' => 'Rating',
            'bonus_offer' => 'Bonus Offers',
            'software' => 'Software',
            'type_of_games' => 'Type of games',
            'support' => 'Support',
            'currencies' => 'Currencies',
            'languages' => 'Languages',
            'feature_mobile' => 'Mobile',
            'feature_instant_play' => 'Instant Play',
            'feature_download' => 'Download',
            'feature_live_casino' => 'Live Casino',
            'feature_vip_program' => 'VIP Program',
            'meta_keywords' => 'SEO Keywords',
            'meta_description' => 'SEO description',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'temp_image_logo' => 'Logo',
            'temp_image' => 'Image'
        ];
    }

    /**
     * @return url
     */
    
    public function getRoute()
    {
        return ['casino/slug', 'slug' => $this->slug];
    }
}
