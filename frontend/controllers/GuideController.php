<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;

use common\models\Guide;
use common\models\Page;

/**
 * Guide controller
 */
class GuideController extends Controller
{
    public function actionIndex() {
        $guides = Guide::find()->orderBy(['created_at' => 'desc'])->all();
        $model = Page::findOne(['page_id'=>'guides']);
        return $this->render('index', [
            'guides' => $guides,
            'model' => $model
        ]);
    }
    public function actionSlug($slug) 
    {
        $model = $this->findModelBySlug($slug);
        return $this->render('view', [
            'model' => $model
        ]);   
    }

    /**
     * Finds the Guide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug
     * @return Guide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelBySlug($slug)
    {
        if (($model = Guide::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
