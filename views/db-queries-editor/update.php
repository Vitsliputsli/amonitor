<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DbQueries */

$this->title = Yii::t('translation','Update Db Queries: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation','Db Queries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation','Update');
?>
<div class="db-queries-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dbNames' => $dbNames,
        'items'=>$items,
    ]) ?>

</div>
