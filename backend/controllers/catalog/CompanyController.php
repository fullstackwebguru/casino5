<?php

namespace backend\controllers\catalog;

use Yii;
use common\models\Category;
use common\models\Company;
use backend\models\CompanySearch;
use backend\models\CompanyInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
                        'actions' => ['index', 'create','view', 'update', 'delete' ,'detach', 'upload', 'delogo', 'uplogo'],
                        'roles' => ['updateCatalog']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'deleteinfo' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (Yii::$app->request->isAjax && Yii::$app->request->post('hasEditable')) {
            $productId = Yii::$app->request->post('editableKey');
            $model = $this->findModel($productId);

            $out = ['output'=>'', 'message'=>''];
            $posted = current(Yii::$app->request->post('Company'));
            $post = ['Company' => $posted];

            if ($model->load($post) && $model->save()) {
                $out['message'] = '';
            } else {        
                $out['message'] = 'Error in request';
            }

            echo Json::encode($out);
            return;
        } else {

            $searchModel = new CompanySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);
        }
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post('kvdelete')) {
                $this->findModel($id)->delete();
                echo Json::encode([
                    'success' => true,
                    'messages' => [
                        'kv-detail-info' => 'The category # ' . $id . ' was successfully deleted. ' . 
                            Html::a('<i class="glyphicon glyphicon-hand-right"></i>  Click here', 
                                ['index'], ['class' => 'btn btn-sm btn-info']) . ' to proceed.'
                    ]
                ]);
                return;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Detach Company Image  from Company
     * @param integer $id
     * @param integer $imageId
     * @return mixed
     */
    public function actionDelogo($id) {
        $model = $this->findModel($id);
        $output = [];
        \Cloudinary\Uploader::destroy($model->logo_url);
        $model->logo_url = '';
        $model->save();
        echo json_encode($output);
    }

   public function actionUplogo($id)
    {
        $model = $this->findModel($id);

        $output = [];

        $image = UploadedFile::getInstanceByName('new_company_logo');

        if ($image) {

            $uploadResult = \Cloudinary\Uploader::upload($image->tempName);

            if (isset($uploadResult['public_id'])) {
                $image_url = $uploadResult['public_id'];
                $model->image_url = $image_url;

                $model->save();

                $allImages[] = '<img src="' . cloudinary_url($image_url, array("width" => 247, "height" => 78, "crop" => "fill")) .'" class="file-preview-image">';

                $allImageConfig[] =[   
                        'caption' => 'Image',
                        'frameAttr'=> [
                            'style' => 'height:150px; width:100px;',
                        ],
                        'url' => Url::toRoute(['detach', 'id'=>$model->id])
                ];
            }

            $output['initialPreview'] = $allImages;
            $output['initialPreviewConfig'] = $allImageConfig;
        }

        echo json_encode($output);
    }

    /**
     * Detach Company Image  from Company
     * @param integer $id
     * @param integer $imageId
     * @return mixed
     */
    public function actionDetach($id) {
        $model = $this->findModel($id);
        $output = [];
        \Cloudinary\Uploader::destroy($model->image_url);
        $model->image_url = '';
        $model->save();
        echo json_encode($output);
    }

   public function actionUpload($id)
    {
        $model = $this->findModel($id);

        $output = [];

        $image = UploadedFile::getInstanceByName('new_company_image');

        if ($image) {

            $uploadResult = \Cloudinary\Uploader::upload($image->tempName);

            if (isset($uploadResult['public_id'])) {
                $image_url = $uploadResult['public_id'];
                $model->image_url = $image_url;

                $model->save();

                $allImages[] = '<img src="' . cloudinary_url($image_url, array("width" => 250, "height" => 190, "crop" => "fill")) .'" class="file-preview-image">';

                $allImageConfig[] =[   
                        'caption' => 'Image',
                        'frameAttr'=> [
                            'style' => 'height:150px; width:100px;',
                        ],
                        'url' => Url::toRoute(['detach', 'id'=>$model->id])
                ];
            }

            $output['initialPreview'] = $allImages;
            $output['initialPreviewConfig'] = $allImageConfig;
        }

        echo json_encode($output);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();
        if ($model->load(Yii::$app->request->post()) ) {

            $image = UploadedFile::getInstance($model, 'temp_image');
            if ($image) {

                $uploadResult = \Cloudinary\Uploader::upload($image->tempName);

                if (isset($uploadResult['public_id'])) {
                    $image_url = $uploadResult['public_id'];
                    $model->image_url = $image_url;
                }
            }

            $image_logo = UploadedFile::getInstance($model, 'temp_image_logo');
            if ($image_logo) {

                $uploadResult = \Cloudinary\Uploader::upload($image_logo->tempName);

                if (isset($uploadResult['public_id'])) {
                    $logo_url = $uploadResult['public_id'];
                    $model->logo_url = $logo_url;
                }
            }
            
            if ($model->save())  {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
