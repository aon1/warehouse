<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Imei */

$this->title = $model->imei_id;
$this->params['breadcrumbs'][] = ['label' => 'Imeis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imei-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'imei_id' => $model->imei_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'master_id' => $model->master_id, 'pallet_id' => $model->pallet_id, 'status_id' => $model->status_id, 'product_id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'imei_id' => $model->imei_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'master_id' => $model->master_id, 'pallet_id' => $model->pallet_id, 'status_id' => $model->status_id, 'product_id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'imei_id',
            'warehouse_current',
            'warehouse_destiny',
            'master_id',
            'pallet_id',
            'status_id',
            'product_id',
            'code',
        ],
    ]) ?>

</div>
