<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AlertEmails */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation','Alert Emails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('translation',$this->title);
?>
<div class="container">
    <div class="alert-emails-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('translation','Update'), ['update', 'id' => $model->id],
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
                    'attribute' => 'monitor_groups_id',
                    'value' => $model->monitor_groups_id ? $model->monitorGroup->group_name : '',
                    'label' => Yii::t('translation','Group')
                ],
                [
                    'attribute' => 'monitor_items_id',
                    'value' => $model->monitor_items_id ? $model->monitorItem->item_name : '',
                    'label' => Yii::t('translation','Item Name'),
                ],
                'email:email',
            ],
        ]) ?>

    </div>
</div>