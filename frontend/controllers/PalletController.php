<?php

namespace frontend\controllers;

use Yii;
use common\models\Pallet;
use common\models\PalletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


/**
 * PalletController implements the CRUD actions for Pallet model.
 */
class PalletController extends Controller
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
     * Lists all Pallet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PalletSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pallet model.
     * @param integer $pallet_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $status_id
     * @return mixed
     */
    public function actionView($pallet_id, $warehouse_current, $warehouse_destiny, $status_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($pallet_id, $warehouse_current, $warehouse_destiny, $status_id),
        ]);
    }

    /**
     * Creates a new Pallet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pallet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'pallet_id' => $model->pallet_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'status_id' => $model->status_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pallet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $pallet_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $status_id
     * @return mixed
     */
    public function actionUpdate($pallet_id, $warehouse_current, $warehouse_destiny, $status_id)
    {
        $model = $this->findModel($pallet_id, $warehouse_current, $warehouse_destiny, $status_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'pallet_id' => $model->pallet_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'status_id' => $model->status_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pallet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $pallet_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $status_id
     * @return mixed
     */
    public function actionDelete($pallet_id, $warehouse_current, $warehouse_destiny, $status_id)
    {
        $this->findModel($pallet_id, $warehouse_current, $warehouse_destiny, $status_id)->delete();

        return $this->redirect(['index']);
    }

    public static function getPallet($warehouse_current_id)
    {
        $data = Pallet::find()->
                    select(['pallet_id as id', 'code as name'])->
                    andWhere('warehouse_current = ' . $warehouse_current_id . '
                        AND warehouse_destiny = ' . $warehouse_current_id. ' AND status_id = 2')->
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
            $warehouse_destiny_id = empty($ids[1]) ? null : $ids[1];

            if ($warehouse_current_id != null) {
                $data = self::getPallet($warehouse_current_id);

                echo Json::encode(['output'=>$data['output'], 'selected'=>$data['selected']]);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Finds the Pallet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $pallet_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $status_id
     * @return Pallet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($pallet_id, $warehouse_current, $warehouse_destiny, $status_id)
    {
        if (($model = Pallet::findOne(['pallet_id' => $pallet_id, 'warehouse_current' => $warehouse_current, 'warehouse_destiny' => $warehouse_destiny, 'status_id' => $status_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
