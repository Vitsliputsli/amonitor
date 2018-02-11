<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('translation', 'Monitoring');
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->response->headers->set('refresh', '300');

?>
<div class="container">
<div class="site-monitoring">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="text-right">
        <p><?= Yii::t('translation', 'Update time:') ?> <?= $updateTime['min']." - ".$updateTime['max'] ?></p>
    </div>
    <?php if ( $updateTime['lastUpdateMinutes'] > 60 ): ?>
        <div class="alert alert-danger">
            <?= Yii::t('translation', 'Monitor update has been') ?>
            <?= floor($updateTime['lastUpdateMinutes']/60) ?>
            <?= Yii::t('translation', 'hours ago.') ?>
            <?= Yii::t('translation', 'Results is outdated. Possible synchronization is down.') ?>
        </div>
    <?php elseif ( $updateTime['lastUpdateMinutes'] > 15 ): ?>
        <div class="alert alert-warning">
            <?= Yii::t('translation', 'Monitor update has been') ?>
            <?= $updateTime['lastUpdateMinutes'] ?>
            <?= Yii::t('translation', 'min ago.') ?>
            <?= Yii::t('translation', 'Results may be outdated.') ?>
        </div>
    <?php endif; ?>
    <div>
        <?php
        $classAlert = [
                'success'=>'success',
                'warning'=>'warning',
                'alert'=>'danger',
                'inactive'=>'inactive',
        ]; ?>

        <?php foreach ($groups as $group): ?>
            <?php if (!is_null($group['group_name'])): ?>
                <div class="panel panel-<?= $classAlert[$group->status] ?>">
                    <div class="panel-heading" data-toggle="collapse" data-target="#monitorGroup<?= $group['id'] ?>">
                        <?= Yii::t('translation', 'Group:') ?>
                        <?= $group['group_name'] ?> &raquo;
                    </div>
                    <div id="monitorGroup<?= $group['id'] ?>" class="panel-body collapse">
            <?php endif; ?>
            <?php foreach ($monitor as $monitorItem): ?>
                <?php if ( $monitorItem['monitor_groups_id'] == $group['id'] ): ?>
                    <div class="alert alert-<?= $classAlert[$monitorItem->status] ?>"
                         data-toggle="tooltip"
                         title="<?= is_null($monitorItem['time'])
                             ? (Yii::t('translation', 'Work interval') . ': ' . trim($monitorItem['work_days']) . ' ' . $monitorItem['WORK_INTERVAL'])
                             : Yii::t('translation', 'Update time:').$monitorItem['time'] ?>&nbsp
<?= trim($monitorItem->condition) ?>">
                        <?= $monitorItem['item_name'] ?>:
                        <strong>
                            <?= is_null($monitorItem['db_error'])
                                ? $monitorItem['value']
                                : Yii::t('translation', 'Error in SQL-query') ?>
                        </strong>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>
            <?php if (!is_null($group['group_name'])): ?>
                    </div>
                    <div class="panel-footer text-right">
                        <small>
                        <?php if ($group->count['warning']!=0 or $group->count['alert']!=0): ?>
                            <?php if ($group->count['warning']!=0): ?>
                                <?= Yii::t('translation', 'Warnings:') ?>
                                <?= $group->count['warning'] ?>
                            <?php endif; ?>
                            <?php if ($group->count['alert']!=0): ?>
                                <?= Yii::t('translation', 'Alerts:') ?>
                                <?= $group->count['alert'] ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?= Yii::t('translation', 'All Succeeded') ?>
                        <?php endif; ?>
                        </small>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
</div>
