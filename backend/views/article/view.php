<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yuncms\admin\widgets\Jarvis;

/* @var $this yii\web\View */
/* @var $model yuncms\article\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('article', 'Manage Article'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 article-view">
            <?php Jarvis::begin([
                'noPadding' => true,
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
                    [
                        'label' => Yii::t('article', 'Update Article'),
                        'url' => ['/article/article/update', 'id' => $model->id],
                        'options' => ['class' => 'btn btn-primary btn-sm']
                    ],
                    [
                        'label' => Yii::t('article', 'Delete Article'),
                        'url' => ['/article/article/delete', 'id' => $model->id],
                        'options' => [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]
                    ],
                ]
            ]); ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'key',
                    'title',
                    'status',
                    'cover',
                    'description',
                    'data.content:html',
                    'comments',
                    'views',
                    'is_top:boolean',
                    'is_hot:boolean',
                    'is_best:boolean',

                    'user.username',
                    'created_at:datetime',
                    'updated_at:datetime',
                    'published_at:datetime',
                ],
            ]) ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>