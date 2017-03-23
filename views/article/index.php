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
<h4>
    <i class="glyphicon glyphicon-tags"></i> <?= Html::encode($this->title) ?><br>
    <small>标签不仅能组织和归类你的内容，还能关联相似的内容。正确的使用标签可让你更容易的找到需要的源代码。</small>
</h4>
<div class="row">
    <div class="col-xs-12 col-md-9 main">
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
            <p><?=Yii::t('article','Today, what experience do you need to share?？ Write it down');?></p>
            <a class="btn btn-primary btn-block mt-10" href="<?=Url::to(['/article/manage/create'])?>"><i class="fa fa-edit"></i> <?=Yii::t('article','Write a article');?></a>
        </div>

        <?= \yuncms\article\widgets\PopularArticle::widget(['limit'=>10,'cache'=>3600]); ?>

        <?= \yuncms\article\widgets\PopularTag::widget(['limit'=>10,'cache'=>3600]); ?>
    </div><!-- /.side -->
</div>


