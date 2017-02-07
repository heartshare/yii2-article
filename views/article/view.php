<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('article', 'Articles'), 'url' => Url::to(['/article/article/index'])];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="row">
    <div class="col-xs-12 col-md-9 main">
        <div class="article-header">
            <h1 class="article-title text-center">
                <?= Html::encode($model->title); ?>
            </h1>
            <div class="article-meta text-center">
                <time class="muted">
                    <i class="fa fa-clock-o"></i> <?= Yii::$app->formatter->asDate($model->created_at) ?></time>
                    <span ><i class="fa fa-eye"></i> <?= $model->views?></span>
            </div>
        </div>

        <article class="article-content">
            <?= Html::encode($model->data->content); ?>
        </article>

    </div><!-- /.main -->


    <div class="col-xs-12 col-md-3 side">

    </div><!-- /.side -->
</div>