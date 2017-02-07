<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?php if($model->cover):?>
<div class="media-left">
    <a href="<?= Url::to(['/article/article/view', 'key' => $model->key]); ?>">
        <img class="media-object" src="<?= $model->cover; ?>" alt="utf-8">
    </a>
</div>
<?php endif;?>
<div class="media-body">
    <div class="media-heading">
        <a href="<?= Url::to(['/article/article/view', 'key' => $model->key]); ?>" target="_blank"><?= Html::encode($model->title) ?></a>
    </div>
    <div class="media-content"><?= mb_substr(strip_tags($model->data->content), 0, 100) ?></div>
    <div class="media-action"><?= Yii::$app->formatter->asRelativeTime($model->created_at); ?>

    </div>
</div>



