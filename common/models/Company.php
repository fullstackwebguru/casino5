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
 * @property string $short_description
 * @property string $description
 * @property string $website_url
 * @property string $bonus_text_font
 * @property string $bonus_offer
 * @property integer $bonus_as_value
 * @property double $rating
 * @property string $self_rank
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
            [['bonus_as_value','bonus_offer'], 'required'],
            [['feature_mobile', 'feature_instant_play', 'feature_download', 'feature_live_casino', 'feature_vip_program' ], 'required'],
            [['rating'], 'required'],
            [['self_rank'], 'integer'],
            [['review','short_description','description','logo_url', 'website_url', 'image_url', 'meta_keywords', 'meta_description'], 'string'],
            [['bonus_offer'], 'string'],
            [['feature_mobile', 'feature_instant_play', 'feature_download', 'feature_live_casino', 'feature_vip_program' ], 'boolean'],
            [['rating'], 'number', 'max' => 10],
            [['bonus_as_value','bonus_text_font'], 'integer'],
            [['title', 'slug','short_description'], 'string', 'max' => 255],
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
            'bonus_as_value' => 'Bonus As Percentage',
            'bonus_offer' => 'Bonus Offers(Text)',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropComps()
    {
        return $this->hasMany(PropComp::className(), ['company_id' => 'id']);
    }

    public function getPropCompByProperty($property_id) {
        return  PropComp::findOne(['company_id'=>$this->id, 'property_id' => $property_id]);
    }

    public function getMaxSelfRank() {
        $maxModels = Company::find()->orderBy(['self_rank' => SORT_DESC])->limit(1)->all();
        foreach ($maxModels as $maxModel) {
            return $maxModel->self_rank;
        }

        return 0;
    }
}
