<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\MonitorItems */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation','Monitor Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('translation',$this->title);
?>
<div class="container">
    <div class="monitor-items-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('translation', 'Update'), ['update', 'id' => $model->id],
                ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('translation','Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('translation','Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'headerOptions' => ['width' => '150'],
                    'attribute' => 'monitor_groups_id',
                    'value' => $model->monitorGroup->group_name,
                    'label' => Yii::t('translation', 'Group'),
                ],
                'item_name',
                [
                    'label' => '<span class="align-center glyphicon glyphicon-warning-sign color-orange"></span> '
                        .Yii::t('translation', 'Warning'),
                    'value' => call_user_func(function($model) {
                        return $model->warning_operator . ' ' . $model->warning_value;
                    },$model),
                ],
                [
                    'label' => '<span class="align-center glyphicon glyphicon-alert color-red"></span> '
                        .Yii::t('translation', 'Alert'),
                    'value' => call_user_func(function($model) {
                        return $model->alert_operator . ' ' . $model->alert_value;
                    },$model),
                ],
                'work_interval',
                'work_days',
                [
                    'label' => Yii::t('translation', 'Active'),
                    'value' => Yii::t('translation', ($model->active ? 'Yes' : 'No')),
                ],
                [
                    'label' => Yii::t('translation', 'Db Query'),
                    'format' => 'raw',
                    'value' => function($model) {
                        return is_null($model->dbQuery)
                            ? Html::decode(Html::a(Yii::t('translation', 'create query'),
                                Url::toRoute(['db-queries-editor/create?item-id='.$model->id])))
                            : Html::decode(Html::a(Yii::t('translation', 'query'),
                                Url::toRoute(['db-queries-editor/view?id='.$model->dbQuery->id])));
                    },
                ],
            ],
        ])
        ?>


    </div>
</div>
