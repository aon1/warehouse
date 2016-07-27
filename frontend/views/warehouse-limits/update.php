<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WarehouseLimits */

$this->title = 'Update Warehouse Limits: ' . $model->warehouse_limits_id;
$this->params['breadcrumbs'][] = ['label' => 'Warehouse Limits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->warehouse_limits_id, 'url' => ['view', 'warehouse_limits_id' => $model->warehouse_limits_id, 'warehouse_origin_id' => $model->warehouse_origin_id, 'warehouse_target_id' => $model->warehouse_target_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="warehouse-limits-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
