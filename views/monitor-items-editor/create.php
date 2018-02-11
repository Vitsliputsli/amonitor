<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MonitorItems */

$this->title = Yii::t('translation','Create Monitor Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation','Monitor Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('translation',$this->title);
?>
<div class="monitor-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'groups' => $groups,
        'operators' => $operators,
    ]) ?>

</div>
