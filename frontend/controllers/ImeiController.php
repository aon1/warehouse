<?php

namespace frontend\controllers;

use Yii;
use common\models\Imei;
use common\models\ImeiSearch;
use common\models\Warehouse;
use common\models\WarehouseLimits;
use common\models\Product;
use common\models\Pallet;
use common\models\Status;
use common\models\Master;
use common\models\Transporter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;



/**
 * ImeiController implements the CRUD actions for Imei model.
 */
class ImeiController extends Controller
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
     * Lists all Imei models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImeiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Imei model.
     * @param integer $imei_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $master_id
     * @param integer $pallet_id
     * @param integer $status_id
     * @param integer $product_id
     * @return mixed
     */
    public function actionView($imei_id, $warehouse_current, $warehouse_destiny, $master_id, $pallet_id, $status_id, $product_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($imei_id, $warehouse_current, $warehouse_destiny, $master_id, $pallet_id, $status_id, $product_id),
        ]);
    }

    /**
     * Creates a new Imei model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Imei();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'imei_id' => $model->imei_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'master_id' => $model->master_id, 'pallet_id' => $model->pallet_id, 'status_id' => $model->status_id, 'product_id' => $model->product_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Imei model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $imei_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $master_id
     * @param integer $pallet_id
     * @param integer $status_id
     * @param integer $product_id
     * @return mixed
     */
    public function actionUpdate($imei_id, $warehouse_current, $warehouse_destiny, $master_id, $pallet_id, $status_id, $product_id)
    {
        $model = $this->findModel($imei_id, $warehouse_current, $warehouse_destiny, $master_id, $pallet_id, $status_id, $product_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'imei_id' => $model->imei_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'master_id' => $model->master_id, 'pallet_id' => $model->pallet_id, 'status_id' => $model->status_id, 'product_id' => $model->product_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Imei model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $imei_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $master_id
     * @param integer $pallet_id
     * @param integer $status_id
     * @param integer $product_id
     * @return mixed
     */
    public function actionDelete($imei_id, $warehouse_current, $warehouse_destiny, $master_id, $pallet_id, $status_id, $product_id)
    {
        $this->findModel($imei_id, $warehouse_current, $warehouse_destiny, $master_id, $pallet_id, $status_id, $product_id)->delete();

        return $this->redirect(['index']);
    }

    public function actionChecklimitwarehouse($id)
    {
        $warehouseLimit = WarehouseLimits::find()->where(['warehouse_target_id' => $id])->one();

        echo "Limit: $warehouseLimit->limitation";

        $rows = Imei::find()->all();

        // echo "<select><option>Selecione um IMEI</option>";
        $data = array();

        if(count($rows)>0){
            foreach($rows as $row){
                // echo "<option value='$row->imei_id'>$row->code</option>";
                $data[] = array($row->imei_id => $row->code);
            }
            echo $data;
        }
        else{
            // echo "<option>Nenhum IMEI cadastrado</option>";
            echo "Nada";
        }

        // echo "</select>";
    }    

    public function actionCreateLot()
    {
        if (Yii::$app->request->post()) {
            // $imeiFromPost = Yii::$app->request->post()['Imei'];

            $modelFromPost = new Imei();
            $modelFromPost->load(Yii::$app->request->post());

            $imeiOriginal = Imei::findOne($modelFromPost->code);

            $modelFromPost->status_id = 1;
            $modelFromPost->product_id = $imeiOriginal->product_id;
            $modelFromPost->master_id = $imeiOriginal->master_id;
            $modelFromPost->pallet_id = $imeiOriginal->pallet_id;

            print_r($modelFromPost->save(false));

            // print_r($modelFromPost->warehouse_destiny);
            // print_r($modelFromPost->warehouse_current);
            // print_r($modelFromPost->product_id);

        } else {
            $model = new Imei();

            $warehouseCurrent = ArrayHelper::map(Warehouse::find()->all(),'warehouse_id','label');

            return $this->render('create-lot', [
                'model' => $model,
                'warehouseCurrent' => $warehouseCurrent,
                // 'items' => $items,
                'data' => [],
            ]);
        }
    }

    public function actionTeste()
    {
        $selected = '';
        $out = [];
        $data = self::getImei(2,2);
        /**
         * the getProdList function will query the database based on the
         * cat_id and sub_cat_id and return an array like below:
         *  [
         *      'out'=>[
         *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
         *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
         *       ],
         *       'selected'=>'<prod-id-1>'
         *  ]
         */
       
       echo Json::encode(['output'=>$data['output'], 'selected'=>$data['selected']]);
    }

    public static function getImei($warehouse_current_id, $warehouse_destiny_id)
    {
        $data = Imei::find()->
                    select(['imei_id as id', 'code as name'])->
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
                $data = self::getImei($warehouse_current_id, $warehouse_destiny_id);

                echo Json::encode(['output'=>$data['output'], 'selected'=>$data['selected']]);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionAddpallet()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('SET FOREIGN_KEY_CHECKS=0;')->execute();

        if (isset($_GET['pallet'])) {
            $warehouse_current = $_GET['Imei']['warehouse_current'];
            $warehouse_destiny = $_GET['Imei']['warehouse_destiny'];
            $pallet = $_GET['Imei']['pallet_id'];

            $command = $connection->createCommand('UPDATE imei SET warehouse_destiny = ' . $warehouse_destiny . ' where pallet_id = ' . $pallet)->execute();

            $connection->createCommand('UPDATE master SET warehouse_destiny = ' . $warehouse_destiny . ' where pallet_id = ' . $pallet)->execute();

            $connection->createCommand('UPDATE pallet SET warehouse_destiny = ' . $warehouse_destiny . ' where pallet_id = ' . $pallet)->execute();
            
        } else if (isset($_GET['master'])) {
            print_r($_GET);
            $warehouse_current = $_GET['Imei']['warehouse_current'];
            $warehouse_destiny = $_GET['Imei']['warehouse_destiny'];
            $pallet = $_GET['Imei']['pallet_id'];
            $master = $_GET['Imei']['master_id'];

            $command = $connection->createCommand('UPDATE imei SET warehouse_destiny = ' . $warehouse_destiny . ' where master_id = ' . $pallet)->execute();

            $connection->createCommand('UPDATE master SET warehouse_destiny = ' . $warehouse_destiny . ' where master_id = ' . $pallet)->execute();
        } else if (isset($_GET['imei'])) {
            $warehouse_current = $_GET['Imei']['warehouse_current'];
            $warehouse_destiny = $_GET['Imei']['warehouse_destiny'];
            $pallet = $_GET['Imei']['pallet_id'];
            $master = $_GET['Imei']['master_id'];
            $imei = $_GET['Imei']['code'];

            $command = $connection->createCommand('UPDATE imei SET warehouse_destiny = ' . $warehouse_destiny . ' where imei_id = ' . $imei)->execute();
        }

        $command = $connection->createCommand('SET FOREIGN_KEY_CHECKS=1;')->execute();

        // $model = new Imei();
        // $warehouseCurrent = ArrayHelper::map(Warehouse::find()->all(),'warehouse_id','label');

        return $this->render('create-lot', [
            'model' => $model,
            'warehouseCurrent' => $warehouseCurrent,
            // 'items' => $items,
            'data' => [],
        ]);
    }

    /**
     * Finds the Imei model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $imei_id
     * @param integer $warehouse_current
     * @param integer $warehouse_destiny
     * @param integer $master_id
     * @param integer $pallet_id
     * @param integer $status_id
     * @param integer $product_id
     * @return Imei the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($imei_id, $warehouse_current, $warehouse_destiny, $master_id, $pallet_id, $status_id, $product_id)
    {
        if (($model = Imei::findOne(['imei_id' => $imei_id, 'warehouse_current' => $warehouse_current, 'warehouse_destiny' => $warehouse_destiny, 'master_id' => $master_id, 'pallet_id' => $pallet_id, 'status_id' => $status_id, 'product_id' => $product_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
