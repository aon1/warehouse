<?php

namespace frontend\controllers;

use Yii;
use common\models\WarehouseLimits;
use common\models\WarehouseLimitsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WarehouseLimitsController implements the CRUD actions for WarehouseLimits model.
 */
class WarehouseLimitsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all WarehouseLimits models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WarehouseLimitsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WarehouseLimits model.
     * @param integer $warehouse_limits_id
     * @param integer $warehouse_origin_id
     * @param integer $warehouse_target_id
     * @return mixed
     */
    public function actionView($warehouse_limits_id, $warehouse_origin_id, $warehouse_target_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($warehouse_limits_id, $warehouse_origin_id, $warehouse_target_id),
        ]);
    }

    /**
     * Creates a new WarehouseLimits model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WarehouseLimits();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'warehouse_limits_id' => $model->warehouse_limits_id, 'warehouse_origin_id' => $model->warehouse_origin_id, 'warehouse_target_id' => $model->warehouse_target_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing WarehouseLimits model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $warehouse_limits_id
     * @param integer $warehouse_origin_id
     * @param integer $warehouse_target_id
     * @return mixed
     */
    public function actionUpdate($warehouse_limits_id, $warehouse_origin_id, $warehouse_target_id)
    {
        $model = $this->findModel($warehouse_limits_id, $warehouse_origin_id, $warehouse_target_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'warehouse_limits_id' => $model->warehouse_limits_id, 'warehouse_origin_id' => $model->warehouse_origin_id, 'warehouse_target_id' => $model->warehouse_target_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WarehouseLimits model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $warehouse_limits_id
     * @param integer $warehouse_origin_id
     * @param integer $warehouse_target_id
     * @return mixed
     */
    public function actionDelete($warehouse_limits_id, $warehouse_origin_id, $warehouse_target_id)
    {
        $this->findModel($warehouse_limits_id, $warehouse_origin_id, $warehouse_target_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WarehouseLimits model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $warehouse_limits_id
     * @param integer $warehouse_origin_id
     * @param integer $warehouse_target_id
     * @return WarehouseLimits the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($warehouse_limits_id, $warehouse_origin_id, $warehouse_target_id)
    {
        if (($model = WarehouseLimits::findOne(['warehouse_limits_id' => $warehouse_limits_id, 'warehouse_origin_id' => $warehouse_origin_id, 'warehouse_target_id' => $warehouse_target_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
