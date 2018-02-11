<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MonitorItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation', 'Monitor Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitor-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('translation', 'Create Monitor Items'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'monitor_groups_id',
                'value' => 'monitorGroup.group_name',
                'label' => Yii::t('translation', 'Group'),
                'filter' => $groups
            ],
            'item_name',
            [
                'label' => Yii::t('translation', 'Warning'),
                'header' => '<span class="align-center glyphicon glyphicon-warning-sign color-orange"></span>',
                'value' => function($model, $key, $index, $column) {
                    return $model->warning_operator . ' ' . $model->warning_value;
                },
            ],
            [
                'label' => Yii::t('translation', 'Alert'),
                'header' => '<span class="glyphicon glyphicon-alert color-red"></span>',
                'value' => function($model, $key, $index, $column) {
                    return $model->alert_operator . ' ' . $model->alert_value;
                },
            ],
            [
                'header' => Yii::t('translation', 'Active'),
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['checked' => $model->active, 'disabled' => true];
                }
            ],
            'work_interval',
            'work_days',
            ['class' => 'yii\grid\ActionColumn'],

            [
                'label' => Yii::t('translation', 'DB Queries'),
                'format' => 'raw',
                'value' => function($model, $key, $index, $column) {
                    return is_null($model->dbQuery)
                        ? Html::decode(Html::a(Yii::t('translation', 'create query'),
                            Url::toRoute(['db-queries-editor/create?item-id='.$model->id])))
                        : Html::decode(Html::a(Yii::t('translation', 'query'),
                            Url::toRoute(['db-queries-editor/view?id='.$model->dbQuery->id])));
                },
            ],
        ],
    ]); ?>
</div>
