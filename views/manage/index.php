<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel yuncms\article\models\ManageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('article', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('article', 'Create Article'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'key',
            'category_id',
            'title',
            'sub_title',
            // 'description',
            // 'status',
            // 'cover',
            // 'comments',
            // 'supports',
            // 'collections',
            // 'views',
            // 'is_top',
            // 'is_hot',
            // 'is_best',
            // 'user_id',
            // 'content:ntext',
            // 'created_at',
            // 'updated_at',
            // 'published_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
