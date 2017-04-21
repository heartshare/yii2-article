<?php

use yii\helpers\Html;
use yuncms\admin\widgets\Jarvis;

/* @var yii\web\View $this */
/* @var yuncms\article\models\Article $model */

$this->title = Yii::t('article', 'Update Article') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('article', 'Manage Article'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 article-update">
            <?php Jarvis::begin([
                'editbutton' => false,
                'deletebutton' => false,
                'header' => Html::encode($this->title),
                'bodyToolbarActions' => [
                    [
                        'label' => Yii::t('article', 'Manage Article'),
                        'url' => ['/article/article/index'],
                    ],
                    [
                        'label' => Yii::t('article', 'Create Article'),
                        'url' => ['/article/article/create'],
                    ],
                ]
            ]); ?>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>