<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DbQueriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation','Db Queries');
$this->params['breadcrumbs'][] = Yii::t('translation',$this->title);
?>
<div class="db-queries-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('translation','Create Db Query'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'monitor_items_id',
                'value' => 'monitorItem.item_name',
                'label' => Yii::t('translation','Item Name'),
            ],
            'db_query',
            [
                'attribute' => 'db_name',
                'value' => function($model, $key, $index, $column) {
                        return YII::$app->params['dbNames'][$model->db_name];
                    },
                'filter' => $dbNames,
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
