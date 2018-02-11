<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MonitorGroups */

$this->title = Yii::t('translation', 'Update Monitor Groups: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation', 'Monitor Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation', 'Update');
?>
<div class="monitor-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
