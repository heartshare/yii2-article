<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\article\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yuncms\article\models\Article;
use yuncms\article\models\Comment;

/**
 * Class CommentController
 * @package yuncms\article\frontend\controllers
 */
class CommentController extends Controller
{

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($id)
    {
        $model = $this->findModel($id);

        $query = Comment::find()->where([
            'source_id' => $id,
        ])->with('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    /**
     * 创建评论
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Comment();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'uuid' => $model->uuid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
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
        throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist'));
    }
}