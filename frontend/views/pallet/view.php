<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pallet */

$this->title = $model->pallet_id;
$this->params['breadcrumbs'][] = ['label' => 'Pallets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pallet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'pallet_id' => $model->pallet_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'status_id' => $model->status_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'pallet_id' => $model->pallet_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'status_id' => $model->status_id], [
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
            'pallet_id',
            'warehouse_current',
            'warehouse_destiny',
            'status_id',
            'code',
        ],
    ]) ?>

</div>
