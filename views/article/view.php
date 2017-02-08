<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('article', 'Articles'), 'url' => Url::to(['/article/article/index'])];
$this->params['breadcrumbs'][] = $model->title;
$this->registerJs('
    var article_id = "' . $model->id . '";
    load_comments(\'article\',article_id);
    jQuery("#comments-article-"+article_id).collapse(\'show\');
');
?>
<div class="row">
    <div class="col-xs-12 col-md-9 main">
        <div class="widget-question widget-article">
            <h3 class="title"><?= Html::encode($model->title); ?></h3>
            <ul class="taglist-inline">
                <?php foreach ($model->tags as $tag):
                    $tags[] = $tag->name;
                    ?>
                    <li class="tagPopup">
                        <a class="tag"
                           href="<?= Url::to(['/question/question/tag', 'tag' => $tag->name]) ?>"><?= Html::encode($tag->name) ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="content mt-10">
                <div class="quote mb-20">
                    <?= $model->description; ?>
                </div>
                <div class="text-fmt">
                    <?= $model->data->content; ?>
                </div>
                <div class="post-opt mt-30">
                    <ul class="list-inline text-muted">
                        <li>
                            <i class="fa fa-clock-o"></i>
                            发表于 <?= Yii::$app->formatter->asDate($model->created_at) ?>
                        </li>
                        <li>阅读 ( <?= $model->views ?> )</li>

                    </ul>
                </div>
            </div>
            <div class="text-center mt-10 mb-20">

                <button id="support-button" class="btn btn-success btn-lg mr-5" data-source_id="3" data-source_type="article" data-support_num="56">57 已推荐</button>

                <button id="collect-button" class="btn btn-default btn-lg" data-loading-text="加载中..." data-source_type="article" data-source_id="3">已收藏</button>
            </div>
            <div class="mb-10">
                <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
                <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"24"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
            </div>
        </div>

        <div class="widget-answers mt-15">
            <h2 class="h4 post-title"><?= $model->comments ?> 条评论</h2>
            <?= \yuncms\comment\widgets\Comment::widget(['source_type' => 'article', 'source_id' => $model->id, 'hide_cancel' => false]) ?>
        </div>

    </div><!-- /.main -->


    <div class="col-xs-12 col-md-3 side">
        <div class="widget-user">
            <div class="media">
                <a class="pull-left" href="<?=Url::to(['/user/profile/show','id'=>$model->user_id])?>"><img class="media-object avatar-64" src="<?=$model->user->getAvatar('middle')?>" alt="<?=$model->user->username?>"></a>
                <div class="media-body ">
                    <a href="<?=Url::to(['/user/profile/show','id'=>$model->user_id])?>" class="media-heading"><?=$model->user->username?></a>
                    <p class="text-muted"><?=$model->user->profile->introduction?></p>
                    <p class="text-muted"><?=$model->user->userData->articles?> 篇文章</p>
                </div>
            </div>
        </div>

        <?= \yuncms\article\widgets\PopularArticle::widget(['limit' => 10, 'cache' => 3600]); ?>

        <?= \yuncms\article\widgets\PopularTag::widget(['limit' => 10, 'cache' => 3600]); ?>

    </div><!-- /.side -->
</div>