<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AlertEmails */

$this->title = 'Create Alert Emails';
$this->params['breadcrumbs'][] = ['label' => 'Alert Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alert-emails-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'groups' => $groups,
        'items' => $items,
    ]) ?>

</div>
