<?php

namespace frontend\controllers;

use common\models\Warehouse;
use common\models\WarehouseLimits;
use common\models\Imei;
use common\models\Product;
use common\models\Pallet;
use common\models\Status;
use common\models\Master;
use common\models\Transporter;
use yii\helpers\ArrayHelper;


class LotController extends \yii\web\Controller
{
    public function actionCreate()
    {
    	$warehouse = new Warehouse();
        $imei = new Imei();

    	$items = ArrayHelper::map(Warehouse::find()->all(),'warehouse_id','label');

        return $this->render('create', [
        	'warehouse' => $warehouse,
            'imei' => $imei,
        	'items' => $items,
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
