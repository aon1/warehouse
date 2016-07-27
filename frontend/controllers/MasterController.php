<?php

namespace frontend\controllers;

use Yii;
use common\models\Master;
use common\models\MasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * MasterController implements the CRUD actions for Master model.
 */
class MasterController extends Controller
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
     * Lists all Master models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Master model.
     * @param integer $master_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $pallet_id
     * @param integer $status_id
     * @return mixed
     */
    public function actionView($master_id, $warehouse_current, $warehouse_destiny, $pallet_id, $status_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($master_id, $warehouse_current, $warehouse_destiny, $pallet_id, $status_id),
        ]);
    }

    /**
     * Creates a new Master model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Master();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'master_id' => $model->master_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'pallet_id' => $model->pallet_id, 'status_id' => $model->status_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Master model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $master_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $pallet_id
     * @param integer $status_id
     * @return mixed
     */
    public function actionUpdate($master_id, $warehouse_current, $warehouse_destiny, $pallet_id, $status_id)
    {
        $model = $this->findModel($master_id, $warehouse_current, $warehouse_destiny, $pallet_id, $status_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'master_id' => $model->master_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'pallet_id' => $model->pallet_id, 'status_id' => $model->status_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Master model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $master_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $pallet_id
     * @param integer $status_id
     * @return mixed
     */
    public function actionDelete($master_id, $warehouse_current, $warehouse_destiny, $pallet_id, $status_id)
    {
        $this->findModel($master_id, $warehouse_current, $warehouse_destiny, $pallet_id, $status_id)->delete();

        return $this->redirect(['index']);
    }

    public static function getMaster($warehouse_current_id, $pallet_id)
    {
        $data = Master::find()->
                    select(['master_id as id', 'code as name'])->
                    andWhere('warehouse_current = ' . $warehouse_current_id . '
                        AND warehouse_destiny = ' . $warehouse_current_id. ' 
                        AND pallet_id = ' . $pallet_id . '
                        AND status_id = 2')->
                    asArray()->all();

        $selected = null;
        $out = [];

        foreach ($data as $dat => $datas) {
            $out[] = ['id' => $datas['id'], 'name' => $datas['name']];

            if($dat == 0){
                $aux = $datas['id'];
            }

            ($datas['id'] == $warehouse_current_id) ? $selected = $warehouse_current_id : $selected = $aux;

        }
        return $output = [
            'output' => $out,
            'selected' => $selected
        ];
    }

    public function actionList()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $warehouse_current_id = empty($ids[0]) ? null : $ids[0];
            $pallet_id = empty($ids[1]) ? null : $ids[1];

            if ($warehouse_current_id != null) {
                $data = self::getMaster($warehouse_current_id, $pallet_id);

                echo Json::encode(['output'=>$data['output'], 'selected'=>$data['selected']]);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Finds the Master model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $master_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $pallet_id
     * @param integer $status_id
     * @return Master the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($master_id, $warehouse_current, $warehouse_destiny, $pallet_id, $status_id)
    {
        if (($model = Master::findOne(['master_id' => $master_id, 'warehouse_current' => $warehouse_current, 'warehouse_destiny' => $warehouse_destiny, 'pallet_id' => $pallet_id, 'status_id' => $status_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
