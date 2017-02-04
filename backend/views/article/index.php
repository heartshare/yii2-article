<?php
use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use yuncms\admin\widgets\Jarvis;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel yuncms\article\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('article', 'Manage Article');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
jQuery(\"#batch_deletion\").on(\"click\", function () {
    yii.confirm('".Yii::t('app', 'Are you sure you want to delete this item?')."',function(){
        var ids = jQuery('#gridview').yiiGridView(\"getSelectedRows\");
        jQuery.post(\"batch-delete\",{ids:ids});
    });
});
", View::POS_LOAD);

?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 article-index">
            <?php Pjax::begin(); ?>
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
                        'options' => ['id' => 'batch_deletion','class'=>'btn btn-sm btn-danger'],
                        'label' => Yii::t('article', 'Batch Deletion'),
                        'url' => 'javascript:void(0);',
                    ]
                ]
            ]); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'options' => ['id' => 'gridview'],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        "name" => "id",
                    ],
                    // ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'title',
                    //'cover',
                    'comments',
                    'views',
                    'is_top:boolean',
                    'is_hot:boolean',
                    'is_best:boolean',
                    // 'description',
                    'user_id',
                    'status',
                    'created_at:datetime',
                    // 'updated_at:datetime',
                    'published_at:datetime',
                    ['class' => 'yii\grid\ActionColumn', 'header' => Yii::t('app', 'Operation'),],
                ],
            ]); ?>
            <?php Jarvis::end(); ?>
            <?php Pjax::end(); ?>
        </article>
    </div>
</section>
