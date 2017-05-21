<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yuncms\article\models\Category;
use xutl\ueditor\UEditor;
use xutl\fileupload\SingleUpload;

/* @var $this yii\web\View */
/* @var $model yuncms\article\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'wrapper' => 'col-sm-10',
                'error' => '',
                'hint' => '',
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]) ?>

    <?php
    $categories = Category::find()->select(['id', 'name', 'pinyin'])->where(['parent' => null])->with('categories')->orderBy(['sort' => SORT_ASC])->asArray()->all();
    if (Yii::$app->language == 'en-US') {
        foreach ($categories as $id => $category) {
            $categories[$id]['categories'] = ArrayHelper::map($category['categories'], 'id', 'pinyin');
        }
    } else {
        foreach ($categories as $id => $category) {
            $categories[$id]['categories'] = ArrayHelper::map($category['categories'], 'id', 'name');
        }
    } ?>
    <?= $form->field($model, 'category_id')->label($model->getAttributeLabel('category_id'))->dropDownList(ArrayHelper::map($categories, 'name', 'categories'), [
        'prompt' => Yii::t('a', 'Please select')
    ]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cover')->widget(SingleUpload::className(), [
        'onlyImage' => true,
    ]) ?>

    <?= $form->field($model, 'content')->widget(UEditor::className()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('article', 'Create') : Yii::t('article', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
