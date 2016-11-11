<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;

use common\models\Company;
use common\models\Page;

/**
 * Casino controller
 */
class CompareController extends Controller
{
    public function actionIndex() 
    {
        $companies = Company::find()->orderBy(['rating' => 'desc'])->limit(10)->all();
        $model = Page::findOne(['page_id'=>'compare']);
        return $this->render('index', [
            'companies' => $companies,
            'model' => $model
        ]);   
    }

    /**
     * Finds the Casino model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug
     * @return Casino the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelBySlug($slug)
    {
        if (($model = Company::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
