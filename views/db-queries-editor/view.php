<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\DbQueries */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation','Db Queries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('translation',$this->title);
?>
<div class="container">
    <div class="db-queries-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('translation','Update'),
                ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                    'attribute' => 'monitor_items_id',
                    'label' => Yii::t('translation','Item Name'),
                    'format' => 'raw',
                    'value' => Html::decode(Html::a($model->monitorItem->item_name,
                        Url::toRoute(['monitor-items-editor/view?id='.$model->monitor_items_id]))),
                ],
                'db_query',
                [
                    'attribute' => 'db_name',
                    'value' => YII::$app->params['dbNames'][$model->db_name],
                ]
            ],
        ]) ?>

    </div>
</div>
