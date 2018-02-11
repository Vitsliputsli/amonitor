<?php

namespace app\controllers;

use Yii;
use app\models\Monitor;
use yii\web\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UpdateController extends Controller
{
    public $layout=false;

    public function actionIndex()
    {
        if ( Yii::$app->request->get('token') != Yii::$app->params['updateToken'] ) {
            return $this->render('index', ['message'=>'error: incorrect token!'] );
        }
        $monitor = new Monitor();
        return $this->render('index', ['message'=>$monitor->update()] );
    }
}
