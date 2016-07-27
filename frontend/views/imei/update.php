<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Imei */

$this->title = 'Update Imei: ' . $model->imei_id;
$this->params['breadcrumbs'][] = ['label' => 'Imeis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->imei_id, 'url' => ['view', 'imei_id' => $model->imei_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'master_id' => $model->master_id, 'pallet_id' => $model->pallet_id, 'status_id' => $model->status_id, 'product_id' => $model->product_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="imei-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
