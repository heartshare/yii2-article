<?php
use yii\bootstrap\Nav;
?>

<?= Nav::widget([
    'options' => ['class' => 'nav nav-tabs'],
    'items' => [

        //我发起的直播
        ['label' => Yii::t('article', 'My Articles'), 'url' => ['/article/space/started', 'id' => $user->id]],
        //我收藏的直播
        ['label' => Yii::t('article', 'Collection of articles'), 'url' => ['/article/space/collected', 'id' => $user->id]]
    ]
]); ?>
