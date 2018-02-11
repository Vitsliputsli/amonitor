<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DbQueries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="db-queries-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'monitor_items_id')->dropDownList(
            $items,['options' =>[ Yii::$app->request->get('item-id') => ['Selected' => true]]]) ?>

    <?= $form->field($model, 'db_query')->textArea(['maxlength' => true,'rows'=>12]) ?>

    <?= $form->field($model, 'db_name')->dropDownList($dbNames) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord
            ? 'Create'
            : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
