<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pallet */

$this->title = 'Update Pallet: ' . $model->pallet_id;
$this->params['breadcrumbs'][] = ['label' => 'Pallets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pallet_id, 'url' => ['view', 'pallet_id' => $model->pallet_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'status_id' => $model->status_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pallet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
