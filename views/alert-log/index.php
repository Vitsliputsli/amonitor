<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlertLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation','Alert Logs');
$this->params['breadcrumbs'][] = Yii::t('translation',$this->title);
?>
<div class="alert-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'time',
            [
                'attribute' => 'monitor_items_id',
                'value' => 'monitorItem.item_name',
                'label' => Yii::t('translation','Item Name'),
            ],
            [
                'attribute' => 'status',
                'filter' => ['warning','alert'],
            ],
            'item_value',
            'email_send',
        ],
    ]); ?>
</div>
