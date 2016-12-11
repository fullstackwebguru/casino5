<?php

namespace frontend\widgets;

use Yii;

use yii\helpers\Html;
use yii\helpers\Url;

use common\models\Category;

class Banner extends \yii\base\Widget
{
    /**
     * @var array the options for rendering 
     */
    public $class1;
    public $category;
    public $title;
    public $categories;

    public function init()
    {
        parent::init();

        if ($this->class1 == null) {
            $this->class1 = "top";
        }

        if ($this->category == null) {
            throw new NotFoundHttpException('The requested category does not exist.');   
        }

        $this->categories = Category::find()->where(['<>', 'id', 1])->orderBy(['self_rank' => SORT_ASC])->all();
    }

    public function run()
    {
        return $this->render('banner', ['class1'=> $this->class1, 'categories' => $this->categories, 'mainCategory'=> $this->category]);
    }

    public function getViewPath() {
        return '@frontend/widgets/views/';
    }
}
