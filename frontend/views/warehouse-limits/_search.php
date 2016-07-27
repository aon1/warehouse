<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WarehouseLimitsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warehouse-limits-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'warehouse_limits_id') ?>

    <?= $form->field($model, 'warehouse_origin_id') ?>

    <?= $form->field($model, 'warehouse_target_id') ?>

    <?= $form->field($model, 'limit_1') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
