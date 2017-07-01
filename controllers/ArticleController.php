<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\article\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yuncms\tag\models\Tag;
use yuncms\article\models\Article;

/**
 * Class ArticleController
 * @package yuncms\article\controllers
 */
class ArticleController extends Controller
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'tag'],
                        'roles' => ['?', '@'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Article::find()->active();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->applyOrder(Yii::$app->request->get('order', 'new'));
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * 显示标签页
     *
     * @param string $tag 标签
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionTag($tag)
    {
        Url::remember('', 'actions-redirect');
        if (($model = Tag::findOne(['name' => $tag])) != null) {
            $query = Article::find()->anyTagValues($tag, 'name')->with('user');
            $query->andWhere(['>', Article::tableName() . '.status', 0]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            return $this->render('tag', ['model' => $model, 'dataProvider' => $dataProvider]);
        } else {
            throw new NotFoundHttpException (Yii::t('yii', 'The requested page does not exist.'));
        }
    }

    /**
     * 查看文章
     * @param int $id
     * @param string $uuid
     * @return string|\yii\web\Response
     */
    public function actionView($id = null, $uuid = null)
    {
        if (!is_null($id)) {
            $model = $this->findModel($id);
        } else {
            $model = $this->findModel($uuid);
        }
        if ($model && ($model->isActive() || $model->isAuthor())) {
            if (!$model->isAuthor()) $model->updateCounters(['views' => 1]);
            return $this->render('view', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('success', Yii::t('article', 'Article does not exist.'));
            return $this->redirect(['index',]);
        }
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne(['id' => $id])) != null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist');
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $uuid
     *
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelByUUID($uuid)
    {
        if (($model = Article::findOne(['uuid' => $uuid])) != null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist');
    }
}