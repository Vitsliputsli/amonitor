<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DbQueries */

$this->title = 'Create Db Queries';
$this->params['breadcrumbs'][] = ['label' => 'Db Queries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="db-queries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dbNames' => $dbNames,
        'items'=>$items,
    ]) ?>

</div>
