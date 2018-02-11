<?php

namespace app\commands;

use app\models\Monitor;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MonitorController extends Controller
{
    public function actionIndex()
    {
        echo "Monitor has only one action 'update' for synchronization.\n";
    }

    public function actionUpdate()
    {
        $monitor = new Monitor();
        echo 'Monitor: '.$monitor->update()."\n";
    }
}
