<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "theme".
 *
 * @property integer $id
 * @property string $banner_heading
 * @property string $banner_subheading
 * @property string $banner_image
 * @property string $hwork_title1
 * @property string $hwork_description1
 * @property string $hwork_title2
 * @property string $hwork_description2
 * @property string $hwork_title3
 * @property string $hwork_description3
 * @property string $hwork_title4
 * @property string $hwork_description4
 * @property string $how_to_find_best
 * @property integer $created_at
 * @property integer $updated_at
 */

class Theme extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%theme}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id' ], 'required'],
            [['banner_heading','banner_subheading','banner_image'], 'string'],
            [['hwork_title1','hwork_description1'], 'string'],
            [['hwork_title2','hwork_description2'], 'string'],
            [['hwork_title3','hwork_description3'], 'string'],
            [['hwork_title4','hwork_description4'], 'string'],
            [['how_to_find_best'], 'string'],
            [['category_id' ], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'banner_image' => 'Banner Image',
            'banner_heading' => 'Banner Text',
            'banner_subheading' => 'Banner Text1',
            'hwork_title1' => 'How We Work 1',
            'hwork_description1' => 'How We Work Description 1',
            'hwork_title2' => 'How We Work 2',
            'hwork_description2' => 'How We Work Description 2',
            'hwork_title3' => 'How We Work 3',
            'hwork_description3' => 'How We Work Description 3',
            'hwork_title4' => 'How We Work 4',
            'hwork_description4' => 'How We Work Description 4',
            'how_to_find_best' => 'HOW TO FIND THE BEST ONLINE',
            'category_id' => 'Main Category',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
