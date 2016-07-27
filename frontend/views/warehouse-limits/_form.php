<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WarehouseLimits */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warehouse-limits-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'warehouse_origin_id')->textInput() ?>

    <?= $form->field($model, 'warehouse_target_id')->textInput() ?>

    <?= $form->field($model, 'limit_1')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
