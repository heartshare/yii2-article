<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yuncms\article\models\Article;
use xutl\ueditor\UEditor;

/* @var \yii\web\View $this */
/* @var yuncms\article\models\Article $model */
/* @var yuncms\article\models\ArticleData $data */
/* @var ActiveForm $form */
?>
<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
<fieldset>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->inline(true)->radioList([Article::STATUS_ACTIVE => Yii::t('article', 'Active'), Article::STATUS_PENDING => Yii::t('article', 'Pending')]) ?>

    <?= $form->field($model, 'cover')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cover')->fileInput(['style' => 'max-width:200px;max-height:200px']); ?>

    <?= $form->field($model, 'is_top')->inline(true)->radioList([true => Yii::t('app', 'Yes'), false => Yii::t('app', 'No')]) ?>

    <?= $form->field($model, 'is_hot')->inline(true)->radioList([true => Yii::t('app', 'Yes'), false => Yii::t('app', 'No')]) ?>

    <?= $form->field($model, 'is_best')->inline(true)->radioList([true => Yii::t('app', 'Yes'), false => Yii::t('app', 'No')]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'rows' => 5]) ?>

    <?= $form->field($data, 'content')->widget(UEditor::className(),[

    ]) ?>
</fieldset>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

