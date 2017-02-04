<?php

use yii\helpers\Html;
use yuncms\admin\widgets\Jarvis;

/* @var $this yii\web\View */
/* @var yuncms\article\models\Article $model  */
/* @var yuncms\article\models\ArticleData $data */

$this->title = Yii::t('article', 'Create Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('article', 'Manage Article'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 article-create">
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
                'data' => $data,
            ]) ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>
