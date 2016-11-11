<?php

namespace frontend\widgets;

use common\models\Category;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class SideCategory extends \yii\base\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $title;
    public $num;

    /**
     * @var array the options for rendering 
     */
    private $categories;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = 'Categories';
        }

        if ($this->num === null) {
            $this->num = 5;
        }

        $this->categories = Category::find()->where(['<>','id',1])->orderBy(['created_at' => 'desc'])->limit($this->num)->all();
    }

    public function run()
    {
        return $this->render('side_categories', ['side_title' => $this->title ,'categories' => $this->categories]);
    }

    public function getViewPath() {
        return '@frontend/widgets/views/';
    }
}
