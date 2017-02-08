<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?php if ($model->cover): ?>
    <div class="blog-rank hidden-xs">
        <a href="<?= Url::to(['/article/article/view', 'key' => $model->key]); ?>" target="_blank">
            <img style="width: 200px;height:120px;"
                 src="https://wenda.tipask.com/image/show/articles-2016-12-byzYzJR158624716218fb.png">
        </a>
    </div>
<?php endif; ?>
<div class="summary">
    <h2 class="title"><a href="<?= Url::to(['/article/article/view', 'key' => $model->key]); ?>"
                         target="_blank"><?= Html::encode($model->title) ?></a></h2>
    <p class="excerpt wordbreak"><?= mb_substr(strip_tags($model->data->content), 0, 100) ?></p>
    <ul class="author list-inline mt-20">
        <li class="pull-right" title="0 收藏">
            <span class="glyphicon glyphicon-bookmark"></span> 0
        </li>
        <li class="pull-right" title="0 推荐">
            <span class="glyphicon glyphicon-thumbs-up"></span> 7
        </li>
        <li>
            <a href="https://wenda.tipask.com/people/1503" target="_blank">
                <img class="avatar-20 mr-10 hidden-xs" src="https://wenda.tipask.com/image/avatar/1503_small.jpg"
                     alt="小明"> <?=$model->user->username?>
            </a>
        </li>
        <li>发布于 <?= Yii::$app->formatter->asRelativeTime($model->created_at); ?></li>
        <li>阅读 ( <?= $model->views ?> )</li>
    </ul>
</div>



