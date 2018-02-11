<?php

namespace app\controllers;

use Yii;
use app\models\AlertEmails;
use app\models\AlertEmailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\MonitorGroups;
use app\models\MonitorItems;

/**
 * AlertEmailsEditorController implements the CRUD actions for AlertEmails model.
 */
class AlertEmailsEditorController extends LanguageController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AlertEmails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlertEmailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'groups' => ArrayHelper::map(MonitorGroups::find()->where("group_name is not null")->all(),
                'id', 'group_name'),
            'items' => [null=>''] + ArrayHelper::map(MonitorItems::find()->all(), 'id', 'item_name'),
        ]);
    }

    /**
     * Displays a single AlertEmails model
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AlertEmails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AlertEmails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'groups' => [null=>''] + ArrayHelper::map(MonitorGroups::find()->where("group_name is not null")->all(),
                        'id', 'group_name'),
                'items' => [null=>''] + ArrayHelper::map(MonitorItems::find()->all(), 'id', 'item_name'),
            ]);
        }
    }

    /**
     * Updates an existing AlertEmails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'groups' => [null=>''] + ArrayHelper::map(MonitorGroups::find()->where("group_name is not null")->all(),
                        'id', 'group_name'),
                'items' => [null=>''] + ArrayHelper::map(MonitorItems::find()->all(), 'id', 'item_name'),
            ]);
        }
    }

    /**
     * Deletes an existing AlertEmails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AlertEmails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AlertEmails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AlertEmails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
