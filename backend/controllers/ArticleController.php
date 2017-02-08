<?php

namespace yuncms\article\backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\bootstrap\ActiveForm;
use yii\web\NotFoundHttpException;
use yuncms\article\models\Article;
use yuncms\article\models\ArticleData;
use yuncms\article\models\ArticleSearch;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'batch-delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember('', 'actions-redirect');
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        $data = new ArticleData();
        if ($model->load(Yii::$app->request->post()) && $data->load(Yii::$app->request->post())) {
            $isValid = $model->validate();
            $isValid = $data->validate() && $isValid;
            if ($isValid) {
                $model->save(false);
                $data->link('article', $model);
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Create success.'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'data' => $data,

        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = $model->data;
        if ($model->load(Yii::$app->request->post()) && $data->load(Yii::$app->request->post())) {
            $model->save();
            $isValid = $model->validate();
            $isValid = $data->validate() && $isValid;
            if ($isValid) {
                $model->save(false);
                $data->save(false);
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update success.'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    /**
     * Audit an existing Comment model.
     * If Audit is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionAudit($id)
    {
        $model = $this->findModel($id);
        $model->setPublished();
        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Update success.'));
        return $this->redirect(Url::previous('actions-redirect'));
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Delete success.'));
        } else {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Delete failed.'));
        }
        return $this->redirect(['index']);
    }

    public function actionBatchDelete()
    {
        if (($ids = Yii::$app->request->post('ids', null)) != null) {
            foreach ($ids as $id) {
                $model = $this->findModel($id);
                $model->delete();
            }
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Delete success.'));
        }else {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Delete failed.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException (Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
