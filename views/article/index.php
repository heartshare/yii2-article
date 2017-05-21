<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/*
 * @var yii\web\View $this
 */

$this->title = Yii::t('article', 'Articles');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12 col-xs-12 col-md-9 main">
        <div class="page-header">
            <h4>
                <i class="glyphicon glyphicon-tags"></i> <?= Html::encode($this->title) ?>
            </h4>
        </div>
        <?= ListView::widget([
            'options' => [
                'class' => 'stream-list blog-stream'
            ],
            'itemOptions' => ['tag' => 'section', 'class' => 'stream-list-item clearfix'],
            'layout' => '{items} <div class="text-center">{pager}</div>',
            'pager' => [
                'maxButtonCount' => 10,
                'nextPageLabel' => Yii::t('app', 'Next page'),
                'prevPageLabel' => Yii::t('app', 'Previous page'),
            ],
            'dataProvider' => $dataProvider,
            'itemView' => '_item'
        ]);
        ?>
    </div><!-- /.main -->

    <div class="col-xs-12 col-md-3 side">
        <div class="side-alert alert alert-warning mt-30">
            <p><?= Yii::t('article', 'Today, what experience do you need to share?？ Write it down'); ?></p>
            <a class="btn btn-primary btn-block mt-10" href="<?= Url::to(['/article/manage/create']) ?>"><i
                        class="fa fa-edit"></i> <?= Yii::t('article', 'Write a article'); ?></a>
        </div>
        <?= \yuncms\article\widgets\PopularArticle::widget(['limit' => 10, 'cache' => 3600]); ?>
        <?= \yuncms\article\widgets\PopularTag::widget(['limit' => 10, 'cache' => 3600]); ?>
    </div><!-- /.side -->
</div>


