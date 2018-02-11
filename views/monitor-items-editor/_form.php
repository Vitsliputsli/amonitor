<?php

use yii\helpers\Html;
use kartik\time\TimePicker;
use kartik\field\FieldRange;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MonitorItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">
    <div class="monitor-items-form">

        <?php $form = ActiveForm::begin([
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL],
        ]); ?>

        <?= $form->field($model, 'monitor_groups_id')->dropDownList($groups) ?>

        <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

        <div class="row">
            <label class="control-label col-sm-2">
                <span class="glyphicon glyphicon-warning-sign color-orange"></span>
                <?= Yii::t('translation', 'Warning') ?>
            </label>
            <?= $form->field($model, 'warning_operator',
                ['options'=>['class'=>'row col-sm-2']])->dropDownList($operators)->label(false) ?>
            <?= $form->field($model, 'warning_value',
                ['options'=>['class'=>'col-sm-4']])->textInput(['maxlength' => true])->label(false) ?>
        </div>

        <div class="row">
            <label class="control-label col-sm-2">
                <span class="glyphicon glyphicon-alert color-red"></span>
                <?= Yii::t('translation', 'Alert') ?>
            </label>
            <?= $form->field($model, 'alert_operator',
                ['options'=>['class'=>'row col-sm-2']])->dropDownList($operators)->label(false) ?>
            <?= $form->field($model, 'alert_value',
                ['options'=>['class'=>'col-sm-4']])->textInput(['maxlength' => true])->label(false) ?>
        </div>

        <?= FieldRange::widget([
            'form' => $form,
            'model' => $model,
            'label' => Yii::t('translation','Work interval'),
            'type' => FieldRange::INPUT_TIME,
            'widgetContainer' => [ 'class' => 'time-range-container' ],
            'attribute1' => 'work_interval_start',
            'attribute2' => 'work_interval_end',
            'widgetOptions1' => [
                'containerOptions' => ['class' => 'row'],
                'pluginOptions' => [
                    'defaultTime' => '00:00',
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                ],
            ],
            'attribute2' => 'work_interval_end',
            'widgetOptions2' => [
                'containerOptions' => ['class' => 'row'],
                'pluginOptions' => [
                    'defaultTime' => '23:59',
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                ],
            ],
        ]); ?>

        <?= $form->field($model, 'work_days')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'active')->checkbox(['checked' => $model->active,
            'label' => Yii::t('translation','Active')]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord
                ? Yii::t('translation','Create')
                : Yii::t('translation','Update'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
