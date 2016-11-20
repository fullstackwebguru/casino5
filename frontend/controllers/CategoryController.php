<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use common\models\Category;
use common\models\Page;

/**
 * Category controllers
 */
class CategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex() {

        $categories = Category::find()->where(['<>', 'id', 1])->orderBy('title')->all();

        $model = Page::findOne(['page_id'=>'categories']);
        return $this->render('index', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    public function actionSlug($slug) 
    {
        $category = $this->findModelBySlug($slug);

        $queryParams = Yii::$app->request->queryParams;
        $filterSelected = isset($queryParams['filter']) ? $queryParams['filter'] : '';

        $filters = [];
        
        switch ($filterSelected) {
            case 'mobile': 
                $filters = ['<>', 'feature_mobile', 0];
                break;
            case 'instant': 
                $filters = ['<>', 'feature_instant_play', 0];
                break;
            case 'live': 
                $filters = ['<>', 'feature_live_casino', 0];
                break;
            case 'download': 
                $filters = ['<>', 'feature_download', 0];
                break;
            case 'vip': 
                $filters = ['<>', 'feature_vip_program', 0];
                break;
        }

        $cateComps = $category->getCateCompsSortByRank($filters);


        return $this->render('view', [
            'category' => $category,
            'filterSelected' => $filterSelected,
            'cateComps' => $cateComps
        ]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelBySlug($slug)
    {
        if (($model = Category::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
