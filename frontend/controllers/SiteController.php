<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

use common\models\Company;
use common\models\Category;
use common\models\Guide;
use common\models\Theme;
use common\models\Page;


/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => ['yii\web\ErrorAction']
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $theme = $this->findMainTheme();
        $category = $theme->category;
        $model = $this->findModel('home');
        return $this->render('index', [
            'category' => $category,
            'model' => $model,
        ]);
    }

    /**
     * Displays static pages page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $model = $this->findModel('about');
        return $this->render('page', [
            'model' => $model
        ]);
    }

    public function actionPolicy()
    {
        $model = $this->findModel('privacy');
        return $this->render('page', [
            'model' => $model
        ]);
    }

    public function actionDisclaimer()
    {
        $model = $this->findModel('disclaimer');
        return $this->render('page', [
            'model' => $model
        ]);
    }

    public function actionTos()
    {
        $model = $this->findModel('tos');
        return $this->render('page', [
            'model' => $model
        ]);
    }

    public function actionContact()
    {
        $model = $this->findModel('contact');
        return $this->render('page', [
            'model' => $model
        ]);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findMainTheme()
    {
        if (($models = Theme::find()->all()) !== null && count($models) > 0)  {
            return $models[0];
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne(['page_id'=>$id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
