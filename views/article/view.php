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
            <?= $model->data->content; ?>
        </article>

        <?= \yuncms\comment\widgets\Comment::widget(['source_type' => 'article', 'source_id' => $model->id, 'hide_cancel' => false]) ?>

    </div><!-- /.main -->


    <div class="col-xs-12 col-md-3 side">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media media-user">
                    <div class="media-left">
                        <a href="/user/1"><img class="media-object" src="http://www.51siyuan.cn/storage/upload/5790a630d3a74_avatar_96_96.jpeg" alt="易大师"></a>
                        <div class="label label-primary">大师</div>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading">
                            <a href="/user/1">易大师</a>
                        </h2>
                        <div class="time">注册时间：2015-09-09<br>最后登录：20分钟前</div>
                    </div>

                    <div class="media-footer">
                        <ul class="stat">
                            <li>粉丝<h3>10</h3></li>
                            <li>关注<h3>4</h3></li>
                            <li>金钱<h3>2447</h3></li>
                        </ul>
                        <a class="follow btn btn-xs btn-success  " href="/friend/follow?id=1"><i class="fa fa-plus"></i> 关注Ta </a>
                        <a class="btn btn-xs btn-primary " href="/message/default/create?id=1"><i class="fa fa-envelope"></i> 发私信</a>
                    </div>
                </div>
            </div>
        </div>

        <?= \yuncms\article\widgets\PopularArticle::widget(['limit'=>10,'cache'=>3600]); ?>

        <?= \yuncms\article\widgets\PopularTag::widget(['limit'=>10,'cache'=>3600]); ?>
        
    </div><!-- /.side -->
</div>