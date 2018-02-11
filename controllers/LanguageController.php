<?php
/**
 * Created by PhpStorm.
 * User: vitsliputsli
 * Date: 11/20/17
 * Time: 3:15 PM
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

class LanguageController extends Controller
{
    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            if (!is_null(Yii::$app->request->getQueryParam('lang')))
            {
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => 'lang',
                    'value' => Yii::$app->request->getQueryParam('lang')
                ]));
                Yii::$app->language = Yii::$app->request->getQueryParam('lang');
            }
            else {
                Yii::$app->language = Yii::$app->request->cookies->getValue('lang',
                    Yii::$app->request->getPreferredLanguage(['en-US', 'ru-RU']));
            }

            return true;
        }

        return false;
    }
}