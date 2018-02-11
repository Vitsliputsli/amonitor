<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::t('translation', $name);
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= Yii::t('translation', nl2br(Html::encode($message))) ?>
    </div>

    <p>
        <?= Yii::t('translation', 'The above error occurred while the Web server was processing your request.') ?>
    </p>
    <p>
<?= Yii::t('translation', 'Please contact us if you think this is a server error. Thank you.') ?>
    </p>

</div>
