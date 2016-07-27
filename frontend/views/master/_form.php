<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Master */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'warehouse_current')->textInput() ?>

    <?= $form->field($model, 'warehouse_destiny')->textInput() ?>

    <?= $form->field($model, 'pallet_id')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
