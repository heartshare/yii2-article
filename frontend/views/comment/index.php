<?php

use yii\widgets\Pjax;
use yii\widgets\ListView;

?>
<?php Pjax::begin(); ?>
<?= ListView::widget([
    'options' => ['class' => null],
    'dataProvider' => $dataProvider,
    'itemView' => '_item',//子视图
    'itemOptions' => ['class' => 'media'],
    'layout' => "{items}\n{pager}",
]); ?>
<?php Pjax::end(); ?>
