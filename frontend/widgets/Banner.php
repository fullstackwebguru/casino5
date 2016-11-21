<?php

namespace frontend\widgets;

use Yii;

use yii\helpers\Html;
use yii\helpers\Url;

use common\models\Theme;

class Banner extends \yii\base\Widget
{
    /**
     * @var array the options for rendering 
     */
    private $mainTheme;

    public $class1;
    public $breadcrumbs;
    public $title;

    public function init()
    {
        parent::init();

        if (($models = Theme::find()->all()) !== null && count($models) > 0)  {
            $this->mainTheme = $models[0];
        } else {
            throw new NotFoundHttpException('The requested theme does not exist.');
        }

        if ($this->class1 == null) {
            $this->class1 = "top";
        }
    }

    public function run()
    {
        if ($this->breadcrumbs != null) {
            return $this->render('banner', ['class1'=> $this->class1, 'theme' => $this->mainTheme, 'breadcrumbs' => $this->breadcrumbs, 'title' => $this->title]);    
        } else {
            return $this->render('banner', ['class1'=> $this->class1, 'theme' => $this->mainTheme]);
        }
        
    }

    public function getViewPath() {
        return '@frontend/widgets/views/';
    }
}
