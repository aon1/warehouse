<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Master */

$this->title = 'Update Master: ' . $model->master_id;
$this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->master_id, 'url' => ['view', 'master_id' => $model->master_id, 'warehouse_current' => $model->warehouse_current, 'warehouse_destiny' => $model->warehouse_destiny, 'pallet_id' => $model->pallet_id, 'status_id' => $model->status_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
