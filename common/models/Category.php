<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $short_title
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $self_rank
 * @property string $slug
 * @property string $image_url
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $created_at
 * @property integer $updated_at
 *
 */

class Category extends ActiveRecord
{
    const STATUS_DELETED = false;
    const STATUS_ACTIVE = true;

    public $temp_image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
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
            [['title','short_title', 'short_description', 'meta_keywords', 'meta_description'], 'required'],
            [['title', 'subtitle', 'kw'], 'string', 'max' => 255],
            [['self_rank'], 'integer'],
            [['description', 'image_url', 'meta_keywords', 'meta_description'], 'string'],
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
            'description' => 'Description',
            'slug' => 'Slug',
            'image_url' => 'Image',
            'temp_image' => 'Image',
            'meta_keywords' => 'SEO Keywords',
            'meta_description' => 'SEO description',
            'status' => 'Enabled',
            'kw' => 'Default KW',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Finds category by title
     *
     * @param string $title
     * @return static|null
     */
    public static function findByCategorytitle($title)
    {
        return static::findOne(['title' => $title, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCateComps()
    {
        return $this->hasMany(CateComp::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropCates()
    {
        return $this->hasMany(PropCate::className(), ['category_id' => 'id']);
    }

    public function getCateCompsSortByFeatures()
    {
        $query = $this->getCateComps()->joinWith('category')->joinWith('company')->select(['*','(feature_mobile + feature_instant_play + feature_download + feature_live_casino + feature_vip_program) as cusrank'])->orderBy('cusrank DESC');
        return $query->all();
    }

    public function getCateCompsSortByRank($filter)
    {
        $query = $this->getCateComps()->joinWith('category')->joinWith('company')->where($filter)->orderBy('rank ASC');
        return $query->all();
    }

    public function getMaxRank() {
        return $this->getCateComps()->count();
    }

    public function getMaxSelfRank() {
        $maxModels = Category::find()->orderBy(['self_rank' => SORT_DESC])->limit(1)->all();
        foreach ($maxModels as $maxModel) {
            return $maxModel->self_rank;    
        }
    }



    public function getTableTitleText($kw) {

        if ($kw == null || $kw == '') {
            $kw = $this->kw;
        }
        $sanitizedLinkText = str_replace("##@", "<span class=\"red\">", $this->subtitle);
        $sanitizedLinkText = str_replace("@##", "</span>", $sanitizedLinkText);
        $sanitizedLinkText = str_replace("%kw%", $kw, $sanitizedLinkText);
        return $sanitizedLinkText;
    }

    /**
     * @return url
     */
    public function getRoute()
    {
        return ['category/slug', 'slug' => $this->slug];
    }
}

