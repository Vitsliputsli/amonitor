<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AlertEmails */

$this->title = Yii::t('translation','Update Alert Emails: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('translation','Alert Emails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('translation','Update');
?>
<div class="alert-emails-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'groups' => $groups,
        'items' => $items,
    ]) ?>

</div>
