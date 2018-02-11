<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AlertEmails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alert-emails-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'monitor_groups_id')->dropDownList($groups) ?>

    <?= $form->field($model, 'monitor_items_id')->dropDownList($items) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord
            ? Yii::t('translation','Create')
            : Yii::t('translation','Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
