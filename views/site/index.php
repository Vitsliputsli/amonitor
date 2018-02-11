<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'aMonitor';
?>
<div class="container">
<div class="site-index">

    <div class="jumbotron">
        <h1>aMonitor</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2><?= Yii::t('translation', 'About') ?></h2>

                <p><?= Yii::t('translation', 'Information about this monitoring system') ?></p>

                <p><a class="btn btn-default" href="<?= Url::toRoute(['site/about']) ?>"><?= Yii::t('translation', 'About') ?> &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?= Yii::t('translation', 'Monitoring') ?></h2>

                <p><?= Yii::t('translation', 'Its the page with monitoring attributes') ?></p>

                <p><a class="btn btn-default" href="<?= Url::toRoute(['site/monitoring']) ?>"><?= Yii::t('translation', 'Monitoring') ?> &raquo;</a></p>
            </div>
            <?php if ( Yii::$app->user->isGuest ): ?>
                <div class="col-lg-4">
                    <h2><?= Yii::t('translation', 'Login') ?></h2>

                    <p><?= Yii::t('translation', 'Login for extended functionality') ?></p>

                    <p><a class="btn btn-default" href="<?= Url::toRoute(['site/login']) ?>"><?= Yii::t('translation', 'Login') ?> &raquo;</a></p>
                </div>
            <?php endif; ?>
            <?php if ( Yii::$app->user->getId() == 100 ): ?>
                <div class="col-lg-4">
                    <h2><?= Yii::t('translation', 'Groups') ?> - <?= Yii::t('translation', 'Items') ?></h2>

                    <p><?= Yii::t('translation', 'Editors for items and their groups (item is a element of monitoring)') ?></p>

                    <p>
                        <a class="btn btn-default" href="<?= Url::toRoute(['monitor-groups-editor/index']) ?>"><?= Yii::t('translation', 'Groups') ?> &raquo;</a>
                        <a class="btn btn-default" href="<?= Url::toRoute(['monitor-items-editor/index']) ?>"><?= Yii::t('translation', 'Items') ?> &raquo;</a>
                    </p>
                </div>
                <div class="col-lg-4">
                    <h2><?= Yii::t('translation', 'Queries') ?></h2>

                    <p><?= Yii::t('translation', 'Editor for DataBase queries (query get information about monitoring item)') ?></p>

                    <p><a class="btn btn-default" href="<?= Url::toRoute(['db-queries-editor/index']) ?>"><?= Yii::t('translation', 'Queries') ?> &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2><?= Yii::t('translation', 'Emails') ?></h2>

                    <p><?= Yii::t('translation', 'Editor for alert emails (who get email when items alert)') ?></p>

                    <p><a class="btn btn-default" href="<?= Url::toRoute(['alert-emails-editor/index']) ?>"><?= Yii::t('translation', 'Emails') ?> &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2><?= Yii::t('translation', 'Log') ?></h2>

                    <p><?= Yii::t('translation', 'Information about alert events') ?></p>

                    <p><a class="btn btn-default" href="<?= Url::toRoute(['alert-log/index']) ?>"><?= Yii::t('translation', 'Log') ?> &raquo;</a></p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
</div>
