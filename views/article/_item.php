<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>


<div class="media-left">
    <a href="<?= Url::to(['/article/article/view', 'key' => $model->key]); ?>">
        <img class="media-object" src="<?= $model->cover; ?>" alt="utf-8">
    </a>
</div>

<div class="media-body">
    <div class="media-heading">
        <?= Html::encode($model->title) ?>
    </div>
    <div class="media-content"><?= mb_substr(Html::encode($model->data->content), 0, 100) ?></div>
    <div class="media-action"><?= Yii::$app->formatter->asRelativeTime($model->created_at); ?>

    </div>
</div>



