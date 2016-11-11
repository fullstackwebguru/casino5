<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use common\models\Page;
use common\models\Theme;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * ThemeController implements the CRUD actions for Page model.
 */
class ThemeController extends Controller
{
    public $layout = 'catalog';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'detach', 'upload'],
                        'roles' => ['updateCatalog']
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $categories = Category::find()->orderBy('title')->asArray()->all();
        $model = $this->findMainTheme();

        if ($model->load(Yii::$app->request->post()))  {
            $model->save();
        }

        return $this->render('index', [
            'model' => $model,
            'categories' => $categories
        ]);
    }
   
   
   /**
     * Detach image from Guide
     * @param integer $id
     * @return mixed
     */
    public function actionDetach() {
        $model = $this->findMainTheme();
        $output = [];
        \Cloudinary\Uploader::destroy($model->banner_image);
        $model->banner_image = '';
        $model->save();
        echo json_encode($output);
    }

    public function actionUpload()
    {
        $model = $this->findMainTheme();

        $output = [];

        $image = UploadedFile::getInstanceByName('new_banner_image');
        if ($image) {
            $uploadResult = \Cloudinary\Uploader::upload($image->tempName);
            if (isset($uploadResult['public_id'])) {
                $banner_image = $uploadResult['public_id'];
                $model->banner_image = $banner_image;

                $model->save();

                $allImages[] = '<img src="' . cloudinary_url($banner_image, array("width" => 600, "height" => 90, "crop" => "fill")) .'" class="file-preview-image">';

                $allImageConfig[] =[   
                        'caption' => 'Image',
                        'frameAttr'=> [
                            'style' => 'height:150px; width:100px;',
                        ],
                        'url' => Url::toRoute(['detach'])
                ];
            }

            $output['initialPreview'] = $allImages;
            $output['initialPreviewConfig'] = $allImageConfig;
        }

        echo json_encode($output);
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
}
