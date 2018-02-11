<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('translation', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="site-about">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Yii::t('translation', 'aMonitor is the system for monitoring different attributes of services by SQL-queries.') ?>
        </p>
        <p>
            <a href="<?= Url::toRoute(['site/monitoring']) ?>">
                "<?= Yii::t('translation', 'Monitoring') ?>"
            </a> - <?= Yii::t('translation', 'You find monitoring items with their statuses here.') ?>
        </p>

        <?php if ( Yii::$app->user->getId() == 100 ): ?>

        <h3><?= Yii::t('translation', 'Begin work:') ?></h3>

        <p>
        <li><?= Yii::t('translation', 'Create monitor item in editor') ?>
                <a href="<?= Url::toRoute(['monitor-items-editor/index']) ?>">
                    "<?= Yii::t('translation', 'Items') ?>"
                </a>
            </li>
        <li><?= Yii::t('translation', 'Write "Item Name" as you wish') ?></li>
        <li><?= Yii::t('translation', 'Write Operator and Value for 2 signal (Warning and Alert, Alert more critical signal)') ?></li>
        <li><?= Yii::t('translation', 'Create it') ?></li>
        <li><?= Yii::t('translation', 'Create db query in editor') ?>
            <a href="<?= Url::toRoute(['db-queries-editor/index']) ?>">
                "<?= Yii::t('translation', 'Queries') ?>"
            </a></li>
        <li><?= Yii::t('translation', 'Choose "Item name" (created in previous steps)') ?></li>
        <li><?= Yii::t('translation', 'Write "Db Query" (it is SQL-query, its result must be scalar)') ?></li>
        <li><?= Yii::t('translation', 'Choose "Db Name" from list') ?></li>
        <li><?= Yii::t('translation', 'Create it') ?></li>
        </p>

        <p>
            <?= Yii::t('translation', 'All done! You can show result in') ?>
            <a href="<?= Url::toRoute(['site/monitoring']) ?>">"<?= Yii::t('translation', 'Monitoring') ?>"</a>.
            <?= Yii::t('translation', 'Real values of monitoring items will be get after synchronization.') ?>
        </p>

        <h3><?= Yii::t('translation', 'More:') ?></h3>

        <p>
            <?= Yii::t('translation', 'For more usability You may collect items to groups') ?>
            <a href="<?= Url::toRoute(['monitor-groups-editor/index']) ?>">"<?= Yii::t('translation', 'Groups') ?>"</a>
        </p>

        <p>
            <a href="<?= Url::toRoute(['alert-emails-editor/index']) ?>">"<?= Yii::t('translation', 'Emails') ?>"</a>
            - <?= Yii::t('translation', 'You may set email for Your information about alert events.') ?>
        </p>

        <p>
            <a href="<?= Url::toRoute(['alert-log/index']) ?>">"<?= Yii::t('translation', 'Log') ?>"</a>
            - <?= Yii::t('translation', 'You found information about alert events.') ?>
        </p>

        <?php endif; ?>

    </div>
</div>
