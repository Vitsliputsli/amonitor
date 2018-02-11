<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlertEmailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('translation','Alert Emails');
$this->params['breadcrumbs'][] = Yii::t('translation',$this->title);
?>
<div class="alert-emails-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('translation','Create Alert Emails'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => Html::tag('span', Yii::t('translation','(for all)'), ['class' => 'not-set'])
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'monitor_groups_id',
                'value' => 'monitorGroup.group_name',
                'label' => Yii::t('translation','Group'),
                'filter' => $groups,
            ],
            [
                'attribute' => 'monitor_items_id',
                'value' => 'monitorItem.item_name',
                'label' => Yii::t('translation','Item Name'),
            ],
            'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
