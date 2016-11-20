<?php

namespace frontend\widgets;

use common\models\Company;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class SideTop5 extends \yii\base\Widget
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
    private $companies;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = 'Top 5 best online casinos';
        }

        if ($this->num === null) {
            $this->num = 5;
        }

        $this->companies = Company::find()->orderBy(['rating' => SORT_DESC])->limit($this->num)->all();
    }

    public function run()
    {
        return $this->render('side_companies', ['side_title' => $this->title ,'companies' => $this->companies]);
    }

    public function getViewPath() {
        return '@frontend/widgets/views/';
    }
}
