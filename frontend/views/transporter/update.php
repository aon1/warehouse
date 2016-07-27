<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Transporter */

$this->title = 'Update Transporter: ' . $model->transporter_id;
$this->params['breadcrumbs'][] = ['label' => 'Transporters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transporter_id, 'url' => ['view', 'id' => $model->transporter_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transporter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
