<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MonitorGroups */

$this->title = 'Create Monitor Groups';
$this->params['breadcrumbs'][] = ['label' => 'Monitor Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitor-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
