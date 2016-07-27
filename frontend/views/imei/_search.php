<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ImeiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imei-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'imei_id') ?>

    <?= $form->field($model, 'warehouse_current') ?>

    <?= $form->field($model, 'warehouse_destiny') ?>

    <?= $form->field($model, 'master_id') ?>

    <?= $form->field($model, 'pallet_id') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'product_id') ?>

    <?php // echo $form->field($model, 'code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
