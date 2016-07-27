<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WarehouseLimits */

$this->title = $model->warehouse_limits_id;
$this->params['breadcrumbs'][] = ['label' => 'Warehouse Limits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-limits-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'warehouse_limits_id' => $model->warehouse_limits_id, 'warehouse_origin_id' => $model->warehouse_origin_id, 'warehouse_target_id' => $model->warehouse_target_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'warehouse_limits_id' => $model->warehouse_limits_id, 'warehouse_origin_id' => $model->warehouse_origin_id, 'warehouse_target_id' => $model->warehouse_target_id], [
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
            'warehouse_limits_id',
            'warehouse_origin_id',
            'warehouse_target_id',
            'limit_1',
        ],
    ]) ?>

</div>
