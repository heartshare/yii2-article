<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/*
 * @var yii\web\View $this
 */

$this->title = Yii::t('article', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>
    <i class="glyphicon glyphicon-tags"></i> <?= Html::encode($this->title) ?><br>
    <small>标签不仅能组织和归类你的内容，还能关联相似的内容。正确的使用标签可让你更容易的找到需要的源代码。</small>
</h1>
<div class="row">
    <div class="col-xs-12 col-md-9 main">
        <?= ListView::widget([
            'options' => [
                'tag' => 'ul',
                'class' => 'media-list'
            ],
            'itemOptions' => ['tag' => 'li', 'class' => 'media'],
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
        aaa
    </div><!-- /.side -->
</div>


