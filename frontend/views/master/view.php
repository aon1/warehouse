<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Master */

$this->title = $model->master_id;
$this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'master_id' => $model->master_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'pallet_id' => $model->pallet_id, 'status_id' => $model->status_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'master_id' => $model->master_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'pallet_id' => $model->pallet_id, 'status_id' => $model->status_id], [
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
            'master_id',
            'warehouse_current',
            'warehouse_destiny',
            'pallet_id',
            'status_id',
            'code',
        ],
    ]) ?>

</div>
